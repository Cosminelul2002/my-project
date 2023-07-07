<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\User;
use Carbon\Carbon;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;

#[Authorize(roles: 'admin')]
class AdminController extends Controller
{
    public function dashboard()
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


        return view('Admin/dashboard', [
            'users' => User::all(),
            'appointments' => $appointments,
            'consultants' => Consultant::all(),
        ]);
    }
}
