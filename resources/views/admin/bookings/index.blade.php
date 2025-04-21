@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Booking Management</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Bookings -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">All Bookings</h3>
        <div class="block-options">
          <div class="dropdown">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-ecom-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-filter"></i> Filters <i class="fa fa-fw fa-angle-down ms-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                Pending
                <span class="badge bg-warning">{{ count($bookings->where('status', 'pending')) }}</span>
              </a>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                Confirmed
                <span class="badge bg-success">{{ count($bookings->where('status', 'confirmed')) }}</span>
              </a>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                Cancelled
                <span class="badge bg-danger">{{ count($bookings->where('status', 'cancelled')) }}</span>
              </a>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                Completed
                <span class="badge bg-info">{{ count($bookings->where('status', 'completed')) }}</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                All
                <span class="badge bg-primary">{{ count($bookings) }}</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="block-content">
        <!-- Search Form -->
        <form action="{{ route('admin.bookings.index') }}" method="GET">
          <div class="mb-4">
            <div class="input-group">
              <input type="text" class="form-control form-control-alt" name="search" value="{{ request('search') }}" placeholder="Search bookings by name, email or tour...">
              <button type="submit" class="btn btn-alt-info">
                <i class="fa fa-fw fa-search me-1"></i> Search
              </button>
            </div>
          </div>
        </form>

        @if (session('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <p class="mb-0">{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            <p class="mb-0">{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- Bookings Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-vcenter">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Tour</th>
                <th>Date</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($bookings as $booking)
                <tr>
                  <td>{{ $booking->id }}</td>
                  <td class="fw-semibold">
                    <a href="{{ route('admin.bookings.show', $booking) }}">{{ $booking->name }}</a>
                    <div class="fs-sm text-muted">{{ $booking->email }}</div>
                  </td>
                  <td>{{ $booking->tour }}</td>
                  <td>{{ $booking->formatted_date }}</td>
                  <td>{!! $booking->status_badge !!}</td>
                  <td>{{ $booking->formatted_created_at }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                        <i class="fa fa-eye"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-alt-danger" data-bs-toggle="tooltip" title="Delete" onclick="confirmDelete({{ $booking->id }})">
                        <i class="fa fa-fw fa-trash-alt"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">No bookings found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
          {{ $bookings->links() }}
        </div>
      </div>
    </div>
    <!-- END Bookings -->
  </div>
  <!-- END Page Content -->

  <!-- Delete Booking Confirmation Modal -->
  <div class="modal fade" id="modal-delete-booking" tabindex="-1" role="dialog" aria-labelledby="modal-delete-booking" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Delete Booking</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
            <p>Are you sure you want to delete this booking? This action cannot be undone.</p>
          </div>
          <div class="block-content block-content-full text-end bg-body">
            <form id="delete-form" action="" method="POST">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js_after')
<script>
  function confirmDelete(bookingId) {
    document.getElementById('delete-form').action = "{{ route('admin.bookings.destroy', '') }}/" + bookingId;
    new bootstrap.Modal(document.getElementById('modal-delete-booking')).show();
  }
</script>
@endsection
