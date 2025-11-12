@extends('admin.layouts.app')

@section('admin_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Test Scheduled Form /</span> Create
        </h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Test Scheduled:</h5>
                    </div>

                    <div class="card-body">
                        <div id="createTestForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" id="title" class="form-control" placeholder="Enter exam title"
                                        required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type">Type</label>
                                    <select id="type" class="form-select" required>
                                        <option value="">Select type</option>
                                        <option value="Mock">Mock</option>
                                        <option value="Grand">Grand</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Enter exam description" required></textarea>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="negative_marking">Negative Marking</label>
                                    <input type="number" id="negative_marking" class="form-control"
                                        placeholder="Enter Negative Marking" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="category">Category</label>
                                    <select id="category" name="category" class="form-select" required>
                                        <option value="">Select category</option>
                                        <option value="GK">GK</option>
                                        <option value="Science">Science</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="duration">Duration (minutes)</label>
                                    <input type="number" id="duration" class="form-control" placeholder="Enter duration"
                                        required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="created_by">Created By</label>
                                    <select id="created_by" class="form-select" required>
                                        <option value="">Select user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="start_time">Available From</label>
                                    <input type="datetime-local" id="start_time" class="form-control" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="end_time">Available To</label>
                                    <input type="datetime-local" id="end_time" class="form-control" />
                                </div>
                            </div>


                            <button id="submitTestBtn" class="btn btn-primary">Submit</button>
                            <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submitTestBtn").click(function(e) {
                e.preventDefault(); // Prevent default button behavior

                // Collect data
                let data = {
                    title: $("#title").val(),
                    type: $("#type").val(),
                    duration: $("#duration").val(),
                    negative_marking: $("#negative_marking").val(),
                    description: $("#description").val(),
                    category: $("#category").val(),
                    created_by: $("#created_by").val(),
                    start_time: $("#start_time").val(),
                    end_time: $("#end_time").val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token
                };

                // Send AJAX POST request
                $.ajax({
                    url: '{{ route('tests.store') }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        alert("Test created successfully!");
                        window.location.href = '{{ route('admin.manage') }}';
                        // console.log(response);

                        // Optional: Clear inputs
                        // $("#title, #type, #duration, #description, #negative_marking, #category, #created_by, #start_time, #end_time")
                        //     .val('');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error creating test:", xhr.responseJSON);
                        alert("Failed to create test. Check console for details.");
                    }
                });
            });
        });
    </script>
@endsection
