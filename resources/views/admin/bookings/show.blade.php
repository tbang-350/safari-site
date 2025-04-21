@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Booking Details</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Bookings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
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

    <div class="row">
      <div class="col-md-7">
        <!-- Booking Information -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Booking Information</h3>
            <div class="block-options">
              <button type="button" class="btn btn-sm btn-alt-danger" onclick="confirmDelete({{ $booking->id }})">
                <i class="fa fa-fw fa-trash-alt me-1"></i> Delete
              </button>
            </div>
          </div>
          <div class="block-content">
            <div class="row mb-4">
              <div class="col-sm-6">
                <h4 class="fs-sm text-muted mb-1">Booking ID</h4>
                <div class="fw-semibold">#{{ $booking->id }}</div>
              </div>
              <div class="col-sm-6">
                <h4 class="fs-sm text-muted mb-1">Created</h4>
                <div class="fw-semibold">{{ $booking->formatted_created_at }}</div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-6">
                <h4 class="fs-sm text-muted mb-1">Safari Tour</h4>
                <div class="fw-semibold">{{ $booking->tour }}</div>
              </div>
              <div class="col-sm-6">
                <h4 class="fs-sm text-muted mb-1">Tour Date</h4>
                <div class="fw-semibold">{{ $booking->formatted_date }}</div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-12">
                <h4 class="fs-sm text-muted mb-1">Special Requirements</h4>
                <div class="fw-semibold">
                  @if ($booking->message)
                    {{ $booking->message }}
                  @else
                    <span class="text-muted">No special requirements provided</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Booking Information -->
      </div>
      <div class="col-md-5">
        <!-- Customer Information -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Customer Information</h3>
          </div>
          <div class="block-content">
            <div class="row">
              <div class="col-sm-12 mb-4">
                <h4 class="fs-sm text-muted mb-1">Name</h4>
                <div class="fw-semibold">{{ $booking->name }}</div>
              </div>
              <div class="col-sm-12 mb-4">
                <h4 class="fs-sm text-muted mb-1">Email</h4>
                <div class="fw-semibold">
                  <a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>
                </div>
              </div>
            </div>
            <hr>
            <div class="mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="fs-sm text-muted mb-0">Status</h4>
                {!! $booking->status_badge !!}
              </div>
            </div>
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-4">
                <label class="form-label" for="status">Update Status</label>
                <select class="form-select" id="status" name="status">
                  <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                  <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                  <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
              </div>
              <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-fw fa-check me-1"></i> Update Status
                </button>
              </div>
            </form>
            <hr>
            <div class="mb-4">
              <button type="button" class="btn btn-alt-info" onclick="window.location.href='mailto:{{ $booking->email }}'">
                <i class="fa fa-fw fa-envelope me-1"></i> Email Customer
              </button>
            </div>
          </div>
        </div>
        <!-- END Customer Information -->
      </div>
    </div>
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
            <form id="delete-form" action="{{ route('admin.bookings.destroy', $booking) }}" method="POST">
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
    new bootstrap.Modal(document.getElementById('modal-delete-booking')).show();
  }
</script>
@endsection
