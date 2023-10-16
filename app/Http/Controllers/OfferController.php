<?php

namespace App\Http\Controllers;

use App\Events\OfferCreate;
use Inertia\Inertia;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
                    'duration' => ($offer->duration) / (30 * 24 * 60 * 60),
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
            'duration' => 'required|integer|max:36', 
            'numberOfUsers' => 'required|integer|max:200'
        ]);
        $data = [
            'description' => $validated['description'],
            'duration' => $validated['duration'] * 30 * 24 * 60 * 60,
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
     * Retrieve a specified offer.
     */
    public function getOffer(Offer $offer)
    {
        return Offer::find($offer);
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
            'duration' => 'required|integer|max:36', 
            'numberOfUsers' => 'required|integer|max:200'
        ]);

        $data = [
            'description' => $validated['description'],
            'duration' => $validated['duration'] * 30 * 24 * 60 * 60,
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
