<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Schedules retrieved successfully',
            'data' => $schedules,
            'meta' => [
                'service_name' => 'Schedule-Service',
                'api_version' => 'v1'
            ]
        ], 200);
    }

    public function show($id)
{
    $schedule = Schedule::find($id);

    if (!$schedule) {
        return response()->json([
            'status' => 'error',
            'message' => 'Resource not found',
            'data' => null,
            'meta' => [
                'service_name' => 'Schedule-Service',
                'api_version' => 'v1'
            ]
        ], 404);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Data retrieved successfully',
        'data' => $schedule,
        'meta' => [
            'service_name' => 'Schedule-Service',
            'api_version' => 'v1'
        ]
    ], 200);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|integer',
            'driver_id' => 'required|integer',
            'destination' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'purpose' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $schedule = Schedule::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule created successfully',
            'data' => $schedule,
            'meta' => [
                'service_name' => 'Schedule-Service',
                'api_version' => 'v1'
            ]
        ], 201);
    }
}