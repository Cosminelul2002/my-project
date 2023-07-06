<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        return view('landing', [
            'appointments' => $appointments,
        ]);
    }
}
