<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class TenantController extends Controller
{

    // Afficher tous les clients déjà enregistrés
    public function index()
    {
        // dd(Tenant::find('270f679c-6d75-460e-b674-e11f7d7eb554')->domains()->get());
        return Inertia::render('Tenants', [
            'tenants' => Tenant::all()->transform( function($tenant) {
                return [
                    'company' => $tenant->company,
                    'domain' => $tenant->domains()->get('domain'),
                    'db_name' => $tenant->tenancy_db_name,
                    'created_at' => $tenant->created_at
                ];
            })
        ]);
    }

    /**
     * Enregistre un client avec sa base de donnée et son domaine
    */
    public function store(Request $request)
    {

        // Vérifier la validité des données reçues du formulaire
        $validated = $request->validate([
            'offers_id' => 'required|integer',
            'company' => 'required|string|max:255',
        ]);

        $data = array_merge($validated, [
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id
        ]);
        $tenant = Tenant::create($data);
        
        
        // Création du domaine du client
        // $databaseName = 'tenant'.substr(UUIDGenerator::generate(''),0,10);
        $i = 0;
        $i++;
        $domainName = 'tenant' . $i . '.' . config('tenancy.central_domains')[0];
        $domain = $tenant->domains()->create(['domain' => $domainName]);
    }
}
