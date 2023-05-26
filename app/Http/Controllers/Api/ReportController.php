<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportApiRequest;
use App\Http\Requests\UpdateReportApiRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Report::class);
        $reports = Report::where(function ($query) {
            $query->where('company_id', auth()->user()->company_id)
                ->orWhereHas('company', function ($query) {
                    $query->where('is_public', 1);
                });
        })->get();

        return ReportResource::collection($reports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportApiRequest $request)
    {
        $this->authorize('create', Report::class);
        try {
            $validated = $request->validated();
            $file = $request->file('foto');
            $folder = "public\\report";
            $filename = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs($folder, $filename);

            $validated['foto'] = $filename;

            $report = Report::create($validated);

            return new ReportResource($report);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return new ReportResource($report);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportApiRequest $request, Report $report)
    {
        // $this->authorize('update', $report);
        try {
            $validated = $request->validated();
            $file = $request->file('foto');
            $folder = "public\\report";
            $filename = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs($folder, $filename);

            $validated['foto'] = $filename;

            $report = Report::create($validated);

            return new ReportResource($report);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
