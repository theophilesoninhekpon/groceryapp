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
        return Inertia::render('Offers');
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
        //
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
