<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        // Check if email is verified
        $user = User::where('email', $data['email'])->first();
        
        if (!$user || !$user->email_verified_at) {
            return response()->json([
                'message' => 'Email verification required before registration'
            ], 403);
        }
        
        // Update user details
        $user->update([
            'name' => $data['name'],
            'contact_number' => $data['contact_number'],
            'gender' => $data['gender'],
            'year' => $data['year'],
            'department_id' => $data['department_id'],
            'college_id' => $data['college_id'],
            'country_id' => $data['country_id'],
            'is_registered' => true
        ]);
        
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user
        ], 201);
    }
}