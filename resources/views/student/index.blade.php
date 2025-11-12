 @extends('student.layouts.app')

 @section('content')
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


                     <!-- Card 2 -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="card h-100">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                     <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                         <div class="card-title">
                                             <h5 class="text-nowrap mb-2">Sales Report</h5>
                                             <span class="badge bg-label-info rounded-pill">Year 2021</span>
                                         </div>
                                         <div class="mt-sm-auto">
                                             <small class="text-danger text-nowrap fw-semibold">
                                                 <i class="bx bx-chevron-down"></i> 12.4%
                                             </small>
                                             <h3 class="mb-0">$45,210k</h3>
                                         </div>
                                     </div>
                                     <div id="profileReportChart2"></div>
                                 </div>
                             </div>
                         </div>
                     </div>

                      <!-- Card 3 -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="card h-100">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                     <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                         <div class="card-title">
                                             <h5 class="text-nowrap mb-2">Grand Test - Science</h5>
                                             <span class="badge bg-label-warning rounded-pill">Upcoming</span>
                                             <p class="text-muted small mb-0">Available: 15 Nov - 25 Nov</p>
                                         </div>
                                         <div class="mt-sm-auto">
                                            <a href="#" class="btn btn-sm btn-secondary disabled" tabindex="-1" aria-disabled="true">Not Started</a>

                                         </div>
                                     </div>
                                     <div id="profileReportChart1"></div>
                                 </div>
                             </div>
                         </div>

                     </div>

                     <!-- Card 4 -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="card h-100">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                     <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                         <div class="card-title">
                                             <h5 class="text-nowrap mb-2">Growth Report</h5>
                                             <span class="badge bg-label-primary rounded-pill">Year 2021</span>
                                         </div>
                                         <div class="mt-sm-auto">
                                             <small class="text-success text-nowrap fw-semibold">
                                                 <i class="bx bx-chevron-up"></i> 35.6%
                                             </small>
                                             <h3 class="mb-0">$123,560k</h3>
                                         </div>
                                     </div>
                                     <div id="profileReportChart4"></div>
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
                 <table class="table table-hover align-middle">
                     <caption class="ms-4">List of Projects</caption>
                     <thead class="table-light sticky-top">
                         <tr>
                             <th>Test Name</th>
                             <th>Date</th>
                             <th>Score</th>
                             <th>Rank</th>
                             <th>Status</th>
                         </tr>
                     </thead>
                     <tbody id="tableBody">
                         <tr>

                             <td>12.  <strong>Mock Test - Physics</strong></td>
                             <td>08 Nov 2025</td>
                             <td>
                                 85 / 100
                             </td>
                             <td><span class="badge bg-label-primary me-1">#12</span></td>
                             <td><span class="badge bg-label-success me-1">Passed</span></td>
                         </tr>
                         <!-- You can add more rows here -->
                     </tbody>
                 </table>
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
