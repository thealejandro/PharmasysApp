<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SalesRecords;

class SalesRecordsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesRecords = [];
        $salesRecords = SalesRecords::all();

        return response($salesRecords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request) && $request !== null && is_object($request))
        {
            DB::beginTransaction();

            try {
                $user = Auth::id();
                $seller = $request->seller;
                $store = $request->store;
                $has_invoice = $request->invoice;
                $invoice_details = (isset($request->invoiceDetails)) ? $request->invoiceDetails : null;
                $dataItems = $request->dataItems;

                SalesRecords::create([
                    "user_id" => $user,
                    "seller_id" => $seller,
                    "store_id" => $store,
                    "has_invoice" => $has_invoice,
                    "invoice_details" => $invoice_details,
                    "sale_data" => $dataItems
                ]);

                DB::commit();
                return response("Success", 201);
            } catch (\Throwable $th) {
                DB::rollback();
                return response("Fail store => $th", 500);
                throw $th;
            }
        }

        return response("No data", 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesRecords  $recordId
     * @return \Illuminate\Http\Response
     */
    public function show(SalesRecords $recordId)
    {
        return response($saleRecordId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesRecords  $salesRecords
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesRecords $salesRecords)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesRecords  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesRecords $record)
    {
        if (isset($request) && (is_array($request) || is_object($request)))
        {
            DB::beginTransaction();

            try {
                $record->has_invoice = $request->hasInvoice;
                $record->invoice_details = $request->invoice_details;
                $record->sale_data = $request->saleData;
                $record->save();

                DB::commit();
                return response("Success update");
            } catch (\Throwable $th) {
                DB::rollback();
                return response("Fail update => $th", 500);
                throw $th;
            }
        }

        return response("No data", 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesRecords  $recordId
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesRecords $recordId)
    {
        $recordId->delete();
        return response("Success delete => $recordId", 201);
    }
}
