<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Providers;

class ProvidersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = [];
        $providers = Providers::all();

        return response($providers);
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
                $contact = $request->contact;

                Providers::create([
                    "name" => $name,
                    "contact_id" => $contact
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
     * @param  \App\Models\Providers  $providerId
     * @return \Illuminate\Http\Response
     */
    public function show(Providers $providerId)
    {
        return response($providerId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function edit(Providers $providers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Providers  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Providers $provider)
    {
        if (isset($request) && (is_array($request) || is_object($request)))
        {
            DB::beginTransaction();

            try {
                $provider->name = $request->name;
                $provider->contact_id = $request->contact;
                $provider->save();

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
     * @param  \App\Models\Providers  $providerId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Providers $providerId)
    {
        $providerId->delete();

        return response("Success delete => $providerId", 201);
    }
}
