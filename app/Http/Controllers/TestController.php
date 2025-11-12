<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return response()->json(Test::with('creator')->orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        $users = User::whereIn('role_id', [1, 2])->get();
        return view('admin.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:Mock,Grand',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'negative_marking' => 'required|integer',
            'category' => 'required|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'created_by' => 'required|exists:users,id'
        ]);

        $test = Test::create($data);
        return response()->json($test, 201);
    }


    public function show(Test $test)
    {
        return response()->json($test->load('questions', 'attempts'));
    }

    public function edit(Test $test)
    {
        $users = User::whereIn('role_id', [1, 2])->get();
        return view('admin.edit', compact('test', 'users'));
    }

    public function update(Request $request, Test $test)
    {
        $test->update($request->all());
        return response()->json($test);
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return response()->json(['message' => 'Test deleted successfully']);
    }
}
