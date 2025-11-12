<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return response()->json(Question::with('test')->get());
    }

    public function store(Request $request)
    {
        // Decode raw JSON if sent via JSON payload
        $data = $request->all();

        // Validate main test info
        $validated = validator($data, [
            'test_id' => 'nullable|integer',
            'created_by' => 'required|exists:users,id',
            'duration' => 'required|integer',
            'negative' => 'nullable|numeric',
            'difficulty' => 'nullable|string',
            'category' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*.qns' => 'required|string',
            'questions.*.options.option1' => 'required|string',
            'questions.*.options.option2' => 'required|string',
            'questions.*.options.option3' => 'required|string',
            'questions.*.options.option4' => 'required|string',
            'questions.*.answer' => 'required|string|in:option1,option2,option3,option4',
            'questions.*.marks' => 'required|numeric|min:1'
        ])->validate();

        // Create test record
        $qns = new Question();
        $qns->test_id = $data['test_id'] ?? 'Untitled Test';
        // $qns->type = $data['type'] ?? 'Mock';
        $qns->duration = $validated['duration'];
        $qns->negative = $validated['negative'] ?? 0;
        $qns->category = $validated['category'];
        $qns->difficulty = $validated['difficulty'] ?? 'medium';
        $qns->created_by = $validated['created_by'];
        $qns->qns = json_encode($validated['questions'], JSON_PRETTY_PRINT); // store questions as JSON
        $qns->save();

        return response()->json([
            'message' => 'Test created successfully with questions',

            'data' => $qns
        ], 201);
    }

    public function show(Question $question)
    {
        return response()->json($question->load('test'));
    }

    public function edit($id)
    {
        $test = Test::findOrFail($id);

        return view('admin.questions.edit', compact('test'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'questions'   => 'required|array',
            'questions.*.qns' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.answer' => 'required|string',
            'questions.*.marks' => 'required|numeric',
            'duration'    => 'nullable|integer',
            'negative'    => 'nullable|numeric',
            'difficulty'  => 'required|string|in:easy,medium,hard',
            'created_by'  => 'required|exists:users,id',
        ]);

        $test = User::findOrFail($id);

        $test->update([
            'questions'  => json_encode($data['questions']),
            'duration'   => $data['duration'],
            'negative_marking' => $data['negative'] ?? 0,
            'difficulty' => $data['difficulty'],
            'created_by' => $data['created_by'],
        ]);

        return response()->json([
            'message' => 'Questions updated successfully!',
            'test' => $test
        ]);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
