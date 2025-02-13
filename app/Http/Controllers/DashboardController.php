<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function dashboard(\Request $request)
    {
        $today_total_access_granted = DB::table('entries')
            ->whereNotNull('time_in')
            ->whereDate('time_in', Carbon::today())
            ->count();  // Added count() to get the total number

        $today_total_access_exits = DB::table('entries')
            ->whereNotNull('time_out')
            ->whereDate('time_out', Carbon::today())
            ->count();  // Added query for denied entries


        $today_total_access_denied = DB::table('entries')
            ->whereNotNull('time_in')
            ->whereDate('time_in', Carbon::today())
            ->where('access_granted', 0)
            ->count();  // Added query for denied entries


        $total_entries = DB::table('entries')
            ->whereDate('created_at', Carbon::today())
            ->count();  // Added query for denied entries

        return view('dashboard',compact(
            'today_total_access_granted',
            'today_total_access_exits',
            'today_total_access_denied',
            'total_entries',
        ));
    }
}
