@extends('admin.layouts.app')

@section('admin_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tables /</span> Test Results
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">List of Test Results</h5>

                <!-- 🔍 Search Bar -->
                <div class="input-group w-auto">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search student..." />
                </div>
            </div>

            <div class="table-responsive text-nowrap" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-hover align-middle" id="testsTable">
                    <caption class="ms-4">All Test Results</caption>
                    <thead class="table-light sticky-top">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Contacts</th>
                            {{-- <th>Status</th> --}}
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            const tbody = $("#testsTable tbody");

            // ✅ Fetch results via AJAX
            $.ajax({
                url: '/results', // your route that returns JSON
                type: 'GET',
                dataType: 'json',
                success: function(results) {
                    tbody.empty();

                    if (results.length === 0) {
                        tbody.append(
                            `<tr><td colspan="8" class="text-center text-muted">No test results found</td></tr>`
                            );
                        return;
                    }

                    $.each(results, function(index, result) {
                        const studentName = result.user ? result.user.name : 'N/A';
                        const studentEmail = result.user ? result.user.email : 'N/A';

                        tbody.append(`
                    <tr id="test-row-${result.id}">
                        <td>${result.user.id}</td>
                        <td>${studentName}</td>
                        <td>${studentEmail}</td>
                        <td>${result.user.created_at ?? 0}</td>


                    </tr>
                `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching results:", error);
                }
            });

            // 🔍 Search filter
            $("#tableSearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#testsTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        // 🗑️ Delete Function
        function deleteTest(id) {
            if (!confirm("Are you sure you want to delete this test?")) return;

            $.ajax({
                url: `/tests/${id}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    alert(response.message);
                    $(`#test-row-${id}`).remove(); // remove deleted row
                },
                error: function(xhr, status, error) {
                    console.error("Delete failed:", xhr.responseText);
                    alert("Failed to delete test.");
                }
            });
        }
    </script>
@endsection





