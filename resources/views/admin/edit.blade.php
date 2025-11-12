@extends('admin.layouts.app')

@section('admin_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Test Scheduled Form /</span> Update
        </h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Test Scheduled:</h5>
                    </div>

                    <div class="card-body">
                        <div id="updateTestForm" data-id="{{ $test->id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" id="title" class="form-control" value="{{ $test->title }}"
                                        placeholder="Enter exam title" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type">Type</label>
                                    <select id="type" class="form-select" required>
                                        <option value="">Select type</option>
                                        <option value="Mock" {{ $test->type == 'Mock' ? 'selected' : '' }}>Mock</option>
                                        <option value="Grand" {{ $test->type == 'Grand' ? 'selected' : '' }}>Grand</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea id="description" class="form-control" required>{{ $test->description }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="negative_marking">Negative Marking</label>
                                    <input type="number" id="negative_marking" class="form-control"
                                        value="{{ $test->negative_marking }}" placeholder="Enter Negative Marking"
                                        required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="category">Category</label>
                                    <select id="category" class="form-select" required>
                                        <option value="">Select category</option>
                                        <option value="GK" {{ $test->category == 'GK' ? 'selected' : '' }}>GK</option>
                                        <option value="Science" {{ $test->category == 'Science' ? 'selected' : '' }}>Science
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="duration">Duration (minutes)</label>
                                    <input type="number" id="duration" class="form-control" value="{{ $test->duration }}"
                                        placeholder="Enter duration" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="created_by">Created By</label>
                                    <select id="created_by" class="form-select" required>
                                        <option value="">Select user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $test->created_by == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="start_time">Available From</label>
                                    <input type="datetime-local" id="start_time" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($test->start_time)->format('Y-m-d\TH:i') }}" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="end_time">Available To</label>
                                    <input type="datetime-local" id="end_time" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($test->end_time)->format('Y-m-d\TH:i') }}" />
                                </div>
                            </div>

                            <button id="updateTestBtn" class="btn btn-primary">Update</button>
                            <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery + AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#updateTestBtn").click(function(e) {
                e.preventDefault();

                // Get test ID from a hidden input or data attribute
                let testId = $("#updateTestForm").data("id") || "{{ $test->id }}";

                // Collect form data
                let data = {
                    title: $("#title").val(),
                    type: $("#type").val(),
                    description: $("#description").val(),
                    negative_marking: $("#negative_marking").val(),
                    category: $("#category").val(),
                    duration: $("#duration").val(),
                    created_by: $("#created_by").val(),
                    start_time: $("#start_time").val(),
                    end_time: $("#end_time").val(),
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                };

                // AJAX PUT request
                $.ajax({
                    url: `/tests/${testId}`, // or use: "{{ url('admin/tests') }}/" + testId
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        alert("✅ Test updated successfully!");
                        window.location.href = '{{ route('admin.manage') }}';
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating test:", xhr.responseJSON);
                        alert("❌ Failed to update test. Check console for details.");
                    }
                });
            });
        });
    </script>
@endsection
