<?php

namespace App\Http\Controllers;

use App\Enums\Permission;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($request->get('remember')) {
                Auth::user()->setRememberToken($request->get('remember'));
            }
            $request->session()->regenerate();

            if (auth()->user()->hasPermission(Permission::ViewAdminDashboard)) {

                return redirect()->route('admin.dashboard');
            } else if (auth()->user()->hasPermission(Permission::ViewUserDashboard)) {
                return redirect()->route('user.dashboard', ['id' => auth()->user()->id]);
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
