<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function dashboard(\Request $request)
    {

        // Initialize arrays for each hour (0-23)
        $timeSlots = array_map(function($hour) {
            return str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
        }, range(0, 23));

        $entries = array_fill(0, 24, 0);
        $exits = array_fill(0, 24, 0);

        // Query for entries (time_in) with access granted
        $entry_data = DB::table('entries')
            ->whereNotNull('time_in')
            ->where('access_granted', 1)
            ->whereDate('time_in', Carbon::today())
            ->select(DB::raw('HOUR(time_in) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('HOUR(time_in)'))
            ->get();

        // Query for exits (time_out)
        $exit_data = DB::table('entries')
            ->whereNotNull('time_out')
            ->where('access_granted', 1)
            ->whereDate('time_out', Carbon::today())
            ->select(DB::raw('HOUR(time_out) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('HOUR(time_out)'))
            ->get();



        // Process entry data into hourly slots
        foreach ($entry_data as $entry) {
            $entries[$entry->hour] = $entry->count;
        }

        // Process exit data into hourly slots
        foreach ($exit_data as $exit) {
            $exits[$exit->hour] = $exit->count;
        }

        $today_traffic_pattern = [
            'categories' => $timeSlots,
            'series' => [
                [
                    'name' => 'Entries',
                    'data' => array_values($entries)
                ],
                [
                    'name' => 'Exits',
                    'data' => array_values($exits)
                ]
            ]
        ];

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



        $today_traffic_pattern = [
            'Entries' => 0,
            'Exits' => 0,
        ];




        return view('dashboard',compact(
            'today_traffic_pattern',
            'today_total_access_granted',
            'today_total_access_exits',
            'today_total_access_denied',
            'total_entries',
        ));
    }
}
