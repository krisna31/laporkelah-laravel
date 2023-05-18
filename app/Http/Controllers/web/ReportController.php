<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Report::class);

        if (request('search'))
            $reports = Report::where('judul', 'LIKE', '%' . request('search') . '%')->paginate(5);
        else
            $reports = Report::paginate(5);

        return view('superadmin.report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Report::class);
        return view('superadmin.report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Report::class);

        // validate request
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'foto' => 'required',
            'kategori' => 'required',
        ]);

        // Create a project with the validated data.
        $isSuccess = Report::create($validated);

        // Redirect the user to index page with a success notification or failed notification.
        return $isSuccess ?
            redirect()->route('report.index')->with('success', "Data report $request->judul Berhasil Dibuat")
            :
            redirect()->route('report.index')->with('failed', "Data report $request->judul Gagal Dibuat");
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
