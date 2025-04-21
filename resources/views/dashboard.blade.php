@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-primary-dark">
    <div class="content content-full text-center">
      <div class="my-3">
        <img class="img-avatar img-avatar-thumb" src="{{ asset('media/safari/logo.jpg') }}" alt="Tanzania Safari Adventures Logo">
      </div>
      <h1 class="h2 text-white mb-0">Tanzania Safari Adventures</h1>
      <h2 class="h4 fw-normal text-white-75">Admin Dashboard</h2>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content content-boxed">
    <!-- Stats -->
    <div class="row">
      <div class="col-6 col-md-3">
        <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="fs-2 fw-semibold text-primary">43</div>
          </div>
          <div class="block-content py-2 bg-body-light">
            <p class="fw-medium fs-sm text-muted mb-0">
              Upcoming Bookings
            </p>
          </div>
        </a>
      </div>
      <div class="col-6 col-md-3">
        <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="fs-2 fw-semibold text-success">12</div>
          </div>
          <div class="block-content py-2 bg-body-light">
            <p class="fw-medium fs-sm text-muted mb-0">
              New Messages
            </p>
          </div>
        </a>
      </div>
      <div class="col-6 col-md-3">
        <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="fs-2 fw-semibold text-dark">165</div>
          </div>
          <div class="block-content py-2 bg-body-light">
            <p class="fw-medium fs-sm text-muted mb-0">
              Total Bookings
            </p>
          </div>
        </a>
      </div>
      <div class="col-6 col-md-3">
        <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="fs-2 fw-semibold text-warning">$24.3k</div>
          </div>
          <div class="block-content py-2 bg-body-light">
            <p class="fw-medium fs-sm text-muted mb-0">
              Revenue This Month
            </p>
          </div>
        </a>
      </div>
    </div>
    <!-- END Stats -->

    <!-- Dashboard Tabs -->
    <div class="row">
      <div class="col-md-12">
        <div class="block block-rounded">
          <ul class="nav nav-tabs nav-tabs-block" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" id="btabs-overview-tab" data-bs-toggle="tab" data-bs-target="#btabs-overview" role="tab" aria-controls="btabs-overview" aria-selected="true">
                <i class="fa fa-fw fa-chart-line opacity-50 me-1"></i> Overview
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="btabs-bookings-tab" data-bs-toggle="tab" data-bs-target="#btabs-bookings" role="tab" aria-controls="btabs-bookings" aria-selected="false">
                <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i> Recent Bookings
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="btabs-messages-tab" data-bs-toggle="tab" data-bs-target="#btabs-messages" role="tab" aria-controls="btabs-messages" aria-selected="false">
                <i class="fa fa-fw fa-envelope opacity-50 me-1"></i> Recent Messages
              </button>
            </li>
          </ul>
          <div class="block-content tab-content">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="btabs-overview" role="tabpanel" aria-labelledby="btabs-overview-tab">
              <div class="row">
                <div class="col-lg-8">
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Booking Analytics (Last 30 Days)</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                      <div class="py-3">
                        <!-- Chart Container -->
                        <canvas id="js-chartjs-line" style="height: 300px;"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Popular Tours</h3>
                    </div>
                    <div class="block-content">
                      <ul class="list-group push">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Serengeti Migration Safari
                          <span class="badge bg-primary rounded-pill">28</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Kilimanjaro Trek
                          <span class="badge bg-primary rounded-pill">19</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Zanzibar Beach Getaway
                          <span class="badge bg-primary rounded-pill">36</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Tarangire & Ngorongoro Safari
                          <span class="badge bg-primary rounded-pill">14</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Custom Safari Package
                          <span class="badge bg-primary rounded-pill">11</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Upcoming Tasks</h3>
                    </div>
                    <div class="block-content">
                      <ul class="list-group push">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                            <span class="fw-semibold">Send confirmation emails for weekend tours</span>
                            <div class="fs-sm text-muted">Due today</div>
                          </div>
                          <span class="badge bg-warning">Pending</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                            <span class="fw-semibold">Call hotel partners for available rooms</span>
                            <div class="fs-sm text-muted">Due tomorrow</div>
                          </div>
                          <span class="badge bg-info">In Progress</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                            <span class="fw-semibold">Update website photos</span>
                            <div class="fs-sm text-muted">Due Oct 25</div>
                          </div>
                          <span class="badge bg-warning">Pending</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                            <span class="fw-semibold">Monthly report preparation</span>
                            <div class="fs-sm text-muted">Due Oct 31</div>
                          </div>
                          <span class="badge bg-danger">Not Started</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Recent Reviews</h3>
                    </div>
                    <div class="block-content">
                      <div class="fs-sm push">
                        <div class="d-flex py-2">
                          <div class="flex-shrink-0 me-3">
                            <img class="img-avatar img-avatar48" src="{{ asset('media/safari/avatars/1.jpg') }}" alt="Avatar">
                          </div>
                          <div class="flex-grow-1">
                            <div class="fw-semibold">Sarah Johnson</div>
                            <div class="fs-sm text-warning mb-1">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="text-muted">Our safari with Tanzania Safari Adventures was simply incredible. The guides were knowledgeable, accommodation was excellent...</div>
                          </div>
                        </div>
                        <div class="d-flex py-2">
                          <div class="flex-shrink-0 me-3">
                            <img class="img-avatar img-avatar48" src="{{ asset('media/safari/avatars/2.jpg') }}" alt="Avatar">
                          </div>
                          <div class="flex-grow-1">
                            <div class="fw-semibold">David Miller</div>
                            <div class="fs-sm text-warning mb-1">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star-half-alt"></i>
                            </div>
                            <div class="text-muted">Climbing Kilimanjaro was the challenge of a lifetime. Thanks to our amazing guides, we all made it to the summit safely...</div>
                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary">View All Reviews</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- END Overview Tab -->

            <!-- Recent Bookings Tab -->
            <div class="tab-pane fade" id="btabs-bookings" role="tabpanel" aria-labelledby="btabs-bookings-tab">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Recent Bookings</h3>
                  <div class="block-options">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-alt-primary">View All</a>
                  </div>
                </div>
                <div class="block-content">
                  <table class="table table-striped table-vcenter">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Tour</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fw-semibold">John Smith</td>
                        <td>Serengeti Migration Safari</td>
                        <td>Nov 15, 2023</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Emma Wilson</td>
                        <td>Kilimanjaro Trek</td>
                        <td>Dec 3, 2023</td>
                        <td><span class="badge bg-success">Confirmed</span></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Robert Brown</td>
                        <td>Zanzibar Beach Getaway</td>
                        <td>Nov 22, 2023</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Lisa Johnson</td>
                        <td>Tarangire & Ngorongoro Safari</td>
                        <td>Oct 28, 2023</td>
                        <td><span class="badge bg-success">Confirmed</span></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">James Anderson</td>
                        <td>Custom Safari Package</td>
                        <td>Nov 7, 2023</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- END Recent Bookings Tab -->

            <!-- Recent Messages Tab -->
            <div class="tab-pane fade" id="btabs-messages" role="tabpanel" aria-labelledby="btabs-messages-tab">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Recent Messages</h3>
                  <div class="block-options">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-alt-primary">View All</a>
                  </div>
                </div>
                <div class="block-content">
                  <div class="list-group push">
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="javascript:void(0)">
                      <div>
                        <span class="badge bg-success me-2">New</span>
                        <span class="fw-semibold">Michael Parker</span>
                        <div class="fs-sm text-muted mt-1">I'm interested in booking a custom safari for my family of 6. Could you suggest the best options for us in December?</div>
                        <div class="fs-sm text-muted mt-1">3 hours ago</div>
                      </div>
                      <i class="fa fa-fw fa-chevron-right opacity-25"></i>
                    </a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="javascript:void(0)">
                      <div>
                        <span class="badge bg-success me-2">New</span>
                        <span class="fw-semibold">Kate Morrison</span>
                        <div class="fs-sm text-muted mt-1">Do you offer photography-focused safaris? I'm a professional photographer looking for wildlife shots.</div>
                        <div class="fs-sm text-muted mt-1">5 hours ago</div>
                      </div>
                      <i class="fa fa-fw fa-chevron-right opacity-25"></i>
                    </a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="javascript:void(0)">
                      <div>
                        <span class="badge bg-info me-2">Read</span>
                        <span class="fw-semibold">Thomas Riley</span>
                        <div class="fs-sm text-muted mt-1">What's the best time to see the wildebeest migration in the Serengeti?</div>
                        <div class="fs-sm text-muted mt-1">2 days ago</div>
                      </div>
                      <i class="fa fa-fw fa-chevron-right opacity-25"></i>
                    </a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="javascript:void(0)">
                      <div>
                        <span class="badge bg-info me-2">Read</span>
                        <span class="fw-semibold">Ashley Wood</span>
                        <div class="fs-sm text-muted mt-1">How difficult is the Kilimanjaro climb? I'm reasonably fit but have never done a major trek before.</div>
                        <div class="fs-sm text-muted mt-1">1 week ago</div>
                      </div>
                      <i class="fa fa-fw fa-chevron-right opacity-25"></i>
                    </a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="javascript:void(0)">
                      <div>
                        <span class="badge bg-primary me-2">Replied</span>
                        <span class="fw-semibold">Jennifer Hall</span>
                        <div class="fs-sm text-muted mt-1">Thanks for your quick response! I'll be booking the Zanzibar package next week.</div>
                        <div class="fs-sm text-muted mt-1">1 week ago</div>
                      </div>
                      <i class="fa fa-fw fa-chevron-right opacity-25"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- END Recent Messages Tab -->
          </div>
        </div>
      </div>
    </div>
    <!-- END Dashboard Tabs -->
  </div>
  <!-- END Page Content -->
