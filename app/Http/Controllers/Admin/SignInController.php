<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SignInController extends Controller
{

    public function login(Request $request)
    {

        $request->validate([
            'mobile' => 'required|digits:10',
            'mpin' => 'required|digits_between:4,6'
        ]);

        $user = User::where('mobile', $request->mobile)->first();
       
        if (!$user) {
            // return response()->json(['message' => 'Invalid credentials1'], 401);
            return back()->with('error', 'Invalid credentials. Please try again.');
        }

        if ($user->status !== 'active') {
            // return response()->json(['message' => 'User inactive'], 403);
            return back()->with('error', 'User is inactive.');
        }

        if ($user->locked_until && now()->lt($user->locked_until)) {
            // return response()->json(['message' => 'Account temporarily locked'], 403);
            return back()->with('error', 'Account temporarily locked. Please try again later.');
        }

        if (!Hash::check($request->mpin, $user->mpin)) {
            $user->increment('failed_attempts');

            if ($user->failed_attempts >= 5) {
                $user->update([
                    'locked_until' => now()->addMinutes(1),
                    'failed_attempts' => 0
                ]);
            }

            // return response()->json(['message' => 'Invalid credentials2'], 401);
            return back()->with('error', 'Invalid MPIN. Please try again.');
        }

        $user->update(['failed_attempts' => 0]);

        $token = $user->createToken('auth')->plainTextToken;

        // return response()->json([
        //     'token' => $token,
        //     'user' => $user
        // ]);
        return redirect()->route('dashboard')
    ->with('success', 'Login successful');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);

        $mobile = $request->mobile;

        // Global rate limiting: max 5 OTPs per hour per mobile (prevents abuse)
        $rateLimitKey = 'otp-send:' . $mobile;
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
                // return response()->json([
                //     'message' => "Too many OTP requests. Try again in {$seconds} seconds."
                // ], 429);
                return back()->with('error', "Too many OTP requests. Try again in {$seconds} seconds.");
        }

        // Check for existing active OTP (not used AND not expired)
        $otp = Otp::where('mobile', $mobile)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        $otpCode = rand(100000, 999999);
        $hashedOtp = Hash::make($otpCode);
        RateLimiter::hit($rateLimitKey, 60); //60 seconds decay

        if ($otp) {
            // Update existing
            $otp->update([
                'otp' => $hashedOtp,
                'expires_at' => now()->addMinutes(5),
                'resends' => $otp->resends + 1,
                'last_sent_at' => now()
            ]);
        } else {
            // New OTP (invalidate any expired/used ones implicitly via query)
            Otp::create([
                'mobile' => $mobile,
                'otp' => $hashedOtp,
                'expires_at' => now()->addMinutes(5),
                'attempts' => 0,
                'resends' => 0,
                'used' => false,
                'last_sent_at' => now()
            ]);
        }

        // Increment global rate limiter


        // return response()->json([
        //     'message' => 'OTP sent successfully',
        //     'otp' => $otpCode // For testing purposes only, remove in production
        // ]);
       return redirect()->route('otp')
    ->with(['success'=> 'OTP sent successfully', 'otp' => $otpCode, 'mobile' => $mobile]);   
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:6'
        ]);

        // 🔥 FIX: Include expires_at in query (get only valid OTPs)
        $otp = Otp::where('mobile', $request->mobile)
            ->where('used', false)
            ->where('expires_at', '>', now())  // Only active
            ->latest()
            ->first();

        if (!$otp) {
            // return response()->json(['message' => 'Invalid or expired OTP'], 400);
            return back()->with('error', 'Invalid or expired OTP. Please request a new one.');
        }

        // 🔥 SECURITY: Hash comparison (update sendOtp to hash too)
        if (!Hash::check($request->otp, $otp->otp)) {
            $otp->increment('attempts');

            if ($otp->fresh()->attempts >= 3) {
                $otp->update(['used' => true]);  // Lock after max attempts
            }

            // return response()->json(['message' => 'Invalid OTP'], 400);
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        // Success: Mark used + reset attempts
        $otp->update([
            'used' => true,
            'attempts' => 0
        ]);

        // Optional: Generate token or login user here
        // Auth::loginUsingId($userId);

        // return response()->json([
        //     'message' => 'OTP verified successfully',
        //     'data' => ['mobile' => $request->mobile]  // Or token
        // ]);
        return redirect()->route('set.mpin')->with(['success' => 'OTP verified successfully', 'mobile' => $request->mobile]);
    }

    public function setMpin(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'mpin' => 'required|digits_between:4,6'
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            // return response()->json(['message' => 'User not found'], 404);
            return back()->with('error', 'User not found.');
        }

        $user->update([
            'mpin' => Hash::make($request->mpin)
        ]);

        // return response()->json([
        //     'message' => 'MPIN set successfully'
        // ]);
        return redirect()->route('login')->with('success', 'MPIN set successfully. Please login.');
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        // return response()->json([
        //     'message' => 'Logged out successfully'
        // ]);
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
