<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Models\Company;
use App\Models\Report;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == Role::$IS_USER) {
            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('login')->with('failed', "You don't have permission to access this webpage with user account, Please use the admin account");
        }

        $this->authorize('isAdmin');

        if (auth()->user()->role_id == Role::$IS_SUPERADMIN) {
            $users = User::orderBy('created_at', 'desc')->get();
            $roles = Role::all();
            $companies = Company::all();
            $reports = Report::orderBy('created_at', 'desc')->get();
            $chart = new LaravelChart([
                'chart_title' => 'Users by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'bar',
                'chart_color' => '10, 20, 30',
            ], [
                'chart_title' => 'Reports by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Report',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'bar',
                'chart_color' => '255,0,0',
            ], [
                'chart_title' => 'Comments by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Comment',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'bar',
                'chart_color' => '0,255,0',
            ]);

            $chart2 = new LaravelChart([
                'chart_title' => 'Reports by Status',
                'report_type' => 'group_by_string',
                'model' => 'App\Models\Report',
                'group_by_field' => 'status',
                'labels' => ['0' => 'Close', '1' => 'Open'],
                'chart_color' => [
                    'Close' => '200,12,12', 'Open' => '0,255,0'
                ],
                'chart_type' => 'pie',
            ]);

            $chart3 = new LaravelChart([
                'chart_title' => 'Users by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'pie',
            ]);

            $now = date('Y-m-d H:i:s');

            $chart4 = new LaravelChart([
                'chart_title' => 'Reports by Days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Report',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'filter_field' => 'created_at',
                'filter_days' => 7,
                'chart_type' => 'line',
                'continuous_time' => true,
                'chart_color' => '255,0,0',
            ], [
                'chart_title' => 'Comments by Days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Comment',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'filter_field' => 'created_at',
                'filter_days' => 7,
                'chart_type' => 'line',
                'continuous_time' => true,
                'chart_color' => '1,255,0',
            ]);
        } else {
            $users = User::where(['company_id' => auth()->user()->company_id])->orderBy('created_at', 'desc')->get();
            $roles = Role::all();
            $companies = Company::where(function ($query) {
                $query->where('id', auth()->user()->company_id)
                    ->orWhere('is_public', 1);
            })->get();
            $reports = Report::where(function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            })->orderBy('created_at', 'desc')->get();
            $companyId = auth()->user()->company_id;
            $chart = new LaravelChart([
                'chart_title' => 'Users by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'bar',
                'chart_color' => '10, 20, 30',
                'where_raw' => "company_id = $companyId",
            ], [
                'chart_title' => 'Reports by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Report',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'bar',
                'chart_color' => '255,0,0',
                'where_raw' => "company_id = $companyId",
            ], [
                'chart_title' => 'Comments by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Comment',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'bar',
                'chart_color' => '0,255,0',
                'where_raw' => "report_id in(select id from reports where company_id = $companyId)",
            ]);

            $chart2 = new LaravelChart([
                'chart_title' => 'Reports by Status',
                'report_type' => 'group_by_string',
                'model' => 'App\Models\Report',
                'group_by_field' => 'status',
                'labels' => ['0' => 'Close', '1' => 'Open'],
                'chart_type' => 'pie',
                'where_raw' => "company_id = $companyId",
            ]);

            $chart3 = new LaravelChart([
                'chart_title' => 'Users by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'pie',
                'chart_color' => '10, 20, 30',
                'where_raw' => "company_id = $companyId",
            ]);
        }

        return view(
            'dashboard',
            compact(
                'users',
                'roles',
                'companies',
                'reports',
                'chart',
                'chart2',
                'chart3',
                'chart4',
            )
        );
    }
}
