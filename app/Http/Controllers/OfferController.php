<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfferController extends Controller
{
     /**
     * Display a listing of the offer.
     */
    public function index()
    {
        return Inertia::render('Offers', [
            'offers' => Offer::all()
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
            'duration' => $validated['duration'],
            'number_of_users' => $validated['numberOfUsers'],
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id
        ];
        
        Offer::create($data);
        // dd($offer);
        return to_route('offers');
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
        //
    }

    /**
     * Remove the specified offer from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
