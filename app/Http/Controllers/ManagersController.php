<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Managers;

class ManagersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = [];
        $managers = Managers::all();

        return response($managers);
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
                $user = $user;
                $userApprove = Auth::id();

                Managers::create([
                    "user_id" => $user,
                    "user_approve_id" => $userApprove
                ]);

                DB::commit();
                return response("Success create", 201);
            } catch (\Throwable $th) {
                DB::rollback();
                return response("Fail create => $th", 500);
                throw $th;
            }
        }

        return response("No data", 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managers  $managerId
     * @return \Illuminate\Http\Response
     */
    public function show(Managers $managerId)
    {
        return response($managerId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managers  $managers
     * @return \Illuminate\Http\Response
     */
    public function edit(Managers $managers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managers  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Managers $manager)
    {
        if (isset($request) && (is_array($request) || is_object($request)))
        {
            DB::beginTransaction();

            try {
                $manager->user_id = $request->user;
                $manager->user_approve_id = Auth::id();
                $manager->save();

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
     * @param  \App\Models\Managers  $managerId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Managers $managerId)
    {
        $managerId->delete();

        return response("Success delete => $managerId", 201);
    }
}
