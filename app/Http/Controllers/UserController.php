<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Company::class);

        if(auth()->user()->role_id === Role::$IS_SUPERADMIN) {
            if (request('search')) {
                $users = User::where('nama', 'LIKE', '%' . request('search') . '%')->paginate(5);
            } else {
                $users = User::paginate(5);
            }
            return view('superadmin.user.index', compact('users'));
        }

        $users = User::where(['is_public' => 1])->where('nama', 'LIKE', '%' . request('search') . '%')->paginate(5);
        $belongsTo = auth()->user()->company;
        return view('admin.user.index', compact('companies', 'belongsTo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Company::class);
        $companies = Company::all();
        $roles = Role::all();

        return view('user.create', compact('companies', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Company::class);

        // validate request
        $validated = $request->validated();
        $tempFile = TemporaryFile::where('folder', $request->img)->first();
        if ($tempFile) {
            $filename = uniqid() . '-' . $tempFile->filename;

            // Store the image at the specified path.
            File::copy(
                storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
                storage_path("app\\public\\company\\$filename")
            );

            // Get the logo file name.
            $validated['logo'] = $filename;
            File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
            $tempFile->delete();

            // Create a project with the validated data.
            User::create($validated);
            // Redirect the user to the project list.
            return redirect()->route('user.index')->with('success', "Data user $request->nama Berhasil Dibuat");
        }

        return redirect()->route('user.index')->with('failed', "Data user $request->nama Gagal Dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
