<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Tenantcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $tenents=Tenant::with('domains')->get();
        return view('tenant.index',compact('tenents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenant.tenantCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        
        $validatedData = $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|string|email|max:255|unique:users", // Ensure email is unique in the users table
            'domain_name' => 'required|string|max:255|unique:domains,domain', // Ensure domain_name is unique in the domains table and follows the domain format
            'password' => 'required|string|min:8|confirmed', // Ensure password is at least 8 characters and matches the password_confirmation field
        ]);
        // dd($validatedData);

        $tenant = Tenant::create($validatedData);
        $tenant->domains()->create([
            'domain' => $validatedData['domain_name'].'.'.config('app.domain'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
