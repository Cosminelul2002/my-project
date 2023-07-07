<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Program;
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

        $dateTime = $request->start_date . ' ' . $request->hour;

        $appointments = Appointment::all();

        $appointments = $appointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->start_date)->format('Y-m-d');
        });

        foreach ($appointments as $groupedAppointments) {
            if (Carbon::parse($groupedAppointments[0]->start_date)->format('Y-m-d') == Carbon::parse($dateTime)->format('Y-m-d')) {
                foreach ($groupedAppointments as $appointment) {
                    $endDateTime = Carbon::parse($appointment->end_date);
                    $startDateTime = Carbon::parse($appointment->start_date);
                    $newDateTime = Carbon::parse($dateTime);

                    if ($startDateTime->format('H:i') == $newDateTime->format('H:i')) {
                        return response()->json([
                            'message' => 'An appointment already exists at the same hour.',
                        ], 422);
                    }

                    // check if the new appointment is between the start and end date of an existing appointment
                    if ($newDateTime->between($startDateTime, $endDateTime)) {
                        return response()->json([
                            'message' => 'An appointment already exists between the start and end date of an existing appointment.',
                        ], 422);
                    }

                    if ($endDateTime->diffInMinutes($newDateTime) < 30) {
                        return response()->json([
                            'message' => 'Appointment time should be at least 30 minutes apart from existing appointments.',
                        ], 422);
                    }
                }
            }
        }

        $appointment = Appointment::create([
            'start_date' => Carbon::parse($dateTime)->format('Y-m-d H:i:s'),
            'end_date' => Carbon::parse($dateTime)->addHour(),
            'status' => 'pending',
            'description' => $request->description,
        ]);

        Program::create([
            'appointment_id' => $appointment->id,
            'user_id' => $request->user_id,
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
