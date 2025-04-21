@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-primary-dark">
    <div class="content">
      <div class="d-flex justify-content-between align-items-center py-4">
        <div class="d-flex align-items-center">
          <img class="img-avatar img-avatar-thumb me-3" src="{{ asset('media/safari/logo.jpg') }}" alt="Tanzania Safari Adventures Logo">
          <div>
            <h1 class="h2 text-white mb-0">Tanzania Safari Adventures</h1>
            <h2 class="h4 fw-normal text-white-75">Admin Dashboard</h2>
          </div>
        </div>
        <div class="d-none d-md-block">
          <button type="button" class="btn btn-primary px-4">
            <i class="fa fa-plus me-1"></i> New Booking
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
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
      <div class="col-md-8">
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

        <div class="row">
          <div class="col-md-6">
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
          <div class="col-md-6">
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
      <div class="col-md-4">
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

        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Recent Bookings</h3>
          </div>
          <div class="block-content p-0">
            <div class="list-group push">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <span class="fs-sm text-muted">Today</span>
                    <div class="fw-semibold">John Smith - Serengeti Safari</div>
                    <div class="text-muted">3 people · Nov 15-22, 2023</div>
                  </div>
                  <span class="badge bg-success rounded-pill">Confirmed</span>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <span class="fs-sm text-muted">Yesterday</span>
                    <div class="fw-semibold">Maria Garcia - Kilimanjaro Trek</div>
                    <div class="text-muted">2 people · Dec 10-18, 2023</div>
                  </div>
                  <span class="badge bg-info rounded-pill">Pending</span>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <span class="fs-sm text-muted">Oct 21, 2023</span>
                    <div class="fw-semibold">James Wilson - Zanzibar Package</div>
                    <div class="text-muted">4 people · Jan 5-12, 2024</div>
                  </div>
                  <span class="badge bg-success rounded-pill">Confirmed</span>
                </div>
              </a>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light text-center">
              <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-alt-secondary">
                <i class="fa fa-arrow-right me-1"></i> View All
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
@endsection

@section('js')
<script>
  // Initialize chart on page load
  document.addEventListener('DOMContentLoaded', function() {
    // Chart Data
    const chartData = {
      labels: [
        'Oct 1', 'Oct 5', 'Oct 10', 'Oct 15', 'Oct 20', 'Oct 25', 'Oct 30'
      ],
      datasets: [
        {
          label: 'Bookings',
          fill: true,
          backgroundColor: 'rgba(66, 139, 202, .25)',
          borderColor: 'rgba(66, 139, 202, 1)',
          pointBackgroundColor: 'rgba(66, 139, 202, 1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(66, 139, 202, 1)',
          data: [5, 7, 12, 8, 15, 10, 14]
        }
      ]
    };

    // Chart Options
    const chartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      tension: 0.4,
      scales: {
        y: {
          suggestedMin: 0,
          suggestedMax: 20
        }
      },
      interaction: {
        intersect: false,
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.dataset.label + ': ' + context.parsed.y + ' bookings';
            }
          }
        }
      }
    };

    // Get Chart Canvas
    const chartCanvas = document.getElementById('js-chartjs-line');

    // Create Chart
    if (chartCanvas) {
      new Chart(chartCanvas, {
        type: 'line',
        data: chartData,
        options: chartOptions
      });
    }
  });
</script>
@endsection
