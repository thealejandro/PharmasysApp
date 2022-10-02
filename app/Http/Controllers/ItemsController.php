<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Items;

class ItemsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = [];
        $items = Items::all();

        return response($items);
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
                $codebar    = $request->codebar;
                $name       = $request->name;
                $category   = $request->category;
                $laboratory = $request->laboratory;
                $generic    = $request->generic;

                Items::create([
                    "codebar" => $codebar,
                    "name" => $name,
                    "category_id" => $category,
                    "laboratory_id" => $laboratory,
                    "generic" => $generic,
                ]);

                DB::commit();
                return response("Success save", 201);
            } catch (\Throwable $th) {
                DB::rollback();
                return response("Fail => $th", 500);
                throw $th;
            }
        }

        return response("No data", 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $itemId
     * @return \Illuminate\Http\Response
     */
    public function show(Items $itemId)
    {
        return response($itemId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $item)
    {
        if (isset($request) && (is_array($request) || is_object($request)))
        {
            DB::beginTransaction();

            try {
                $item->codebar = $request->codebar;
                $item->name     = $request->name;
                $item->category_id = $request->category;
                $item->laboratory_id = $request->laboratory;
                $item->generic      = $request->generic;
                $item->save();

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
     * @param  \App\Models\Items  $itemId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $itemId)
    {
        $itemId->delete();

        return response("Delete item => $itemId", 201);
    }
}
