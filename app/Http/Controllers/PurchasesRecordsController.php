<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\InventoryOfWarehouseItems;
use App\Models\Laboratories;
use App\Models\Providers;
use App\Models\PurchasesRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PurchasesRecordsController extends Controller
{
    public function viewIndex()
    {
        $this->middleware('role:Super-Admin|Administrator|Grocer');

        $listProviders = Providers::orderBy('name')->get()->toArray();

        return response()->view('modules.grocer.purchases', [$listProviders]);
    }

    public function viewCreateProduct()
    {
        $listCategories = Categories::orderBy('name')->get()->toArray();
        $listLaboratories = Laboratories::orderBy('name')->get()->toArray();

        return response()->json(['categories' => $listCategories, 'laboratories' => $listLaboratories]);
    }

    public function dataProduct($itemID)
    {
        $productInWarehouse = InventoryOfWarehouseItems::where('itemID', $itemID)->first()->toArray();

        return response()->json(['dataProduct' => $productInWarehouse]);
    }

    /**
     * @throws Throwable
     */
    public function createRegisterPurchase(Request $req)
    {
        DB::beginTransaction();
        try {
            $dataRequest = $req->toArray();

            $invoiceSystem = NULL;

            // Search in PurchasesRecords table latest "invoiceSystemID" where "serialInvoice" and "numberInvoice" not exist
            if ($dataRequest['purchaseCountable'] === FALSE) {
                $latestInvoiceSystem = PurchasesRecords::select('invoiceSystemID')->orderBy('id', 'desc')->first();
                $invoiceSystem = (isset($latestInvoiceSystem->invoiceSystemNumber) && $latestInvoiceSystem->invoiceSystemNumber < 1) ? $latestInvoiceSystem->invoiceSystemNumber+1 : 1;
            }

            // Create new register in table PurchasesRecords
            $purchase = PurchasesRecords::create([
                "date_of_purchase" => $dataRequest['datePurchase'],
                "providerID" => $dataRequest['providerID'],
                "invoiceSystemID" => $invoiceSystem,
                "invoiceDetails" => [
                    "serialInvoice" => $dataRequest['serialInvoice'],
                    "numberInvoice" => $dataRequest['numberInvoice'],
                ],
                "invoiceCountable" => $dataRequest['purchaseCountable'],
                "itemsPurchase" => $dataRequest['items'],
                "inventoryRecords" => NULL,
                "purchaseVerified" => NULL]);

            // Create var to response with invoice Number
            (string) $invoiceResponse = ($dataRequest['purchaseCountable'] === TRUE) ? $purchase->invoiceDetails->serialInvoice."-".$purchase->invoiceDetails->numberInvoice : $invoiceSystem;

            DB::commit();
            return response()->json(['invoice' => $invoiceResponse, 'msg' => 'Success']);

        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @throws Throwable
     */
    public function verifyPurchase(int $idPurchase)
    {
        DB::beginTransaction();

        try {
            $invoice = PurchasesRecords::find($idPurchase);

            foreach ($invoice->itemsPurchase as $item) {
                $itemInInventory = InventoryOfWarehouseItems::where('itemID', $item->itemID)->first();

                if ($invoice->invoiceCountable === TRUE) {
                    $itemInInventory->quantity_countable += $item->purchaseQuantity;
                } else {
                    $itemInInventory->quantity_uncountable += $item->purchaseQuantity;
                }

                $itemInInventory->article_data = [
                    "presentations" => $item->presentations,
                    "price_purchase" => $item->price_purchase,
                    "others" => $itemInInventory->article_data->others.array_push($item->others)
                ];

                $itemInInventory->article_data_for_warehouse = [
                    "presentations" => $item->presentations,
                    "price_purchase" => $item->price_purchase,
                    "others" => $itemInInventory->article_data_for_warehouse->others.array_push($item->others)
                ];

                $itemInInventory->save();
            }

            $invoice->purchaseVerified = TRUE;
            DB::commit();

            return response()->json(['msg' => 'Purchase Verified Success']);

        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

}
