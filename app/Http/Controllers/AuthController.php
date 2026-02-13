<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        return redirect()->route('admin.dashboard')
            ->with('success', 'Login successful');
    }
    public function sendOtp(Request $request)
    {
        return redirect()->route('otp.form')
            ->with('success', 'OTP sent successfully');
    }


    public function verifyOtp(Request $request)
    {
        return redirect()->route('set.mpin')
            ->with('success', 'OTP verified successfully (dummy)');
    }

    public function resendOtp()
    {
        return back()->with('success', 'OTP resent successfully (dummy)');
    }

    public function storeMpin(Request $request)
    {
        return redirect()->route('dashboard')
            ->with('success', 'MPIN set successfully');
    }
}