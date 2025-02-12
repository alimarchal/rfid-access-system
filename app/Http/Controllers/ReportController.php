<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function allReports()
    {
        return view('reports.all-reports');
    }

    public function accessActivity(Request $request)
    {
        $query = Entry::with('user'); // Load related user data

        // Apply filters
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('gate')) {
            $query->where('gate', 'LIKE', '%' . $request->gate . '%');
        }

        // Paginate results
        $entries = $query->latest()->paginate(10);

        return view('reports.access-activity', compact('entries'));
    }

    public function familyMemberAccessReport(Request $request)
    {
        $query = FamilyMember::with('entries'); // Load related access entries

        // Apply filters
        if ($request->filled('date')) {
            $query->whereHas('entries', function ($q) use ($request) {
                $q->whereDate('created_at', $request->date);
            });
        }
        if ($request->filled('family_id')) {
            $query->where('family_id', $request->family_id);
        }

        // Paginate results
        $familyMembers = $query->latest()->paginate(10);

        return view('reports.family-access', compact('familyMembers'));
    }

    public function RfidReport()
    {
        return view('reports.rfid-report');
    }

    public function guardReport()
    {
        return view('reports.guard-activity');
    }

    public function AgriReport()
    {
        return view('reports.aggregate-report');
    }
}
