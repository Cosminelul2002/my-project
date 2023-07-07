<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

#[Authorize(roles: 'user')]
class UserController extends Controller
{
    public function dashboard(Request $request, $id)
    {

        $request->session()->put('user_id');

        $appointments = Appointment::query()
            ->whereHas('program', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->get();

        foreach ($appointments as $appointment) {
            // add day to appointment
            $appointment['day'] = Carbon::parse($appointment->start_date)->format('l');
        }
        $appointments = $appointments->sortBy('start_date');

        $appointments = $appointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->start_date)->format('Y-m-d');
        });

        return view('User/dashboard', [
            'appointments' => $appointments,
        ]);
    }
}
