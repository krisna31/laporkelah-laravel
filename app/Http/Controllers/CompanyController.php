<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Company::class);

        if(auth()->user()->role_id === Role::$IS_SUPERADMIN) {
            if (request('search')) {
                $companies = Company::where('nama', 'LIKE', '%' . request('search') . '%')->paginate(5);
            } else {
                $companies = Company::paginate(5);
            }
            return view('superadmin.company.index', compact('companies'));
        }

        $companies = Company::where(['is_public' => 1])->where('nama', 'LIKE', '%' . request('search') . '%')->paginate(5);
        $belongsTo = auth()->user()->company;
        return view('admin.company.index', compact('companies', 'belongsTo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Company::class);

        return view('superadmin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        // validate request
        $validated = $request->validated();
        $tempFile = TemporaryFile::where('folder', $request->img)->first();
        dd($request);
        // dd(TemporaryFile::where(['folder'=>$request->img])->get());
        if ($tempFile) {
            $filename = uniqid() . '-' . $tempFile->filename;
            File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
            $tempFile->delete();

            // Store the image at the specified path.
            File::copy(
                storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
                storage_path("app\\public\\company\\$filename")
            );

            // Get the logo file name.
            $validated['logo'] = $filename;

            // Create a project with the validated data.
            Company::create($validated);
            // Redirect the user to the project list.
            return redirect()->route('company.index')->with('success', "Data Company $request->nama Berhasil Dibuat");
        }

        return redirect()->route('company.index')->with('failed', "Data Company $request->nama Gagal Dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $this->authorize('view', $company);

        return view('superadmin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);


        return view('superadmin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);
        // validate request
        $validated = $request->validated();

        if ($request->img) {
            // delete old picture
            $image_path = 'public/storage/company/' . $company->logo;
            Storage::exists($image_path) && Storage::delete($image_path);

            // create new one
            $tempFile = TemporaryFile::where('folder', $request->img)->first();
            if ($tempFile) {
                $filename = uniqid() . '-' . $tempFile->filename;
                FIle::copy(
                    storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
                    storage_path("app\\public\\company\\$filename")
                );
                File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
                $tempFile->delete();
            }
            $validated['logo'] = $filename;
            $company->update($validated);
        } else
            $company->update([
                'nama' => $validated['nama'],
                'is_public' => $validated['is_public']
            ]);

        return redirect()->route('company.index')->with('success', 'Data ' . $company->nama . ' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        $success = $company->deleteOrFail();

        if ($success) return redirect()->route('company.index')->with('success', 'Data Berhasil Dihapus');

        return redirect()->route('company.index')->with('failed', 'Data ' . $company->nama . ' Gagal Dihapus');
    }
}
