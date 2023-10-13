<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Offer;
use App\Models\Tenant;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{
    /**
     * Display a listing of the license.
     */
    public function index()
    {
        return Inertia::render('License', [
            'licenses' => License::all()->transform(function($license) {
                return [
                    'id' => $license->id,
                    'offer'=> Offer::where('id','=', $license->offers_id)->pluck('description')[0],
                    'company' => Tenant::find(DB::table('tenants_has_licenses')->where('licenses_id','=',$license->id)->pluck('tenants_id')[0])->pluck('company')[0],
                    'status' => $license->status,
                    'purchased_at' => $license->created_at,
                    'expires_at' => $license->expires_at,
                ];
            }),
            'offers' => Offer::all(),
            'ongoing_licenses' => License::all()->where('expires_at','>', Carbon::now()),
            'expiring_licenses' => License::all()->whereBetween('expires_at', [Carbon::now(), Carbon::now()->addDays(10)])->all(),
            'expired_licenses' => License::all()->where('expires_at','<=', Carbon::now())
        ]);
    }

    /**
     * Show the form for creating a new license.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created license in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        // Insérer une licence
        // Insérer un tenant
        // Insérer leur relation dans tenants_has_licenses
        // Insérer un nom de domaine

        // Validation des données du formulaire
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'offer' => 'required|integer|max:36', 
        ]);

        // Licence
        // statut ENUM
        $licenseData = [
            'offers_id' => $validated['offer'],
            'status' => 'ACTIVE',
            'access_token' => Crypt::encryptString($validated['company']),
            'expires_at' => Carbon::now()->addSeconds(Offer::find($validated['offer'])->duration),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ];

        // Tenant
        $tenant = [
            'company' => $validated['company'],
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ];
        
        $license = License::create($licenseData);

        $tenant = Tenant::create($tenant);

        // Domain
        $licenseCount = License::all()->count()+1;
        $domainName = 'tenant' . $licenseCount++ . '.' . config('tenancy.central_domains')[0];
        $domain = [
            'domain' => $domainName
        ];

        $tenant->domains()->create($domain);

        DB::table('tenants_has_licenses')->insert([
            'tenants_id' => $tenant->id,
            'licenses_id' => $license->id
        ]);
       
    }

    /**
     * Display the specified license.
     */
    public function show(License $license)
    {
        //
    }

    /**
     * Show the form for editing the specified license.
     */
    public function edit(License $license)
    {
        //
    }

    /**
     * Update the specified license in storage.
     */
    public function update(Request $request, License $license)
    {
        //
    }

    /**
     * Remove the specified license from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
