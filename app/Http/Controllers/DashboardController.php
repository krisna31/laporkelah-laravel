<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Report;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin');

        // get user order by created_at
        $users = User::orderBy('created_at', 'desc')->get();
        $roles = Role::all();
        $companies = Company::all();
        $reports = Report::all();

        return view('dashboard', compact('users', 'roles', 'companies', 'reports'));
    }
}
