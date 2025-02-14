<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function dashboard(\Request $request)
    {
        // Time slots logic
        $timeSlots = array_map(function($hour) {
            return str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
        }, range(0, 23));

        $entries = array_fill(0, 24, 0);
        $exits = array_fill(0, 24, 0);

        // Entry/exit data for traffic pattern
        $entry_data = DB::table('entries')
            ->whereNotNull('time_in')
            ->where('access_granted', 1)
            ->whereDate('time_in', Carbon::today())
            ->select(DB::raw('HOUR(time_in) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('HOUR(time_in)'))
            ->get();

        $exit_data = DB::table('entries')
            ->whereNotNull('time_out')
            ->where('access_granted', 1)
            ->whereDate('time_out', Carbon::today())
            ->select(DB::raw('HOUR(time_out) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('HOUR(time_out)'))
            ->get();

        // Process entry/exit data
        foreach ($entry_data as $entry) {
            $entries[$entry->hour] = $entry->count;
        }

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

        // Metrics with error handling
        try {
            // Access granted count - only count unique successful accesses
            $today_total_access_granted = DB::table('entries')
                ->where('access_granted', 1)
                ->whereDate('created_at', Carbon::today())
                ->count();

            // Today's entries in - count actual entries
            $today_entries_in = DB::table('entries')
                ->whereNotNull('time_in')
                ->whereDate('time_in', Carbon::today())
                ->where('access_granted', 1)
                ->count();

            // Today's exits count
            $today_total_access_exits = DB::table('entries')
                ->whereNotNull('time_out')
                ->whereDate('time_out', Carbon::today())
                ->count();

            // Access denied count
            $today_total_access_denied = DB::table('entries')
            ->where('access_granted', 0)
            ->whereDate('created_at', Carbon::today()) // Check entry creation date
            ->orWhere(function ($query) {
                $query->where('access_granted', 0)
                      ->whereDate('time_in', Carbon::today()) // Also check time_in
                      ->orWhereDate('time_out', Carbon::today()); // Also check time_out
            })
            ->count();
            $total_citizens = DB::table('users')->count();
            $total_vehicles = DB::table('vehicles')->count();

            // RFID card metrics with expiration check
            $current_date = Carbon::now();
            
            $total_RFID_cards = DB::table('rfid_cards')
                ->where('status', 'active')
                ->where(function($query) use ($current_date) {
                    $query->where('expiry_date', '>', $current_date)
                          ->orWhereNull('expiry_date');
                })
                ->count();

            $total_inactive_cards = DB::table('rfid_cards')
                ->where('status', 'inactive')
                ->count();

            $total_expired_cards = DB::table('rfid_cards')
                ->where(function($query) use ($current_date) {
                    $query->where('expiry_date', '<=', $current_date)
                          ->orWhere('status', 'expired');
                })
                ->count();

        } catch (\Exception $e) {
            // Default values in case of database errors
            $today_total_access_granted = 0;
            $today_entries_in = 0;
            $today_total_access_exits = 0;
            $today_total_access_denied = 0;
            $total_citizens = 0;
            $total_vehicles = 0;
            $total_RFID_cards = 0;
            $total_inactive_cards = 0;
            $total_expired_cards = 0;
        }

        return view('dashboard', compact(
            'today_traffic_pattern',
            'today_total_access_granted',
            'today_entries_in',
            'today_total_access_exits',
            'today_total_access_denied',
            'total_citizens',
            'total_vehicles',
            'total_RFID_cards',
            'total_inactive_cards',
            'total_expired_cards'
        ));
        
    }
    
}
