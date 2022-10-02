<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Laboratories;

class LaboratoriesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratories = [];
        $laboratories = Laboratories::all();

        return response($laboratories);
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
                $name = $request->name;
                $provider = $request->provider;
                $contact = (isset($request->contact)) ? $request->contact : null;

                Laboratories::create([
                    "name"  => $name,
                    "provider_id"  => $provider,
                    "contact_id"   => $contact
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
     * @param  \App\Models\Laboratories  $laboratoryId
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratories $laboratoryId)
    {
        return response($laboratoryId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laboratories  $laboratories
     * @return \Illuminate\Http\Response
     */
    public function edit(Laboratories $laboratories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratories  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratories $laboratory)
    {
        if (isset($request) && (is_array($request) || is_object($request)))
        {
            DB::beginTransaction();

            try {
                $laboratory->name = $request->name;
                $laboratory->provider_id = $request->laboratory;
                $laboratory->contact_id = $request->contact;
                $laboratory->save();

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
     * @param  \App\Models\Laboratories  $laboratoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratories $laboratoryId)
    {
        $laboratoryId->delete();

        return response("Success delete => $laboratoryId", 201);
    }
}
