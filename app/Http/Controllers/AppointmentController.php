<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $request->validated();

        // verify if there are 30 minutes apart from the others
        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            if (Carbon::parse($appointment->start_date)->diffInMinutes($request->start_date) < 30) {
                return response()->json([
                    'message' => 'There are less than 30 minutes apart from the others',
                ], 422);
            }
        }

        Appointment::create([
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->start_date)->addHour(),
            'status' => 'pending',
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Appointment created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
