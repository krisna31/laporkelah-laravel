<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('company', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $Company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $Company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $companies)
    {
        //
    }
}
