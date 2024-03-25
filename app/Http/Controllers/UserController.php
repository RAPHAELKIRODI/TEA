<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the authenticated user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the user's profile view with the user data
        return view('profile', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            // Add more validation rules for other fields if needed
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile data
        $user->name = $request->name;
        $user->email = $request->email;
        // Add more fields to update if needed

        // Save the updated user data
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
