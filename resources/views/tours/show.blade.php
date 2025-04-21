@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{ $tour->image_source ? ($tour->image_type === 'pexels' ? $tour->image_source : asset('storage/' . $tour->image_source)) : asset('media/photos/photo21@2x.jpg') }}');">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">
                    <h1 class="h2 text-white mb-2">{{ $tour->title }}</h1>
                    <h2 class="h4 fw-normal text-white-75">{{ $tour->location }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Tour Details -->
    <div class="content content-full">
        <div class="row py-5">
            <div class="col-lg-8">
                <!-- Description -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Description</h3>
                    </div>
                    <div class="block-content">
                        <p class="fs-sm">{{ $tour->description }}</p>
                    </div>
                </div>

                <!-- Included Services -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">What's Included</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul">
                            @foreach(json_decode($tour->included_services) as $service)
                                <li class="mb-2">
                                    <span class="fa-li"><i class="fa fa-check text-success"></i></span>
                                    {{ $service }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Not Included -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Not Included</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul">
                            @foreach(json_decode($tour->excluded_services) as $service)
                                <li class="mb-2">
                                    <span class="fa-li"><i class="fa fa-times text-danger"></i></span>
                                    {{ $service }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Itinerary -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Itinerary</h3>
                    </div>
                    <div class="block-content">
                        <div class="timeline timeline-alt">
                            @foreach(json_decode($tour->itinerary) as $day)
                                <div class="timeline-item">
                                    <div class="timeline-event">
                                        <div class="timeline-event-icon bg-default">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="timeline-event-block">
                                            <p class="fw-semibold mb-0">{{ $day }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Tour Info -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tour Information</h3>
                    </div>
                    <div class="block-content">
                        <div class="row g-0 border-bottom py-2">
                            <div class="col-6">
                                <span class="text-muted">Duration:</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fw-semibold">{{ $tour->duration }} days</span>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom py-2">
                            <div class="col-6">
                                <span class="text-muted">Max People:</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fw-semibold">{{ $tour->max_people ?? 'Not limited' }}</span>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom py-2">
                            <div class="col-6">
                                <span class="text-muted">Difficulty:</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="badge bg-{{ $tour->difficulty_level === 'easy' ? 'success' : ($tour->difficulty_level === 'moderate' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($tour->difficulty_level) }}
                                </span>
                            </div>
                        </div>
                        <div class="row g-0 py-2">
                            <div class="col-6">
                                <span class="text-muted">Price:</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fw-semibold fs-4">${{ number_format($tour->price, 2) }}</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('bookings.create', ['tour' => $tour->slug]) }}" class="btn btn-primary w-100">
                                <i class="fa fa-calendar-plus opacity-50 me-1"></i> Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Tour Details -->
@endsection
