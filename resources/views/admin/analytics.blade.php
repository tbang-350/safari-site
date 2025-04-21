@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Analytics Dashboard</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Overview -->
        <div class="row items-push">
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-users fa-lg text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">2,388</div>
                        <div class="text-muted mb-3">Total Visitors</div>
                        <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            19.2%
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="javascript:void(0)">
                            View Details
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-calendar-check fa-lg text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">152</div>
                        <div class="text-muted mb-3">Monthly Bookings</div>
                        <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            12.5%
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="javascript:void(0)">
                            View Details
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-envelope fa-lg text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">64</div>
                        <div class="text-muted mb-3">New Messages</div>
                        <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            3.8%
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="javascript:void(0)">
                            View Details
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-dollar-sign fa-lg text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">$7,580</div>
                        <div class="text-muted mb-3">Monthly Revenue</div>
                        <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            25.6%
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="javascript:void(0)">
                            View Details
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Overview -->

        <!-- Visitors Chart -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Visitors</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="py-3 text-center">
                    <!-- Visitors Chart Container -->
                    <div class="js-visitors-chart" style="height: 360px;"></div>
                </div>
            </div>
        </div>
        <!-- END Visitors Chart -->

        <!-- Top Destinations & Recent Bookings -->
        <div class="row">
            <!-- Top Destinations -->
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Top Destinations</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <thead>
                                <tr>
                                    <th>Destination</th>
                                    <th class="text-center">Visits</th>
                                    <th class="text-center">Bookings</th>
                                    <th class="d-none d-sm-table-cell text-end">Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Serengeti National Park</td>
                                    <td class="text-center">5,680</td>
                                    <td class="text-center">356</td>
                                    <td class="d-none d-sm-table-cell text-end">$18,390</td>
                                </tr>
                                <tr>
                                    <td>Mount Kilimanjaro</td>
                                    <td class="text-center">4,560</td>
                                    <td class="text-center">289</td>
                                    <td class="d-none d-sm-table-cell text-end">$15,280</td>
                                </tr>
                                <tr>
                                    <td>Ngorongoro Crater</td>
                                    <td class="text-center">3,450</td>
                                    <td class="text-center">198</td>
                                    <td class="d-none d-sm-table-cell text-end">$9,840</td>
                                </tr>
                                <tr>
                                    <td>Zanzibar Beach</td>
                                    <td class="text-center">3,320</td>
                                    <td class="text-center">167</td>
                                    <td class="d-none d-sm-table-cell text-end">$8,950</td>
                                </tr>
                                <tr>
                                    <td>Tarangire National Park</td>
                                    <td class="text-center">1,780</td>
                                    <td class="text-center">86</td>
                                    <td class="d-none d-sm-table-cell text-end">$4,380</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Top Destinations -->

            <!-- Recent Bookings -->
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Recent Bookings</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Destination</th>
                                    <th class="d-none d-sm-table-cell text-end">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)"><strong>ORD.1851</strong></a>
                                    </td>
                                    <td>John Smith</td>
                                    <td>Serengeti Safari</td>
                                    <td class="d-none d-sm-table-cell text-end">$1,250</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)"><strong>ORD.1850</strong></a>
                                    </td>
                                    <td>Susan Johnson</td>
                                    <td>Kilimanjaro Trek</td>
                                    <td class="d-none d-sm-table-cell text-end">$2,880</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)"><strong>ORD.1849</strong></a>
                                    </td>
                                    <td>Robert Davis</td>
                                    <td>Zanzibar Beach Resort</td>
                                    <td class="d-none d-sm-table-cell text-end">$980</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)"><strong>ORD.1848</strong></a>
                                    </td>
                                    <td>Maria Garcia</td>
                                    <td>Ngorongoro Wildlife Tour</td>
                                    <td class="d-none d-sm-table-cell text-end">$1,760</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)"><strong>ORD.1847</strong></a>
                                    </td>
                                    <td>James Wilson</td>
                                    <td>Tarangire Safari</td>
                                    <td class="d-none d-sm-table-cell text-end">$890</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Recent Bookings -->
        </div>
        <!-- END Top Destinations & Recent Bookings -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
<script>
    // Chart data (placeholder for actual data integration)
    Dashmix.onLoad(() => {
        // Sample data for visitors chart
        new Chart(document.getElementById('js-visitors-chart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Visitors',
                    fill: true,
                    backgroundColor: 'rgba(37, 121, 232, .15)',
                    borderColor: 'rgba(37, 121, 232, 1)',
                    pointBackgroundColor: 'rgba(37, 121, 232, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(37, 121, 232, 1)',
                    data: [1895, 2305, 3140, 2980, 3250, 3520, 3180, 3320, 3710, 4210, 4385, 4980]
                }]
            },
            options: {
                tension: 0.4,
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 6000
                    }
                },
                interaction: {
                    intersect: false,
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
