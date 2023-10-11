<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    /**
     * Display a listing of the license.
     */
    public function index()
    {
        return Inertia::render('License');
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
        //
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
