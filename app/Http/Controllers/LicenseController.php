<?php

namespace App\Http\Controllers;

use App\Events\ExpiredLicense;
use App\Events\ExpiringLicense;
use DateTime;
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

        return Inertia::render('License', [
            'licenses' => License::all()->transform(function($license) {
                return [
                    'id' => $license->id,
                    'offer'=> Offer::where('id','=', $license->offers_id)->pluck('description')[0],
                    'company' => Tenant::find(DB::table('tenants_has_licenses')->where('licenses_id','=',$license->id)->pluck('tenants_id'))->pluck('company')[0],
                    'status' => $license->status,
                    'purchased_at' => date_format($license->created_at, 'Y/m/d à H:i:s'),
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
            'email' => 'required|string|max:255',
            'offer' => 'required|integer|max:36', 
        ]);

        // Licence
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
            'email' => $validated['email'],
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
     * Check expiration date of license
     */

    /**
     * Update the specified license's offer in storage.
     */
    public function updateOffer(Request $request, License $license)
    {
        //
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
     * Update the specified license status dynamically.
     */
    public function updateStatus()
    {
        $licenses = License::all();

       foreach ($licenses as $license) {

             // Si la date d'expiration est passée, le statut de la licence passe expire (EXPIRED)
            if($license->expires_at < now()) { 
                $license->update([ 
                    'status' => 'INACTIVE'
                ]);
                
                // Déclencher l'évènement à l'expiration de la licence
                event(new ExpiredLicense($license));
                
                // si la date d'expiration est comprise entre la date actuelle et la date actuelle + 10 jours, le statut de la licence est en cours d'expiration (EXPIRING)
            } else if ($license->expires_at <= now()->addDays(10)  &&  $license->expires_at > now()) {    
                $license->update([ 
                    'status' => 'EXPIRING'
                ]);
                

                // Déclencher l'évènement quand la licence est à terme
                event(new ExpiringLicense($license));
            }
            return $license;
       }

    }



    /**
     * Remove the specified license from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
