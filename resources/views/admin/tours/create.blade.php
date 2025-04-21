@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create New Tour</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Tours</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        @include('shared.error')

        <form id="create-tour-form" action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Tour Details</h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter tour title" required>
                                <div class="invalid-feedback" id="title-error"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter tour description" required></textarea>
                                <div class="invalid-feedback" id="description-error"></div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="0.00" step="0.01" min="0" required>
                                    <div class="invalid-feedback" id="price-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="duration">Duration (days) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="duration" name="duration" placeholder="1" min="1" required>
                                    <div class="invalid-feedback" id="duration-error"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="location">Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter tour location" required>
                                <div class="invalid-feedback" id="location-error"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tour Image <span class="text-danger">*</span></label>
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

                                <div id="custom-image-upload" class="mt-3">
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <div class="invalid-feedback" id="image-error"></div>
                                </div>

                                <div id="pexels-image-section" class="mt-3" style="display: none;">
                                    <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#modal-pexels-search">
                                        <i class="fa fa-search me-1"></i> Search Pexels Images
                                    </button>
                                    <div id="selected-pexels-preview" class="mt-3" style="display: none;">
                                        <img id="selected-pexels-image" src="" alt="Selected image" class="img-fluid rounded" style="max-height: 200px">
                                        <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-pexels-image">
                                            <i class="fa fa-times me-1"></i> Remove Image
                                        </button>
                                    </div>
                                    <input type="hidden" id="selected_image" name="image_source">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="difficulty_level">Difficulty Level <span class="text-danger">*</span></label>
                                <select class="form-select" id="difficulty_level" name="difficulty_level" required>
                                    <option value="">Select difficulty level</option>
                                    <option value="easy">Easy</option>
                                    <option value="moderate">Moderate</option>
                                    <option value="challenging">Challenging</option>
                                </select>
                                <div class="invalid-feedback" id="difficulty_level-error"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="max_people">Maximum People</label>
                                <input type="number" class="form-control" id="max_people" name="max_people" placeholder="Enter maximum number of people" min="1">
                                <div class="invalid-feedback" id="max_people-error"></div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                                    <label class="form-check-label" for="is_featured">Featured Tour</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check opacity-50 me-1"></i> Create Tour
                    </button>
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-alt-secondary">
                        <i class="fa fa-times opacity-50 me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Pexels Search Modal -->
    <div class="modal fade" id="modal-pexels-search" tabindex="-1" role="dialog" aria-labelledby="modal-pexels-search" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Search Pexels Images</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="mb-4">
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
                    </div>
                    <div class="block-content block-content-full block-content-sm text-end bg-body">
                        <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/admin/tours.js') }}"></script>
@endsection
