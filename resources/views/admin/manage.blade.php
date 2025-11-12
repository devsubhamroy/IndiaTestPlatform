@extends('admin.layouts.app')

@section('admin_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tables /</span> Basic Tables
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Table Caption</h5>

                <!-- Search Bar -->
                <div class="input-group w-auto">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search project..." />
                </div>
            </div>

            <div class="table-responsive text-nowrap" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-hover align-middle" id="testsTable">
                    <caption class="ms-4">List of Tests</caption>
                    <thead class="table-light sticky-top">
                        <tr>
                            <th>#</th>
                            <th>Test</th>
                            <th>Creator</th>
                            <th>Category</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated via AJAX -->
                    </tbody>
                </table>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    $(document).ready(function() {
                        const tbody = $("#testsTable tbody");

                        // Fetch tests via AJAX
                        $.ajax({
                            url: '{{ route('tests.index') }}', // Your Test API route
                            type: 'GET',
                            dataType: 'json',
                            success: function(tests) {
                                tbody.empty();

                                $.each(tests, function(index, test) {
                                    tbody.append(`
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td><strong>${test.title}</strong></td>
                                            <td>${test.creator.name}</td>
                                            <td>${test.category ?? '-'}</td>
                                            <td>${new Date(test.start_time).toLocaleString()}</td>
                                            <td>${new Date(test.end_time).toLocaleString()}</td>
                                            <td>${test.type}</td>
                                            <td>
                                            ${test.status === 'Active'
                                                ? '<span class="badge bg-success">Active</span>'
                                                : test.status === 'Scheduled'
                                                ? '<span class="badge bg-warning text-dark">Scheduled</span>'
                                                : '<span class="badge bg-secondary">Completed</span>'
                                            }
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="/tests/${test.id}/edit">
                                                            <i class="bx bx-edit-alt me-1"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="#" onclick="deleteTest(${test.id})">
                                                            <i class="bx bx-trash me-1"></i>Delete
                                                        </a>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    `);
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error("Error fetching tests:", error);
                            }
                        });

                        // Optional: search filter
                        $("#tableSearch").on("keyup", function() {
                            let value = $(this).val().toLowerCase();
                            $("#testsTable tbody tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                            });
                        });
                    });
                </script>
                <script>
                    function deleteTest(id) {
                        if (!confirm("Are you sure you want to delete this test?")) {
                            return;
                        }

                        $.ajax({
                            url: `/tests/${id}`, // route('tests.destroy', id)
                            type: 'POST', // Laravel only accepts POST when using _method
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                alert(response.message);
                                // Option 1: Refresh table after delete
                                location.reload();

                                // Option 2 (better): Remove row instantly
                                // $(`#test-row-${id}`).remove();
                            },
                            error: function(xhr, status, error) {
                                console.error("Delete failed:", xhr.responseText);
                                alert("Failed to delete test.");
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>

    <!-- Search Filter Script -->
    <script>
        document.getElementById("tableSearch").addEventListener("keyup", function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(value) ? "" : "none";
            });
        });
    </script>
@endsection
