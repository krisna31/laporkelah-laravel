<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Models\Company;
use App\Models\Report;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Report::class);

        // Get all projects.
        $companies = Company::with('reports')->get();

        return view('superadmin.report.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Report::class);
        $companies = Company::all();

        return view('superadmin.report.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        // $this->authorize('create', Report::class);

        // validate request
        $validated = $request->validated();
        $tempFile = TemporaryFile::where('folder', $request->img)->first();
        if ($tempFile) {
            $filename = uniqid() . '-' . $tempFile->filename;

            // check folder exist or not
            if (!Storage::exists("app\\public\\report")) {
                File::makeDirectory(storage_path("app\\public\\report"), $mode = 0777, true, true);
            }

            // Store the image at the specified path.
            File::copy(
                storage_path("app\\img\\tmp\\$tempFile->folder\\$tempFile->filename"),
                storage_path("app\\public\\report\\$filename")
            );

            // Get the foto file name.
            $validated['foto'] = $filename;
            File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
            $tempFile->delete();

            // Create a project with the validated data.
            Report::create($validated);
            return redirect()->route('report.index')->with('success', "Data report $request->judul Berhasil Dibuat");
        }


        // Redirect the user to index page with a failed notification.
        return redirect()->route('report.index')->with('failed', "Data report $request->judul Gagal Dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        // $this->authorize('view', $report);
        return view('superadmin.report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        // $this->authorize('update', $report);
        return view('superadmin.report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        // $this->authorize('update', $report);

        // validate request
        $validated = $request->validated();

        // Update the project with the validated data.
        $isSuccess = $report->update($validated);

        // Redirect the user to index page with a success notification or failed notification.
        return $isSuccess ?
            redirect()->route('report.index')->with('success', "Data report $request->judul Berhasil Diubah")
            :
            redirect()->route('report.index')->with('failed', "Data report $request->judul Gagal Diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        // $this->authorize('delete', $report);

        // Delete the project.
        $isSuccess = $report->deleteOrFail();

        // Redirect the user to index page with a success notification or failed notification.
        return $isSuccess ?
            redirect()->route('report.index')->with('success', "Data report $report->judul Berhasil Dihapus")
            :
            redirect()->route('report.index')->with('failed', "Data report $report->judul Gagal Dihapus");
    }
}
