<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'roles' => 'array',
                'roles.*' => 'exists:roles,name',
            ]);

            DB::transaction(function () use ($user, $request) {
                $user->syncRoles($request->input('roles', []));
            });

            return redirect()->route('users.index')->with('success', 'User roles updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the exception or handle it appropriately
            return redirect()->back()->with('error', 'An error occurred while updating user roles.');
        }
    }
}
