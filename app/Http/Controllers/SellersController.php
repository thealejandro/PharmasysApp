<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Sellers;

class SellersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = [];
        $sellers = Sellers::all();

        return response($sellers);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sellers  $sellers
     * @return \Illuminate\Http\Response
     */
    public function show(Sellers $sellers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sellers  $sellers
     * @return \Illuminate\Http\Response
     */
    public function edit(Sellers $sellers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sellers  $sellers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sellers $sellers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sellers  $sellers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sellers $sellers)
    {
        //
    }
}
