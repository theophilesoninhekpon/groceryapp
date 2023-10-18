<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Offer;
use App\Models\Tenant;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Client', [
            'clients' =>  Tenant::all()->transform(function ($tenant) {
                return [
                    'id' => $tenant->id,
                    'company' => $tenant->company,
                    'offer' => Offer::find(License::find(DB::table('tenants_has_licenses')->where('tenants_id', '=', $tenant->id)->pluck('licenses_id')))->pluck('description')[0],
                    'status' => License::find(DB::table('tenants_has_licenses')->where('tenants_id', '=', $tenant->id)->pluck('licenses_id'))->pluck('status')[0],
                    'database' => $tenant->tenancy_db_name,
                    'domain' => $tenant->domains()->pluck('domain')[0]
                ];
            })
        ]);
    }

    // 'company' offer status database domain
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
