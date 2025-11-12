@extends('admin.layouts.app')

@section('admin_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Test /</span> Scheduled</h4>
        <div class="row">
            <!-- Four Cards Row -->
            <div class="col-12">
                <div class="row g-3"> <!-- g-3 adds gutter spacing between cards -->

                    <!-- Card 1 -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">Mock Test - Mathematics</h5>
                                            <span class="badge bg-label-success rounded-pill">Active</span>
                                            <p class="text-muted small mb-0">Available: 10 Nov - 15 Nov</p>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <a href="#" class="btn btn-sm btn-primary">Start</a>
                                        </div>
                                    </div>
                                    <div id="profileReportChart1"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Card 1 -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">Grand Test - Science</h5>
                                            <span class="badge bg-label-warning rounded-pill">Upcoming</span>
                                            <p class="text-muted small mb-0">Available: 10 Nov - 15 Nov</p>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <a href="" class="btn btn-sm btn-default bg-label-secondary disabled"
                                                tabindex="-1" aria-disabled="true">Not Start</a>

                                        </div>
                                    </div>
                                    <div id="profileReportChart1"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div> <!-- /row -->
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <!-- Bootstrap Table with Caption -->
    </div> <!-- /container -->
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
                            <th>Name</th>
                            <th>Contacts</th>
                            <th>Role</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    @php
                        use App\Models\User;
                        $users = User::whereIn('role_id', [1, 2])
                            ->with('role')
                            ->get();
                    @endphp

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const tbody = $("#testsTable tbody");
            $("#tableSearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#testsTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>



    {{-- <script>
        $(document).ready(function() {
            const tbody = $("#testsTable tbody");


            $.ajax({
                url: '/results',
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


            $("#tableSearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#testsTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });


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
    </script> --}}
@endsection
