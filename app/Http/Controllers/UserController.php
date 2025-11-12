<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $students = User::whereHas('role', function ($query) {
            $query->where('name', 'student');
        })->with('role')->get();

        return response()->json($students);
    }

    // public function store(Request $request) {
    //     $data = $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //         'role_id' => 'required|exists:roles,id'
    //     ]);

    //     $data['password'] = Hash::make($data['password']);
    //     $user = User::create($data);
    //     return response()->json($user, 201);
    // }

    // public function show(User $user) {
    //     return response()->json($user->load('role'));
    // }

    // public function update(Request $request, User $user) {
    //     $user->update($request->except('password'));
    //     if ($request->password) {
    //         $user->update(['password' => Hash::make($request->password)]);
    //     }
    //     return response()->json($user);
    // }

    // public function destroy(User $user) {
    //     $user->delete();
    //     return response()->json(['message' => 'User deleted successfully']);
    // }
}
