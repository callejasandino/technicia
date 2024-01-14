<?php

namespace App\Services;

use App\Models\JobOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function App\Traits\notFoundResponse;
use function App\Traits\okayResponse;
use function App\Traits\queryResponse;

class JobOrderService
{
    public static function index(Request $request) {
        $authUser = Auth::user();

        $jobOrder = JobOrder::where('user_id', $authUser->id)
        ->where('status', '!=', 'Done')
        ->orderBy('created_at', 'ASC')
        ->get();
        
        return queryResponse('jobOrder', $jobOrder);
    }

    public static function store(Request $request) {
        $authUser = Auth::user();

        $orderSlug = Str::random(16);

        while(JobOrder::where('order_slug', $orderSlug)->first()) {
            $orderSlug = Str::random(16);
        };

        $scheduledVisit = Carbon::parse($request->input('scheduled_visit'))->timestamp;

        $jobOrder = JobOrder::create([
            'user_id' => $authUser->id,
            'order_slug' => $orderSlug,
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'date_of_visit' => $scheduledVisit,
        ]);

        return queryResponse('jobOrder', "{$jobOrder->title} created.");
    }

    public static function update(Request $request) {
        
        $authUser = Auth::user();

        $jobOrder = JobOrder::where('user_id', $authUser->id)
        ->where('order_slug', $request->input('order_slug'))
        ->first();

        $scheduledVisit = Carbon::parse($request->input('scheduled_visit'))->timestamp;

        if (! $jobOrder) {
            return notFoundResponse('error', 'Job Order not found');
        }

        $jobOrder->update([
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'date_of_visit' => $scheduledVisit,
        ]);

        return okayResponse('jobOrder', "{$jobOrder->title} updated.");
    }

    public static function delete($orderSlug) {
        $authUser = Auth::user();

        $jobOrder = JobOrder::where('user_id', $authUser->id)
        ->where('order_slug', $orderSlug)
        ->first();

        if (! $jobOrder) {
            return notFoundResponse('error', 'Job Order not found');
        }

        $jobOrder->delete();

        return okayResponse('jobOrder', "{$jobOrder->title} deleted.");
    }
}
