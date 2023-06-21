<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        if (auth()->user()->role_id === Role::$IS_SUPERADMIN) {
            if (request('search')) {
                $users = User::where('name', 'LIKE', '%' . request('search') . '%')->orderBy('created_at', 'desc')->paginate(Utils::$PAGINATE);
            } else {
                $users = User::orderBy('created_at', 'desc')->paginate(Utils::$PAGINATE);
            }
            return view('superadmin.user.index', compact('users'));
        }

        $users = User::where(['company_id' => auth()->user()->company_id])
            ->where('name', 'LIKE', '%' . request('search') . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(Utils::$PAGINATE);
        return view('superadmin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $companies = auth()->user()->role_id == Role::$IS_SUPERADMIN ? Company::all() : Company::where('id', '=', auth()->user()->company_id)->get();
        $roles = Role::where('id', '>=', auth()->user()->role_id)->get();

        return view('user.create', compact('companies', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        // validate request
        $validated = $request->validated();
        $tempFile = TemporaryFile::where('folder', $request->img)->first();
        if ($tempFile) {
            $filename = uniqid() . '-' . $tempFile->filename;

            // check folder exist or not
            if (!Storage::exists("app\\public\\user")) {
                File::makeDirectory(storage_path("app\\public\\user"), $mode = 0777, true, true);
            }

            // Store the image at the specified path.
            File::copy(
                storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
                storage_path("app\\public\\user\\$filename")
            );

            // Get the logo file name.
            $validated['foto'] = $filename;
            File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
            $tempFile->delete();

            $validated['password'] = $validated['password'] ? bcrypt($validated['password']) : bcrypt('password');

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
        $this->authorize('view', $user);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $companies = Company::all();
        $roles = Role::all();

        return view('user.edit', compact('user', 'companies', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        // validate request
        $validated = $request->validated();

        $validated['password'] = $validated['password'] ? bcrypt($validated['password']) : $user->password;
        $validated['company_id'] = $validated['role_id'] == Role::$IS_SUPERADMIN ?
            null : $validated['company_id'];

        if ($request->img) {
            // check folder exist or not
            if (!Storage::exists("app\\public\\user")) {
                File::makeDirectory(storage_path("app\\public\\user"), $mode = 0777, true, true);
            }

            // delete old picture
            $image_path = public_path('/storage/user/' . $user->foto);
            File::exists($image_path) && File::delete($image_path);

            // create new one
            $tempFile = TemporaryFile::where('folder', $request->img)->first();
            if ($tempFile) {
                $filename = uniqid() . '-' . $tempFile->filename;
                File::copy(
                    storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
                    storage_path("app\\public\\user\\$filename")
                );
                File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
                $tempFile->delete();
            }
            $validated['foto'] = $filename;
            $user->update($validated);
        } else
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role_id' => $validated['role_id'],
                'company_id' => $validated['company_id'],
                'password' => $validated['password'],
            ]);

        return redirect()->route('user.index')->with('success', 'Data ' . $user->name . ' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $image_path = public_path('/storage/user/' . $user->foto);
        File::exists($image_path) && File::delete($image_path);
        $success = $user->deleteOrFail();

        if ($success)
            return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus');

        return redirect()->route('user.index')->with('failed', 'Data ' . $user->nama . ' Gagal Dihapus');
    }
}