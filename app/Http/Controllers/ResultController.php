<?php
namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index() {
        return response()->json(Result::with('user')->orderBy('total_marks', 'desc')->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'attempt_id' => 'required|exists:attempts,id',
            'total_marks' => 'numeric',
            'correct_count' => 'integer',
            'wrong_count' => 'integer',
            'rank' => 'nullable|integer'
        ]);

        $result = Result::create($data);
        return response()->json($result, 201);
    }

    public function show(Result $result) {
        return response()->json($result->load('attempt'));
    }

    public function update(Request $request, Result $result) {
        $result->update($request->all());
        return response()->json($result);
    }

    public function destroy(Result $result) {
        $result->delete();
        return response()->json(['message' => 'Result deleted successfully']);
    }
}
