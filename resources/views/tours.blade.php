@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo21@2x.jpg') }}');">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">
                    <h1 class="h2 text-white mb-2">Our Tours</h1>
                    <h2 class="h4 fw-normal text-white-75">Discover amazing destinations with us</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Tours -->
    <div class="content content-full">
        <div class="row py-5">
            @forelse($tours as $tour)
                <div class="col-md-6 col-xl-4">
                    <div class="block block-rounded h-100 mb-4">
                        <div class="block-content p-0 overflow-hidden">
                            <a class="img-link img-fluid-100" href="{{ route('tours.show', $tour->slug) }}">
                                <img class="img-fluid" src="{{ $tour->image_source ? ($tour->image_type === 'pexels' ? $tour->image_source : asset('storage/' . $tour->image_source)) : asset('media/photos/photo21.jpg') }}" alt="{{ $tour->title }}">
                            </a>
                        </div>
                        <div class="block-content">
                            <h4 class="mb-1">
                                <a class="text-dark" href="{{ route('tours.show', $tour->slug) }}">{{ $tour->title }}</a>
                            </h4>
                            <p class="fs-sm mb-2">
                                <span class="text-primary">{{ $tour->location }}</span>
                                <span class="text-muted mx-2">•</span>
                                <span class="text-muted">{{ $tour->duration }} days</span>
                                @if($tour->max_people)
                                    <span class="text-muted mx-2">•</span>
                                    <span class="text-muted">Max {{ $tour->max_people }} people</span>
                                @endif
                            </p>
                            <p class="fs-sm text-muted">{{ Str::limit($tour->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-sm">
                                    <span class="badge bg-{{ $tour->difficulty_level === 'easy' ? 'success' : ($tour->difficulty_level === 'moderate' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($tour->difficulty_level) }}
                                    </span>
                                    @if($tour->is_featured)
                                        <span class="badge bg-primary ms-1">Featured</span>
                                    @endif
                                </div>
                                <div class="fs-4 fw-semibold">${{ number_format($tour->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="block block-rounded">
                        <div class="block-content text-center">
                            <p>No tours available at the moment.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($tours->hasPages())
            <div class="d-flex justify-content-center">
                {{ $tours->links() }}
            </div>
        @endif
    </div>
    <!-- END Tours -->
@endsection
