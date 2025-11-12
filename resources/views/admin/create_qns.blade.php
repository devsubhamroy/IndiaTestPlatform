@extends('admin.layouts.app')

@section('admin_content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Create Test /</span> Add Questions
    </h4>

    <div class="card">
        <div class="card-header">
            <h5>Create Test with Questions</h5>
        </div>

        @php
            use App\Models\Test;
            use App\Models\User;

            $tests = Test::where('status', 'Scheduled')->get();
            $users = User::whereIn('role_id', [1, 2])->get();
        @endphp

        <div class="card-body">
            <form id="questionForm">
                {{-- Test Info --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Select Test</label>
                        <select id="test_id" class="form-select" required>
                            <option value="">-- Select Test --</option>
                            @foreach ($tests as $test)
                                <option value="{{ $test->id }}">
                                    {{ $test->title }} - {{ $test->category }} - {{ $test->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Created By</label>
                        <select id="created_by" class="form-select" required>
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Duration (minutes)</label>
                        <input type="number" id="duration" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Negative Marking</label>
                        <input type="number" id="negative" class="form-control" placeholder="0.25 or 1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Difficulty</label>
                        <select id="difficulty" class="form-select" required>
                            <option value="">Select Difficulty</option>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                </div>

                <hr>

                {{-- Dynamic Questions --}}
                <h5 class="mb-3">Questions</h5>
                <div id="questionsContainer"></div>

                <button type="button" id="addQuestionBtn" class="btn btn-success btn-sm mb-3">+ Add Question</button>
                <hr>

                <button type="submit" class="btn btn-primary">Submit All</button>
                <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    let questionCount = 0;

    // Add Question Block
    $("#addQuestionBtn").click(function() {
        questionCount++;
        let qHtml = `
        <div class="question-block border p-3 mb-3 rounded" data-index="${questionCount}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6>Question ${questionCount}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-question">Remove</button>
            </div>

            <div class="mb-3">
                <label>Question</label>
                <textarea class="form-control qns" rows="2" placeholder="Enter question" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2"><input type="text" class="form-control option1" placeholder="Option 1"></div>
                <div class="col-md-6 mb-2"><input type="text" class="form-control option2" placeholder="Option 2"></div>
                <div class="col-md-6 mb-2"><input type="text" class="form-control option3" placeholder="Option 3"></div>
                <div class="col-md-6 mb-2"><input type="text" class="form-control option4" placeholder="Option 4"></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Correct Answer</label>
                    <select class="form-select answer">
                        <option value="">Select</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                        <option value="option4">Option 4</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Marks</label>
                    <input type="number" class="form-control marks" placeholder="Enter marks" required>
                </div>
            </div>
        </div>`;
        $("#questionsContainer").append(qHtml);
    });

    // Remove Question
    $(document).on("click", ".remove-question", function() {
        $(this).closest(".question-block").remove();
    });

    // Submit All
    $("#questionForm").submit(function(e) {
        e.preventDefault();

        let questions = [];
        $(".question-block").each(function() {
            questions.push({
                qns: $(this).find(".qns").val(),
                options: {
                    option1: $(this).find(".option1").val(),
                    option2: $(this).find(".option2").val(),
                    option3: $(this).find(".option3").val(),
                    option4: $(this).find(".option4").val(),
                },
                answer: $(this).find(".answer").val(),
                marks: $(this).find(".marks").val()
            });
        });

        let payload = {
            test_id: $("#test_id").val(),
            created_by: $("#created_by").val(),
            duration: $("#duration").val(),
            negative: $("#negative").val(),
            difficulty: $("#difficulty").val(),
            category: $("#test_id option:selected").text().split(" - ")[1],
            questions: questions
        };

        $.ajax({
            url: '{{ route('questions.store') }}',
            method: 'POST',
            data: JSON.stringify(payload),
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function(res) {
                console.log(res);
                alert("All questions submitted successfully!");
                window.location.href = '{{ route('admin.manage') }}';
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert("Error creating test. Check console for details.");
            }
        });
    });
});
</script>
@endsection
