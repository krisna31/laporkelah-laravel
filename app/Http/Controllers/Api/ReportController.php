<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportApiRequest;
use App\Http\Requests\UpdateReportApiRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        })->orderBy('created_at', 'desc')->with('comments')->get();

        return ReportResource::collection($reports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportApiRequest $request)
    {
        $this->authorize('create', Report::class);
        try {
            // check folder exist or not
            if (!Storage::exists("app\\public\\report")) {
                File::makeDirectory(storage_path("app\\public\\report"), $mode = 0777, true, true);
            }
            $validated = $request->validated();
            $file = $request->file('foto');
            $folder = "public\\report";
            $filename = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs($folder, $filename);

            $validated['user_id'] = auth()->user()->id;
            $validated['company_id'] = $request->company_id;
            $validated['status'] = 1;
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
        $this->authorize('update', $report);
        try {
            // check folder exist or not
            if (!Storage::exists("app\\public\\report")) {
                File::makeDirectory(storage_path("app\\public\\report"), $mode = 0777, true, true);
            }
            if ($request->hasFile('foto')) {
                // delete old picture
                $image_path = public_path('/storage/report' . $report->foto);
                File::exists($image_path) && File::delete($image_path);

                $validated = $request->validated();
                $file = $request->file('foto');
                $folder = "public\\report";
                $filename = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs($folder, $filename);

                $validated['updated_by'] = auth()->user()->id;
                $validated['foto'] = $filename;
            } else {
                $validated = $request->validated();
                $validated['updated_by'] = auth()->user()->id;
            }
            $report->update($validated);
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
        $this->authorize('delete', $report);
        try {

            // delete old picture
            $image_path = public_path('/storage/report' . $report->foto);
            File::exists($image_path) && File::delete($image_path);

            $report->delete();
            return response()->json(null, 204);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }
}