@endsection

@section('js_after')
<!-- Chart.js functionality is initialized in js/pages/dashboard.js -->
<script src="{{ asset('js/plugins/chart.js/chart.umd.js') }}"></script>

<script>
  // Set Global Chart.js configuration
  Chart.defaults.color = '#818d96';
  Chart.defaults.font.weight = '600';

  // Init ChartJS line chart
  new Chart(document.getElementById('js-chartjs-line'), {
    type: 'line',
    data: {
      labels: ['Oct 1', 'Oct 5', 'Oct 10', 'Oct 15', 'Oct 20', 'Oct 25', 'Oct 30'],
      datasets: [
        {
          label: 'Bookings',
          fill: true,
          backgroundColor: 'rgba(230, 126, 34, .25)',
          borderColor: 'rgba(230, 126, 34, 1)',
          pointBackgroundColor: 'rgba(230, 126, 34, 1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(230, 126, 34, 1)',
          data: [5, 7, 12, 9, 15, 10, 18]
        },
        {
          label: 'Inquiries',
          fill: true,
          backgroundColor: 'rgba(44, 62, 80, .25)',
          borderColor: 'rgba(44, 62, 80, 1)',
          pointBackgroundColor: 'rgba(44, 62, 80, 1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(44, 62, 80, 1)',
          data: [8, 12, 15, 13, 18, 14, 24]
        }
      ]
    },
    options: {
      tension: 0.4,
      scales: {
        y: {
          suggestedMin: 0,
          suggestedMax: 30
        }
      },
      interaction: {
        intersect: false,
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.dataset.label + ': ' + context.parsed.y;
            }
          }
        }
      }
    }
  });
</script>
@endsection
