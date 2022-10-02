<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Contacts;

class ContactsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = [];
        $contacts = Contacts::all();

        return response($contacts);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request) && $request !== null && is_object($request))
        {
            DB::beginTransaction();
            try {
                $name = $request->name;
                $data = json_encode($request->data);
                $notes = (isset($request->notes)) ? $request->notes : null;

                Contacts::create([
                    'name' => $name,
                    'data' => $data,
                    'notes' => $notes,
                ]);

                DB::commit();
                return response("Success", 201);
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
     * @param  \App\Models\Contacts  $contactId
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contactId)
    {
        return response($contactId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacts  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contact)
    {
        if (isset($request) && (is_array($request) || is_object($request)))
        {
        DB::beginTransaction();
        try {
                $contact->name = $request->name;
                $contact->data = $request->data;
                $contact->notes = $request->notes;
                $contact->save();

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
     * @param  \App\Models\Contacts  $contactId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contactId)
    {
        $contactId->delete();

        return response("Delete contact => $contactId", 201);
    }
}
