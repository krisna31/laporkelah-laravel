<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        if (request('search'))
            $roles = Role::where('nama', 'LIKE', '%' . request('search') . '%')->paginate(5);
        else
            $roles = Role::paginate(5);

        return view('superadmin.role.index', compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('superadmin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        // validate request
        $validated = $request->validated();

        // Create a project with the validated data.
        $isSuccess = Role::create($validated);

        // Redirect the user to index page with a success notification or failed notification.
        return $isSuccess ?
                redirect()->route('role.index')->with('success', "Data role $request->jabatan Berhasil Dibuat")
                :
                redirect()->route('role.index')->with('failed', "Data role $request->jabatan Gagal Dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('view', Role::class);
        return view('superadmin.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        return view('superadmin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        // Update the project with the validated data.
        $isSuccess = $role->update($request->validated());

        // Redirect the user to index page with a success notification or failed notification.
        return $isSuccess ?
            redirect()->route('role.index')->with('success', "Data role $request->jabatan Berhasil Diubah")
            :
            redirect()->route('role.index')->with('failed', "Data role $request->jabatan Gagal Diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $isSuccess = $role->deleteOrFail();

        return $isSuccess ?
            redirect()->route('role.index')->with('success', 'Data ' . $role->jabatan . ' Berhasil Dihapus')
            :
            redirect()->route('role.index')->with('failed', 'Data ' . $role->jabatan . ' Gagal Dihapus');
    }
}
