<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
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

        $data = collect([]); // Could also be an array

        $uniqueYearUser = User::selectRaw('YEAR(created_at) year')
            ->orderBy('year')
            ->distinct()
            ->pluck('year');

        foreach ($uniqueYearUser as $key => $value) {
            $data->push(User::whereYear('created_at', $value)->count());
        }

        $chart = new UserChart;
        $chart->labels($uniqueYearUser);
        $chart->dataset('Total User Register', 'line', $data);

        return view('dashboard', compact('users', 'roles', 'companies', 'reports', 'chart'));
    }
}
