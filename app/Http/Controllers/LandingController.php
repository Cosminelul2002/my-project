<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class LandingController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        // attach to all appointments, the day from 'start_date'
        foreach ($appointments as $appointment) {
            $appointment->day = Carbon::parse($appointment->start_date)->format('l');
        }

        // sort them ascending by 'start_date'
        $appointments = $appointments->sortBy('start_date');

        // group by 'start_date'
        $appointments = $appointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->start_date)->format('Y-m-d');
        });

        return view('landing', [
            'appointments' => $appointments,
        ]);
    }
}
