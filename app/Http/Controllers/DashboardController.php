<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Models\Company;
use App\Models\Report;
use App\Models\Role;
use App\Models\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
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
                'chart_title' => 'Reports by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Report',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'pie',
                'style_class' => 'w-1/2 h-1/2'
            ]);

            $chart3 = new LaravelChart([
                'chart_title' => 'Users by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'pie',
                'chart_color' => '10, 20, 30',
            ]);
        } else {
            $users = User::where(['company_id' => auth()->user()->company_id])->orderBy('created_at', 'desc')->get();
            $roles = Role::all();
            $companies = Company::where(function ($query) {
                $query->where('id', auth()->user()->company_id)
                    ->orWhere('is_public', 1);
            })->get();
            $reports = Report::orderBy('created_at', 'desc')->get();
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
                'chart_title' => 'Reports by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Report',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'pie',
                'style_class' => 'w-1/2 h-1/2'
            ]);

            $chart3 = new LaravelChart([
                'chart_title' => 'Users by years',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'year',
                'chart_type' => 'pie',
                'chart_color' => '10, 20, 30',
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
            )
        );
    }
}
