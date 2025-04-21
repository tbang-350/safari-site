@extends('layouts.backend')

@section('css')
<style>
.options-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.25rem;
}

.options-container.selected {
    border: 3px solid #82b54b;
}

.options-item {
    width: 100%;
    height: auto;
}

.options-overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}

.options-container:hover .options-overlay {
    opacity: 1;
}
</style>
@endsection

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
                    {{-- <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#modal-new-tour">
                        <i class="fa fa-fw fa-plus me-1"></i> Add New Tour
                    </button> --}}
                    <a href="{{ route('admin.tours.create') }}" class="btn btn-alt-primary">
                        <i class="fa fa-fw fa-plus me-1"></i> Add New Tour
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Location</th>
                                <th>Featured</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tours-table-body">
                            @forelse($tours as $tour)
                                <tr data-tour-id="{{ $tour->id }}">
                                    <td>
                                        @if($tour->image_source)
                                            <img src="{{ $tour->image_type === 'pexels' ? $tour->image_source : asset('storage/' . $tour->image_source) }}"
                                                alt="{{ $tour->title }}" class="img-avatar img-avatar48">
                                        @else
                                            <img src="{{ asset('media/avatars/avatar0.jpg') }}" alt="No Image" class="img-avatar img-avatar48">
                                        @endif
                                    </td>
                                    <td class="fw-semibold">
                                        {{ $tour->title }}
                                        @if($tour->is_featured)
                                            <span class="badge bg-warning ms-1">Featured</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($tour->price, 2) }}</td>
                                    <td>{{ $tour->duration }} days</td>
                                    <td>{{ $tour->location }}</td>
                                    <td>
                                        <span class="badge bg-{{ $tour->is_featured ? 'success' : 'secondary' }}">
                                            {{ $tour->is_featured ? 'Yes' : 'No' }}
                                        </span>
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
                                                data-tour-title="{{ $tour->title }}">
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
                                    <label class="form-label" for="title">Tour Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                    <div class="invalid-feedback" id="title-error"></div>
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
                                    <label class="form-label" for="max_people">Maximum People</label>
                                    <input type="number" class="form-control" id="max_people" name="max_people" min="1">
                                    <div class="invalid-feedback" id="max_people-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="difficulty_level">Difficulty Level <span class="text-danger">*</span></label>
                                    <select class="form-select" id="difficulty_level" name="difficulty_level" required>
                                        <option value="easy">Easy</option>
                                        <option value="moderate">Moderate</option>
                                        <option value="challenging">Challenging</option>
                                    </select>
                                    <div class="invalid-feedback" id="difficulty_level-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Image Source</label>
                                    <div class="space-y-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="image_type" id="image_type_custom" value="custom" checked>
                                            <label class="form-check-label" for="image_type_custom">Upload Image</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="image_type" id="image_type_pexels" value="pexels">
                                            <label class="form-check-label" for="image_type_pexels">Search Pexels</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="custom-image-upload" class="mb-4">
                                    <label class="form-label" for="image">Upload Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <div class="invalid-feedback" id="image-error"></div>
                                </div>

                                <div id="pexels-image-search" class="mb-4" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label" for="pexels_search">Search Pexels Images</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pexels_search" placeholder="Search for images...">
                                            <button type="button" class="btn btn-alt-primary" id="search-pexels">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="pexels-results" class="row g-2">
                                        <!-- Pexels images will be loaded here -->
                                    </div>
                                    <input type="hidden" name="image_source" id="selected_image">
                                </div>

                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                                        <label class="form-check-label" for="is_featured">Featured Tour</label>
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
                                    <label class="form-label" for="included_services">Included Services</label>
                                    <textarea class="form-control" id="included_services" name="included_services" rows="4"></textarea>
                                    <div class="form-text">Enter each service on a new line</div>
                                    <div class="invalid-feedback" id="included_services-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="excluded_services">Not Included</label>
                                    <textarea class="form-control" id="excluded_services" name="excluded_services" rows="4"></textarea>
                                    <div class="form-text">Enter each item on a new line</div>
                                    <div class="invalid-feedback" id="excluded_services-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="itinerary">Itinerary</label>
                                    <textarea class="form-control" id="itinerary" name="itinerary" rows="4"></textarea>
                                    <div class="form-text">Enter each day's itinerary on a new line</div>
                                    <div class="invalid-feedback" id="itinerary-error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-primary" id="submit-new-tour">
                            <i class="fa fa-check me-1"></i> Create Tour
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
                                    <label class="form-label" for="edit-title">Tour Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit-title" name="title" required>
                                    <div class="invalid-feedback" id="edit-title-error"></div>
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
                                    <label class="form-label" for="edit-difficulty_level">Difficulty Level <span class="text-danger">*</span></label>
                                    <select class="form-select" id="edit-difficulty_level" name="difficulty_level" required>
                                        <option value="easy">Easy</option>
                                        <option value="moderate">Moderate</option>
                                        <option value="challenging">Challenging</option>
                                    </select>
                                    <div class="invalid-feedback" id="edit-difficulty_level-error"></div>
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
                                        <input class="form-check-input" type="checkbox" id="edit-is_featured" name="is_featured" value="1">
                                        <label class="form-check-label" for="edit-is_featured">Featured Tour</label>
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
                                    <label class="form-label" for="edit-included_services">Included Services</label>
                                    <textarea class="form-control" id="edit-included_services" name="included_services" rows="4"></textarea>
                                    <div class="form-text">Enter each service on a new line</div>
                                    <div class="invalid-feedback" id="edit-included_services-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-excluded_services">Not Included</label>
                                    <textarea class="form-control" id="edit-excluded_services" name="excluded_services" rows="4"></textarea>
                                    <div class="form-text">Enter each item on a new line</div>
                                    <div class="invalid-feedback" id="edit-excluded_services-error"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="edit-itinerary">Itinerary</label>
                                    <textarea class="form-control" id="edit-itinerary" name="itinerary" rows="4"></textarea>
                                    <div class="form-text">Enter each day's itinerary on a new line</div>
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
                        <p>Are you sure you want to delete the tour <strong id="delete-tour-title"></strong>?</p>
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

@push('js')
    @vite(['resources/js/admin/tours.js'])
@endpush
