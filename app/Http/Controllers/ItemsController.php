<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function createItem(Request $request)
    {
        $data = $request->toArray();
        DB::beginTransaction();

        try {

            $lastItem = Items::select('itemID')->orderBy('itemID', 'desc')->limit(1)->first(); //Find a last register for items
            $itemID = (isset($lastItem->itemID)) ? $lastItem->itemID+1 : 1; //Create new itemID

            $newItem = Items::create([
                'itemID' => $itemID,
                'codeBar' => $data['codeBar'],
                'name' => $data['name'],
                'category_id' => $data['category'],
                'laboratory_id' => $data['laboratory']
                                     ]);

            DB::commit();
            return response()->json(['itemID' => $newItem->itemID, 'name' => $newItem->name, 'msg' => 'Success created']);

        } catch (\Throwable $exception) {

            DB::rollBack();
            throw $exception;
        }
    }
}
