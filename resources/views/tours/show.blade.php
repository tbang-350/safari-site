@extends('layouts.simple')

@section('content')
    <!-- Navigation -->
    <div class="bg-body-light border-bottom">
        <div class="content py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('tours.index') }}">Tours</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $tour->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tour Hero -->
    <div class="bg-image" style="background-image: url('{{ $tour->image_source ? ($tour->image_type === 'pexels' ? $tour->image_source : asset('storage/' . $tour->image_source)) : asset('media/photos/photo21.jpg') }}');">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3 text-white">
                    <h1 class="h2 fw-bold mb-2">{{ $tour->title }}</h1>
                    <h2 class="h4 fw-normal text-white-75">{{ $tour->location }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END Tour Hero -->

    <!-- Tour Content -->
    <div class="content content-full">
        <div class="row py-5">
            <!-- Tour Details -->
            <div class="col-lg-8">
                <div class="block block-rounded">
                    <div class="block-content">
                        <!-- Tour Images Carousel -->
                        <div id="tour-images" class="carousel slide mb-4" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($tourImages as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $image->url }}" class="d-block w-100" alt="{{ $image->alt_text }}">
                                    <div class="carousel-caption d-none d-md-block">
                                        <small>Photo by <a href="{{ $image->photographer_url }}" class="text-white" target="_blank">{{ $image->photographer }}</a> on Pexels</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#tour-images" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#tour-images" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            <div class="carousel-indicators">
                                @foreach($tourImages as $index => $image)
                                <button type="button" data-bs-target="#tour-images" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></button>
                                @endforeach
                            </div>
                        </div>
                        <!-- END Tour Images Carousel -->

                        <h3 class="h4">Tour Overview</h3>
                        <p>{{ $tour->description }}</p>

                        <h3 class="h4 mt-5">Itinerary</h3>
                        <div class="timeline">
                            @foreach($tour->itinerary as $day)
                            <div class="timeline-event">
                                @php
                                    $dayText = preg_match('/Day (\d+(?:-\d+)?):/', $day, $matches) ? $matches[0] : 'Day';
                                    $description = trim(preg_replace('/Day \d+(?:-\d+)?:/', '', $day));
                                @endphp
                                <div class="timeline-event-icon bg-primary">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="timeline-event-block block">
                                    <div class="block-header">
                                        <h3 class="block-title">{{ trim(str_replace(':', '', $dayText)) }}</h3>
                                    </div>
                                    <div class="block-content">
                                        <p class="fw-normal mb-0">{{ $description }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <h3 class="h4 mt-5">What's Included</h3>
                        <ul class="fa-ul text-success">
                            @foreach($tour->included_services as $service)
                            <li>
                                <span class="fa-li"><i class="fa fa-check"></i></span>
                                {{ $service }}
                            </li>
                            @endforeach
                        </ul>

                        <h3 class="h4 mt-5">What's Not Included</h3>
                        <ul class="fa-ul text-danger">
                            @foreach($tour->excluded_services as $service)
                            <li>
                                <span class="fa-li"><i class="fa fa-times"></i></span>
                                {{ $service }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END Tour Details -->

            <!-- Tour Sidebar -->
            <div class="col-lg-4">
                <div class="block block-rounded">
                    <div class="block-content">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <div class="fs-3 fw-bold text-primary">${{ number_format($tour->price, 2) }}</div>
                                <div class="fs-sm text-muted">per person</div>
                            </div>
                            <div>
                                <span class="badge bg-primary">{{ $tour->duration }} days</span>
                                <span class="badge bg-{{ $tour->difficulty_level === 'easy' ? 'success' : ($tour->difficulty_level === 'moderate' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($tour->difficulty_level) }}
                                </span>
                            </div>
                        </div>

                        <hr>

                        <h4 class="h5">Quick Facts</h4>
                        <div class="row g-0 mb-4">
                            <div class="col-6 border-end border-bottom p-2">
                                <div class="text-muted fs-sm">Duration</div>
                                <div class="fw-semibold">{{ $tour->duration }} days</div>
                            </div>
                            <div class="col-6 border-bottom p-2">
                                <div class="text-muted fs-sm">Group Size</div>
                                <div class="fw-semibold">Max {{ $tour->max_people }} people</div>
                            </div>
                            <div class="col-6 border-end p-2">
                                <div class="text-muted fs-sm">Difficulty</div>
                                <div class="fw-semibold">{{ ucfirst($tour->difficulty_level) }}</div>
                            </div>
                            <div class="col-6 p-2">
                                <div class="text-muted fs-sm">Location</div>
                                <div class="fw-semibold">{{ $tour->location }}</div>
                            </div>
                        </div>

                        <a href="#" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#modal-booking">
                            <i class="fa fa-calendar-alt opacity-50 me-1"></i> Book Now
                        </a>
                        <a href="#" class="btn btn-alt-primary w-100" data-bs-toggle="modal" data-bs-target="#modal-enquiry">
                            <i class="fa fa-envelope opacity-50 me-1"></i> Enquire
                        </a>
                    </div>
                </div>

                <!-- Related Tours -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Similar Tours</h3>
                    </div>
                    <div class="block-content">
                        @foreach($relatedTours as $relatedTour)
                        <a class="block block-rounded block-link-shadow mb-2" href="{{ route('tours.show', $relatedTour->slug) }}">
                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="fs-sm text-primary mb-0">{{ $relatedTour->duration }} days</p>
                                    <p class="fs-base fw-semibold mb-0">{{ $relatedTour->title }}</p>
                                    <p class="fs-sm text-muted mb-0">${{ number_format($relatedTour->price, 2) }}</p>
                                </div>
                                <div class="ms-3">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <!-- END Related Tours -->
            </div>
            <!-- END Tour Sidebar -->
        </div>
    </div>
    <!-- END Tour Content -->

@endsection

@section('css_after')
<style>
    /* Timeline styling */
    .timeline {
        position: relative;
        padding: 2rem 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 1.25rem;
        height: 100%;
        width: 3px;
        background: #e9ecef;
    }

    .timeline-event {
        position: relative;
        margin-bottom: 2rem;
        margin-left: 3rem;
    }

    .timeline-event:last-child {
        margin-bottom: 0;
    }

    .timeline-event-icon {
        position: absolute;
        left: -3rem;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        text-align: center;
        line-height: 2.5rem;
        color: #fff;
        z-index: 5;
    }

    .timeline-event-icon i {
        font-size: 1rem;
    }

    .timeline-event-block {
        position: relative;
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }

    .timeline-event-block::before {
        content: '';
        position: absolute;
        top: 1rem;
        left: -0.5rem;
        width: 1rem;
        height: 1rem;
        background-color: #fff;
        border-left: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
        transform: rotate(45deg);
    }

    .timeline-event-block .block-header {
        padding: 0.75rem 1.25rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .timeline-event-block .block-content {
        padding: 1.25rem;
    }

    .timeline-event-block .block-title {
        margin-bottom: 0;
        color: #e67e22;
        font-size: 1.1rem;
    }

    /* Breadcrumb styling */
    .breadcrumb-alt {
        padding: 0;
        margin: 0;
        background: none;
        border-radius: 0;
    }

    .breadcrumb-alt .breadcrumb-item {
        font-size: 0.9rem;
    }

    .breadcrumb-alt .breadcrumb-item a {
        color: #e67e22;
        text-decoration: none;
    }

    .breadcrumb-alt .breadcrumb-item a:hover {
        color: #d35400;
    }

    .breadcrumb-alt .breadcrumb-item.active {
        color: #6c757d;
    }

    .breadcrumb-alt .breadcrumb-item + .breadcrumb-item::before {
        content: '\f105';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #6c757d;
    }

    /* Carousel styling */
    #tour-images {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    #tour-images .carousel-item {
        height: 400px;
    }

    #tour-images .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }

    #tour-images .carousel-caption {
        background: rgba(0,0,0,0.5);
        border-radius: 0.25rem;
        padding: 0.5rem;
    }

    #tour-images .carousel-control-prev,
    #tour-images .carousel-control-next {
        width: 40px;
        height: 40px;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #tour-images:hover .carousel-control-prev,
    #tour-images:hover .carousel-control-next {
        opacity: 1;
    }
</style>
@endsection
