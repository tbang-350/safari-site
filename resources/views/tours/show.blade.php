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

    <!-- Tour Content -->
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

                <!-- Tour Details -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tour Details</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Duration:</strong> {{ $tour->duration }} days</p>
                                <p><strong>Difficulty Level:</strong> {{ ucfirst($tour->difficulty_level) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Maximum People:</strong> {{ $tour->max_people ?? 'No limit' }}</p>
                                <p><strong>Price:</strong> ${{ number_format($tour->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($tour->included_services)
                <!-- Included Services -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">What's Included</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul">
                            @foreach($tour->included_services as $service)
                            <li>
                                <span class="fa-li"><i class="fa fa-check text-success"></i></span>
                                {{ $service }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if($tour->excluded_services)
                <!-- Excluded Services -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Not Included</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul">
                            @foreach($tour->excluded_services as $service)
                            <li>
                                <span class="fa-li"><i class="fa fa-times text-danger"></i></span>
                                {{ $service }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if($tour->itinerary)
                <!-- Itinerary -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Itinerary</h3>
                    </div>
                    <div class="block-content">
                        <div class="timeline timeline-alt">
                            @foreach($tour->itinerary as $index => $item)
                            <div class="timeline-item">
                                <div class="timeline-event">
                                    <div class="timeline-event-icon bg-default">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </div>
                                    <div class="timeline-event-block">
                                        <p class="fw-semibold mb-2">Day {{ $index + 1 }}</p>
                                        <p class="fs-sm">{{ $item }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4">
                <!-- Booking Form -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Book This Tour</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <div class="mb-4">
                                <label class="form-label" for="name">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="date">Preferred Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="participants">Number of Participants</label>
                                <input type="number" class="form-control" id="participants" name="participants" min="1" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="message">Special Requirements</label>
                                <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    Book Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Related Tours -->
                @if($relatedTours->count() > 0)
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Similar Tours</h3>
                    </div>
                    <div class="block-content">
                        @foreach($relatedTours as $relatedTour)
                        <div class="d-flex align-items-center push">
                            <div class="flex-shrink-0">
                                <img class="img-fluid" src="{{ $relatedTour->image_source ? ($relatedTour->image_type === 'pexels' ? $relatedTour->image_source : asset('storage/' . $relatedTour->image_source)) : asset('media/photos/photo21.jpg') }}" alt="{{ $relatedTour->title }}" style="width: 100px; height: 60px; object-fit: cover;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold mb-1">
                                    <a href="{{ route('tours.show', $relatedTour->slug) }}">{{ $relatedTour->title }}</a>
                                </div>
                                <div class="fs-sm">${{ number_format($relatedTour->price, 2) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
