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
        return Inertia::render('Tenants');
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
