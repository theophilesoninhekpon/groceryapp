<?php

namespace App\Http\Controllers;

use App\Events\ExpiredLicense;
use App\Events\ExpiringLicense;
use App\Events\LicenseCreated;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Offer;
use App\Models\Tenant;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{
    /**
     * Display a listing of the license.
     */
    public function index()
    {

        // Renvoyer toute licences avec des informations complémentaires
        return Inertia::render('License', [
            'licenses' => License::all()->transform(function ($license) {
                return [
                    'id' => $license->id,
                    // L'offre de la licence
                    'offer' => Offer::where('id', '=', $license->offers_id)->pluck('description')[0],
                    // Le nom de l'entreprise ayant acheté la licence
                    'company' => Tenant::find(DB::table('tenants_has_licenses')->where('licenses_id', '=', $license->id)->pluck('tenants_id'))->pluck('company')[0],
                    'status' => $license->status,
                    'purchased_at' => date_format($license->created_at, 'Y/m/d à H:i:s'),
                    'expires_at' => $license->expires_at, 
                ];
            }),
            'offers' => Offer::all(),
            // Les statistiques des licences
            'ongoing_licenses' => count(License::all()->where('status', '=', 'ACTIVE')->all()),
            'expiring_licenses' => count(License::all()->where('status', '=', 'EXPIRING')->all()),
            'expired_licenses' => count(License::all()->where('status', '=', 'INACTIVE')->all())
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
     * Enregistre un nouveau client (Tenant)
     */
    public function storeTenant($data, $request)
    {

        $tenantData = [
            'company' => $data['company'],
            'email' => $data['email'],
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ];

        $tenant = Tenant::create($tenantData);
        
        return $tenant;

    }


    /**
     * Enregistre une nouvelle licence (License)
     */

    public function storeLicense($data, $request)
    {

        $licenseData = [
            'offers_id' => $data['offer'],
            'status' => 'ACTIVE',
            'access_token' => Crypt::encryptString($data['company']),
            'expires_at' => Carbon::now()->addSeconds(Offer::find($data['offer'])->duration),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ];

        $license = License::create($licenseData);

        return $license;

    }


    /**
     * Enregistre un nouveau domaine (Domain) 
     */

    public function storeDomain($tenant)
    {

        $licenseCount = License::all()->count() + 1;
        $domainName = 'tenant' . $licenseCount++ . '.' . config('tenancy.central_domains')[0];

        $domainData = [
            'domain' => $domainName
        ];

        $tenant->domains()->create($domainData);

    }


    /**
     * Enregistre un relation entre un client et une licence
     */

     public function tenantHasLicense($tenant, $license) {

        DB::table('tenants_has_licenses')->insert([
            'tenants_id' => $tenant->id,
            'licenses_id' => $license->id
        ]);

     }


    /**
     * Store a newly created license in storage.
     */
    public function store(Request $request)
    {

        // Validation des données du formulaire
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'offer' => 'required|integer|max:36',
        ]);

        $license = $this->storeLicense($validated, $request);

        $tenant = $this->storeTenant($validated, $request);

        $this->storeDomain($tenant, $license);

        $this->tenantHasLicense($tenant, $license);

        event(new LicenseCreated($license));

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
     * Check expiration date of license
     */

    /**
     * Update the specified license's offer in storage.
     */
    public function update(Request $request, int $licenseId)
    {
        
        $license = License::find($licenseId);

        // Mettre à jour la date d'expiration si l'offre changeante est supérieure à l'offre à changer
        // Mettre à jour la date d'expiration si l'offre changeante est inférieure à l'offre à changer et si il n'a pas encore atteint la date d'expiration de l'offre actuelle
        // Sinon pas de changement
        // expires_at = activated_at + duree de l'offre changeante

        // Mettre à jour le nombre d'utilisateurs à créer
        // Checker le nombre de users dans la base de données du tenant 
        // Si le nombre de users est inférieur à celui de l'offre changeante, alors on met à jour
        // Sinon pas de changement
    }

    /**
     * Remove the specified license from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
