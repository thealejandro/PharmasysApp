<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = [];
        $categories = Categories::all();

        return response($categories);
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
                $newCategory = $request->nameCategory;
                Categories::create([
                    'name' => $newCategory
                ]);

                DB::commit();
                return response("Success", 201);
            } catch (\Throwable $th) {
                DB::rollback();
                return response("Error => $th", 500);
                throw $th;
            }

        }

        return response("No data", 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categoryId)
    {
        return response("Show => $categoryId->id, with name => $categoryId->name");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categoryId)
    {
        return response("Success => $categoryId");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $category)
    {
        if (isset($request) && (is_array($request) || is_object($request))) {
            $category->name = $request->name;
            $category->save();
        }
        return response("Success update => $category", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        $category->delete();
        return response("Delete category => $category", 201);
    }
}
