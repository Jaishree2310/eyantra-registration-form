<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\VerifyTokenRequest;
use App\Mail\VerifyEmail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function sendVerification(EmailVerificationRequest $request): JsonResponse
    {
        $email = $request->validated()['email'];
        
        // Check if email is already verified
        $user = User::where('email', $email)->where('email_verified_at', '!=', null)->first();
        if ($user) {
            return response()->json([
                'message' => 'Email is already verified'
            ], 200);
        }
        
        // Generate token
        $token = Str::random(64);
        
        // Store token
        EmailVerification::updateOrCreate(
            ['email' => $email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );
        
        // Send verification email
        Mail::to($email)->send(new VerifyEmail($token, $email));
        
        return response()->json([
            'message' => 'Verification email sent'
        ], 200);
    }
    
    public function verifyEmail(VerifyTokenRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        // Find verification record
        $verification = EmailVerification::where('email', $data['email'])
            ->where('token', $data['token'])
            ->first();
        
        if (!$verification) {
            return response()->json([
                'message' => 'Invalid verification token'
            ], 400);
        }
        
        // Check if token is expired (24 hours)
        if ($verification->created_at->diffInHours(now()) > 24) {
            $verification->delete();
            return response()->json([
                'message' => 'Verification token expired'
            ], 400);
        }
        
        // Update user if exists or create a placeholder
        $user = User::firstOrCreate(
            ['email' => $data['email']],
            ['name' => '', 'contact_number' => '', 'gender' => 'other', 'year' => 1, 
             'department_id' => 1, 'college_id' => 1, 'country_id' => 1]
        );
        
        $user->email_verified_at = now();
        $user->save();
        
        // Remove verification token
        $verification->delete();
        
        return response()->json([
            'message' => 'Email successfully verified'
        ], 200);
    }
}