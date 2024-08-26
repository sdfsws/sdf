<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    // Constructor to apply the admin middleware
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Ensure the user is an admin
    }

    // Display the admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Display the user management page
    public function manageUsers()
    {
        $users = User::all(); // Fetch all users, adjust as needed
        return view('admin.manage-users', compact('users'));
    }

    // Update a user's role
    public function updateUser(Request $request, User $user)
    {
        // Validate the input
        $request->validate([
            'role' => 'required|string|in:admin,client,agent,user',
        ]);

        // Update the user's role
        try {
            $user->syncRoles($request->input('role')); // Use syncRoles for Spatie package
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('admin.manageUsers')->with('success', 'User role updated successfully.');
    }
}
