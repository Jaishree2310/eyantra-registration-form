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
        
        // Create a new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'gender' => $data['gender'],
            'year' => $data['year'],
            'department_id' => $data['department_id'],
            'college_id' => $data['college_id'],
            'country_id' => $data['country_id']
        ]);
        
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user
        ], 201);
    }
}