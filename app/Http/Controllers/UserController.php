<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['reporter', 'reportable'])
            ->latest()
            ->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $report->update(['status' => $request->status]);
        return back()->with('success', 'Report status updated successfully');
    }
}
