<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Offer;
use App\Events\OfferCreate;
use Illuminate\Http\Request;
use App\Events\ExpiredLicense;

class OfferController extends Controller
{

     /**
     * Display a listing of the offer.
     */
    public function index()
    {
        return Inertia::render('Offers', [
            'offers' => Offer::all()->transform(function ($offer) {
                return [
                    'id' => $offer->id,
                    'description' => $offer->description,
                    'number_of_users' => $offer->number_of_users
                ];
            })
        ]);
    }


    /**
     * Show the form for creating a new offer.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created offer in storage.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'numberOfUsers' => 'required|integer|max:200'
        ]);

        $data = [
            'description' => $validated['description'],
            'number_of_users' => $validated['numberOfUsers'],
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id
        ];
        
        $offer = Offer::create($data);
        
        event(new OfferCreate($offer));

    }

    /**
     * Display the specified offer.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified offer.
     */
    public function edit(Offer $offer)
    {
        //
    }

    
    /**
     * Update the specified offer in storage.
     */
    public function update(Request $request, Offer $offer)
    {
    
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'numberOfUsers' => 'required|integer|max:200'
        ]);

        $data = [
            'description' => $validated['description'],
            'number_of_users' => $validated['numberOfUsers'],
            'updated_by' => $request->user()->id
        ];

        $offer->update($data);

    }

    /**
     * Remove the specified offer from storage.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
    }
}
