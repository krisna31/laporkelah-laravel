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

        for ($days_backwards = 2; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $data->push(User::whereDate('created_at', today()->subDays($days_backwards))->count());
        }

        $chart = new UserChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('My dataset', 'line', $data);

        return view('dashboard', compact('users', 'roles', 'companies', 'reports', 'chart'));
    }
}
