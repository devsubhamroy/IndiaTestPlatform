<?php
namespace App\Http\Controllers;

use App\Models\Attempt;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    public function index() {
        return response()->json(Attempt::with('student', 'test')->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'test_id' => 'required|exists:tests,id',
            'student_id' => 'required|exists:users,id',
            'start_time' => 'nullable|date',
            'status' => 'in:in_progress,submitted'
        ]);

        $attempt = Attempt::create($data);
        return response()->json($attempt, 201);
    }

    public function show(Attempt $attempt) {
        return response()->json($attempt->load('test', 'student', 'result'));
    }

    public function update(Request $request, Attempt $attempt) {
        $attempt->update($request->all());
        return response()->json($attempt);
    }

    public function destroy(Attempt $attempt) {
        $attempt->delete();
        return response()->json(['message' => 'Attempt deleted successfully']);
    }
}
