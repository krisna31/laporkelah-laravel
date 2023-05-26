<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withReports = request()->reports;

        if ($withReports) {
            // get the report too from relationshiop in company model
            $companies = Company::where(function ($query) {
                $query->where('id', auth()->user()->company_id)
                    ->orWhere('is_public', 1);
            })->with('reports')->get();
        } else {
            // get the report too from relationshiop in company model
            $companies = Company::where(function ($query) {
                $query->where('id', auth()->user()->company_id)
                    ->orWhere('is_public', 1);
            })->get();
        }

        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $this->authorize('view', Company::class);
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        return abort(404);
    }
}
