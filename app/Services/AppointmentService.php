<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentService
{
    public static function index()
    {
        $from = Carbon::now()->format('Y-m-d H:i');
        $to = Carbon::now()->addDay(6)->format('Y-m-d H:i');

        $calendar = Appointment::whereDate('from_date', $from)
        ->whereDate('to_date', $to)
        ->get();

        return response()->json([
            'calendar' => $calendar
        ]);
    }

    public static function store(Request $reqeust)
    {
        // $authUser = Auth::user();

        // $authUser->tokens()->delete();
    }
}
