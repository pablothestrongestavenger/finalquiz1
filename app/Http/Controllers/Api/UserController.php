<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);


            return redirect('/');
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Log the provided credentials
        \Illuminate\Support\Facades\Log::info('Login Attempt - Credentials:', $credentials);
    
        // Retrieve the user based on the email
        $user = User::where('email', $credentials['email'])->first();
    
        // Check if the user exists
        if ($user) {
            // Check if the password matches
            if (Hash::check($credentials['password'], $user->password)) {
                
                return redirect('/welcome'); // Redirect after successful login
            }
        }
    
        // Authentication failed...
        return response()->json(['message' => 'Invalid credentials'], 401); // Return a JSON response indicating failed authentication
    }
    
}
