@extends('admin.layouts.app')

@section('admin_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Edit Test /</span> Update Questions
        </h4>

        <div class="card">
            <div class="card-header">
                <h5>Edit Questions for: {{ $test->title }}</h5>
            </div>

            @php
                $questions = json_decode($test->questions, true) ?? [];
                $users = \App\Models\User::whereIn('role_id', [1, 2])->get();
            @endphp

            <div class="card-body">
                <form id="editQuestionForm">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Created By</label>
                            <select id="created_by" class="form-select" required>
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $test->created_by == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Duration (minutes)</label>
                            <input type="number" id="duration" class="form-control" value="{{ $test->duration }}">
                        </div>
                        <div class="col-md-4">
                            <label>Negative Marking</label>
                            <input type="number" id="negative" class="form-control" value="{{ $test->negative_marking }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Difficulty</label>
                            <select id="difficulty" class="form-select">
                                <option value="easy" {{ $test->difficulty == 'easy' ? 'selected' : '' }}>Easy</option>
                                <option value="medium" {{ $test->difficulty == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="hard" {{ $test->difficulty == 'hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <h5>Questions</h5>
                    <div id="questionsContainer">
                        @foreach ($questions as $index => $q)
                            <div class="question-block border p-3 mb-3 rounded" data-index="{{ $index + 1 }}">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6>Question {{ $index + 1 }}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-question">Remove</button>
                                </div>

                                <div class="mb-3">
                                    <label>Question</label>
                                    <textarea class="form-control qns" rows="2">{{ $q['qns'] }}</textarea>
                                </div>

                                <div class="row">
                                    @foreach ($q['options'] as $key => $option)
                                        <div class="col-md-6 mb-2">
                                            <input type="text" class="form-control {{ $key }}"
                                                value="{{ $option }}" placeholder="Option {{ substr($key, -1) }}">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Correct Answer</label>
                                        <select class="form-select answer">
                                            <option value="">Select</option>
                                            @foreach (['option1', 'option2', 'option3', 'option4'] as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $q['answer'] == $opt ? 'selected' : '' }}>
                                                    {{ ucfirst($opt) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Marks</label>
                                        <input type="number" class="form-control marks" value="{{ $q['marks'] }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="addQuestionBtn" class="btn btn-success btn-sm mb-3">+ Add Question</button>
                    <hr>

                    <button type="submit" class="btn btn-primary">Update Questions</button>
                    <a href="{{ route('admin.manage') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let questionCount = {{ count($questions) }};

            // Add Question
            $("#addQuestionBtn").click(function() {
                questionCount++;
                let html = `
        <div class="question-block border p-3 mb-3 rounded" data-index="${questionCount}">
            <div class="d-flex justify-content-between mb-2">
                <h6>Question ${questionCount}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-question">Remove</button>
            </div>
            <div class="mb-3"><textarea class="form-control qns" rows="2" placeholder="Enter question"></textarea></div>
            <div class="row">
                <div class="col-md-6 mb-2"><input type="text" class="form-control option1" placeholder="Option 1"></div>
                <div class="col-md-6 mb-2"><input type="text" class="form-control option2" placeholder="Option 2"></div>
                <div class="col-md-6 mb-2"><input type="text" class="form-control option3" placeholder="Option 3"></div>
                <div class="col-md-6 mb-2"><input type="text" class="form-control option4" placeholder="Option 4"></div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <select class="form-select answer">
                        <option value="">Select Correct Answer</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                        <option value="option4">Option 4</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3"><input type="number" class="form-control marks" placeholder="Marks"></div>
            </div>
        </div>`;
                $("#questionsContainer").append(html);
            });

            // Remove question
            $(document).on('click', '.remove-question', function() {
                $(this).closest('.question-block').remove();
            });

            // Submit updated data
            $("#editQuestionForm").submit(function(e) {
                e.preventDefault();

                let questions = [];
                $(".question-block").each(function() {
                    questions.push({
                        qns: $(this).find(".qns").val(),
                        options: {
                            option1: $(this).find(".option1").val(),
                            option2: $(this).find(".option2").val(),
                            option3: $(this).find(".option3").val(),
                            option4: $(this).find(".option4").val()
                        },
                        answer: $(this).find(".answer").val(),
                        marks: $(this).find(".marks").val()
                    });
                });

                let payload = {
                    created_by: $("#created_by").val(),
                    duration: $("#duration").val(),
                    negative: $("#negative").val(),
                    difficulty: $("#difficulty").val(),
                    questions: questions
                };

                $.ajax({
                    url: '{{ route('questions.update', $test->id) }}',
                    method: 'PUT',
                    data: JSON.stringify(payload),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        alert("Questions updated successfully!");
                        window.location.href = '{{ route('admin.manage') }}';
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("Error updating test questions.");
                    }
                });
            });
        });
    </script>
@endsection
