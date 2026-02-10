<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['reporter', 'reportable'])->latest()->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function users()
    {
        $reports = Report::where('reportable_type', 'App\Models\User')
            ->with(['reporter', 'reportable'])
            ->latest()
            ->get();
        return view('admin.reports.users', compact('reports'));
    }
    public function posts()
    {
        $reports = Report::where('reportable_type', 'App\Models\Post')
            ->with(['reporter', 'reportable'])
            ->latest()
            ->get();
        return view('admin.reports.posts', compact('reports'));
    }
    public function repositories()
    {
        $reports = Report::where('reportable_type', 'App\Models\Repository')
            ->with(['reporter', 'reportable'])
            ->latest()
            ->get();
        return view('admin.reports.repositories', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reportable_id' => 'required',
            'reportable_type' => 'required',
            'reason' => 'required',
        ]);

        $type = 'App\\Models\\' . ucfirst($request->reportable_type);

        \App\Models\Report::create([
            'reporter_id' => auth()->id(),
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $type,
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Report submitted successfully. Admin will review it.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->reportable->delete();
        $report->delete();
        return back()->with('success', 'Content deleted successfully.');
    }
}
