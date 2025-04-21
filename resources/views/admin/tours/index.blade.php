@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Tours</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tours</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        @include('shared.success')
        @include('shared.error')

        <!-- Tours List -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">All Tours</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#modal-new-tour">
                        <i class="fa fa-fw fa-plus me-1"></i> Add New Tour
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tours-table-body">
                            @forelse($tours as $tour)
                                <tr data-tour-id="{{ $tour->id }}">
                                    <td>
                                        @if($tour->image)
                                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}" class="img-avatar img-avatar48">
                                        @else
                                            <img src="{{ asset('media/avatars/avatar0.jpg') }}" alt="No Image" class="img-avatar img-avatar48">
                                        @endif
                                    </td>
                                    <td class="fw-semibold">
                                        {{ $tour->name }}
                                        @if($tour->featured)
                                            <span class="badge bg-warning ms-1">Featured</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($tour->price, 2) }}</td>
                                    <td>{{ $tour->duration }} days</td>
                                    <td>{{ $tour->location }}</td>
                                    <td>
                                        @if($tour->active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-secondary edit-tour-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-tour"
                                                data-tour-id="{{ $tour->id }}"
                                                data-tour-data="{{ json_encode($tour) }}">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-alt-secondary delete-tour-btn"
                                                data-tour-id="{{ $tour->id }}"
                                                data-tour-name="{{ $tour->name }}">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No tours found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($tours->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $tours->links() }}
                    </div>
                @endif
            </div>
        </div>
        <!-- END Tours List -->
    </div>
    <!-- END Page Content -->

    <!-- New Tour Modal -->
    <div class="modal fade" id="modal-new-tour" tabindex="-1" role="dialog" aria-labelledby="modal-new-tour" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add New Tour</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="new-tour-form" class="row" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="name">Tour Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                                    </div>
                                    <div class="invalid-feedback" id="price-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="duration">Duration (Days) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="duration" name="duration" min="1" required>
                                    <div class="invalid-feedback" id="duration-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="location">Location <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                    <div class="invalid-feedback" id="location-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="difficulty">Difficulty <span class="text-danger">*</span></label>
                                    <select class="form-select" id="difficulty" name="difficulty" required>
                                        <option value="easy">Easy</option>
                                        <option value="moderate">Moderate</option>
                                        <option value="challenging">Challenging</option>
                                    </select>
                                    <div class="invalid-feedback" id="difficulty-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="image">Tour Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <div class="invalid-feedback" id="image-error"></div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                                        <label class="form-check-label" for="featured">Featured Tour</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    <div class="invalid-feedback" id="description-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="highlights">Highlights</label>
                                    <textarea class="form-control" id="highlights" name="highlights" rows="4"></textarea>
                                    <div class="form-text">Enter each highlight on a new line</div>
                                    <div class="invalid-feedback" id="highlights-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="itinerary">Itinerary</label>
                                    <textarea class="form-control" id="itinerary" name="itinerary" rows="5"></textarea>
                                    <div class="form-text">Detailed day-by-day itinerary</div>
                                    <div class="invalid-feedback" id="itinerary-error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-primary" id="create-tour-btn">
                            <i class="fa fa-fw fa-check me-1"></i> Create Tour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END New Tour Modal -->

    <!-- Edit Tour Modal -->
    <div class="modal fade" id="modal-edit-tour" tabindex="-1" role="dialog" aria-labelledby="modal-edit-tour" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Tour</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="edit-tour-form" class="row" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit-tour-id" name="tour_id">

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="edit-name">Tour Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit-name" name="name" required>
                                    <div class="invalid-feedback" id="edit-name-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-price">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="edit-price" name="price" step="0.01" min="0" required>
                                    </div>
                                    <div class="invalid-feedback" id="edit-price-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-duration">Duration (Days) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edit-duration" name="duration" min="1" required>
                                    <div class="invalid-feedback" id="edit-duration-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-location">Location <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit-location" name="location" required>
                                    <div class="invalid-feedback" id="edit-location-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-difficulty">Difficulty <span class="text-danger">*</span></label>
                                    <select class="form-select" id="edit-difficulty" name="difficulty" required>
                                        <option value="easy">Easy</option>
                                        <option value="moderate">Moderate</option>
                                        <option value="challenging">Challenging</option>
                                    </select>
                                    <div class="invalid-feedback" id="edit-difficulty-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-image">Tour Image</label>
                                    <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                                    <div class="form-text">Leave empty to keep current image</div>
                                    <div class="invalid-feedback" id="edit-image-error"></div>
                                    <div id="current-image-preview" class="mt-2 d-none">
                                        <img src="" alt="Current Image" class="img-fluid img-thumbnail" style="max-height: 150px;">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit-featured" name="featured" value="1">
                                        <label class="form-check-label" for="edit-featured">Featured Tour</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit-active" name="active" value="1">
                                        <label class="form-check-label" for="edit-active">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="edit-description">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="edit-description" name="description" rows="4" required></textarea>
                                    <div class="invalid-feedback" id="edit-description-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-highlights">Highlights</label>
                                    <textarea class="form-control" id="edit-highlights" name="highlights" rows="4"></textarea>
                                    <div class="form-text">Enter each highlight on a new line</div>
                                    <div class="invalid-feedback" id="edit-highlights-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-itinerary">Itinerary</label>
                                    <textarea class="form-control" id="edit-itinerary" name="itinerary" rows="5"></textarea>
                                    <div class="form-text">Detailed day-by-day itinerary</div>
                                    <div class="invalid-feedback" id="edit-itinerary-error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-primary" id="update-tour-btn">
                            <i class="fa fa-fw fa-check me-1"></i> Update Tour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Edit Tour Modal -->

    <!-- Delete Tour Confirmation Modal -->
    <div class="modal fade" id="modal-delete-tour" tabindex="-1" role="dialog" aria-labelledby="modal-delete-tour" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Delete Tour</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <p>Are you sure you want to delete the tour <strong id="delete-tour-name"></strong>?</p>
                        <p class="text-danger">This action cannot be undone.</p>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-danger" id="confirm-delete-tour-btn">
                            <i class="fa fa-fw fa-trash me-1"></i> Delete Tour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Delete Tour Confirmation Modal -->
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create new tour
        document.getElementById('create-tour-btn').addEventListener('click', function() {
            const form = document.getElementById('new-tour-form');
            const formData = new FormData(form);

            // Reset error messages
            form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            form.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('is-invalid'));

            fetch('{{ route("admin.tours.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    // Display validation errors
                    Object.keys(data.errors).forEach(key => {
                        const errorMsg = data.errors[key][0];
                        const errorElement = document.getElementById(`${key}-error`);
                        const inputElement = document.getElementById(key);

                        if (errorElement && inputElement) {
                            errorElement.textContent = errorMsg;
                            inputElement.classList.add('is-invalid');
                        }
                    });
                } else if (data.success) {
                    // Close modal and reload page to show new tour
                    bootstrap.Modal.getInstance(document.getElementById('modal-new-tour')).hide();
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while creating the tour.');
            });
        });

        // Edit tour modal
        document.querySelectorAll('.edit-tour-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tourData = JSON.parse(this.getAttribute('data-tour-data'));

                // Populate the form fields
                document.getElementById('edit-tour-id').value = tourData.id;
                document.getElementById('edit-name').value = tourData.name;
                document.getElementById('edit-price').value = tourData.price;
                document.getElementById('edit-duration').value = tourData.duration;
                document.getElementById('edit-location').value = tourData.location;
                document.getElementById('edit-difficulty').value = tourData.difficulty;
                document.getElementById('edit-description').value = tourData.description;
                document.getElementById('edit-highlights').value = tourData.highlights;
                document.getElementById('edit-itinerary').value = tourData.itinerary;

                // Handle checkboxes
                document.getElementById('edit-featured').checked = tourData.featured;
                document.getElementById('edit-active').checked = tourData.active;

                // Show current image if exists
                const imagePreview = document.getElementById('current-image-preview');
                if (tourData.image) {
                    imagePreview.classList.remove('d-none');
                    imagePreview.querySelector('img').src = `/storage/${tourData.image}`;
                } else {
                    imagePreview.classList.add('d-none');
                }
            });
        });

        // Update tour
        document.getElementById('update-tour-btn').addEventListener('click', function() {
            const form = document.getElementById('edit-tour-form');
            const formData = new FormData(form);
            const tourId = document.getElementById('edit-tour-id').value;

            // Reset error messages
            form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            form.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('is-invalid'));

            fetch(`{{ url('dashboard/tours') }}/${tourId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    // Display validation errors
                    Object.keys(data.errors).forEach(key => {
                        const errorMsg = data.errors[key][0];
                        const errorElement = document.getElementById(`edit-${key}-error`);
                        const inputElement = document.getElementById(`edit-${key}`);

                        if (errorElement && inputElement) {
                            errorElement.textContent = errorMsg;
                            inputElement.classList.add('is-invalid');
                        }
                    });
                } else if (data.success) {
                    // Close modal and reload page to show updated tour
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-tour')).hide();
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the tour.');
            });
        });

        // Delete tour confirmaiton modal
        document.querySelectorAll('.delete-tour-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tourId = this.getAttribute('data-tour-id');
                const tourName = this.getAttribute('data-tour-name');

                document.getElementById('delete-tour-name').textContent = tourName;

                const modal = new bootstrap.Modal(document.getElementById('modal-delete-tour'));
                modal.show();

                document.getElementById('confirm-delete-tour-btn').setAttribute('data-tour-id', tourId);
            });
        });

        // Delete tour
        document.getElementById('confirm-delete-tour-btn').addEventListener('click', function() {
            const tourId = this.getAttribute('data-tour-id');

            fetch(`{{ url('dashboard/tours') }}/${tourId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal and reload page
                    bootstrap.Modal.getInstance(document.getElementById('modal-delete-tour')).hide();
                    window.location.reload();
                } else {
                    alert('An error occurred while deleting the tour.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the tour.');
            });
        });
    });
</script>
@endsection
