<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        // validate request
        $validated = $request->validated();
        $tempFile = TemporaryFile::where('folder', $request->img)->first();
        $filename = uniqid() . '-' . $tempFile->filename;

        // Store the image at the specified path.
        FIle::copy(storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
             storage_path("app\\public\\company\\$filename"));

        // Get the logo file name.
        $validated['logo'] = $filename;

        // Create a project with the validated data.
        Company::create($validated);

        if ($tempFile) {
            File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
        }
        $tempFile->delete();

        // Redirect the user to the project list.
        return redirect()->route('company.index')->with('success', "Data Company $request->nama Berhasil Dibuat");
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
