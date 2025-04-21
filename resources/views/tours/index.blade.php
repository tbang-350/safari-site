@extends('layouts.simple')

@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{ asset('media/photos/photo21.jpg') }}');">
  <div class="bg-black-50">
    <div class="content content-full text-center">
      <div class="my-3 text-white">
        <h1 class="h2 fw-bold mb-2">Our Safari Tours</h1>
        <h2 class="h4 fw-normal text-white-75">Discover the magic of Tanzania</h2>
      </div>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Tours List -->
<div class="content content-full">
  <div class="row py-5">
    <!-- Filters Sidebar -->
    <div class="col-lg-3">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Filter Tours</h3>
        </div>
        <div class="block-content">
          <form action="{{ route('tours.index') }}" method="GET">
            <!-- Duration Filter -->
            <div class="mb-4">
              <label class="form-label">Duration</label>
              <div class="space-y-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="duration[]" value="1-3" id="duration-1-3" {{ in_array('1-3', request()->input('duration', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="duration-1-3">1-3 Days</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="duration[]" value="4-7" id="duration-4-7" {{ in_array('4-7', request()->input('duration', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="duration-4-7">4-7 Days</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="duration[]" value="8+" id="duration-8" {{ in_array('8+', request()->input('duration', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="duration-8">8+ Days</label>
                </div>
              </div>
            </div>

            <!-- Difficulty Filter -->
            <div class="mb-4">
              <label class="form-label">Difficulty Level</label>
              <div class="space-y-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="difficulty[]" value="easy" id="difficulty-easy" {{ in_array('easy', request()->input('difficulty', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="difficulty-easy">Easy</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="difficulty[]" value="moderate" id="difficulty-moderate" {{ in_array('moderate', request()->input('difficulty', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="difficulty-moderate">Moderate</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="difficulty[]" value="challenging" id="difficulty-challenging" {{ in_array('challenging', request()->input('difficulty', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="difficulty-challenging">Challenging</label>
                </div>
              </div>
            </div>

            <!-- Price Range Filter -->
            <div class="mb-4">
              <label class="form-label" for="price-range">Price Range</label>
              <div class="row g-2">
                <div class="col">
                  <input type="number" class="form-control" name="price_min" id="price-min" placeholder="Min" value="{{ request()->input('price_min') }}">
                </div>
                <div class="col">
                  <input type="number" class="form-control" name="price_max" id="price-max" placeholder="Max" value="{{ request()->input('price_max') }}">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
              <i class="fa fa-filter me-1"></i> Apply Filters
            </button>
          </form>
        </div>
      </div>
    </div>
    <!-- END Filters Sidebar -->

    <!-- Tours Grid -->
    <div class="col-lg-9">
      <!-- Sort Options -->
      <div class="block block-rounded mb-4">
        <div class="block-content block-content-full">
          <div class="row align-items-center">
            <div class="col">
              <span class="fs-sm text-muted">Showing {{ $tours->firstItem() ?? 0 }} - {{ $tours->lastItem() ?? 0 }} of {{ $tours->total() }} tours</span>
            </div>
            <div class="col-auto">
              <select class="form-select form-select-sm" name="sort" onchange="window.location.href = this.value">
                <option value="{{ route('tours.index', array_merge(request()->query(), ['sort' => 'price_asc'])) }}" {{ request()->input('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="{{ route('tours.index', array_merge(request()->query(), ['sort' => 'price_desc'])) }}" {{ request()->input('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="{{ route('tours.index', array_merge(request()->query(), ['sort' => 'duration_asc'])) }}" {{ request()->input('sort') === 'duration_asc' ? 'selected' : '' }}>Duration: Short to Long</option>
                <option value="{{ route('tours.index', array_merge(request()->query(), ['sort' => 'duration_desc'])) }}" {{ request()->input('sort') === 'duration_desc' ? 'selected' : '' }}>Duration: Long to Short</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- Tours Grid -->
      <div class="row items-push">
        @forelse($tours as $tour)
        <div class="col-md-6">
          <a class="block block-rounded block-link-shadow h-100" href="{{ route('tours.show', $tour->slug) }}">
            <div class="block-content p-0 overflow-hidden position-relative">
              <img class="img-fluid" src="{{ $tour->image_source ? ($tour->image_type === 'pexels' ? $tour->image_source : asset('storage/' . $tour->image_source)) : asset('media/photos/photo21.jpg') }}" alt="{{ $tour->title }}">
              <div class="ribbon ribbon-bookmark ribbon-primary">
                <div class="ribbon-box">
                  ${{ number_format($tour->price, 2) }}
                </div>
              </div>
            </div>
            <div class="block-content">
              <h4 class="mb-1">{{ $tour->title }}</h4>
              <p class="fs-sm text-muted">{{ Str::limit($tour->description, 100) }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="badge bg-primary">{{ $tour->duration }} days</span>
                  <span class="badge bg-{{ $tour->difficulty_level === 'easy' ? 'success' : ($tour->difficulty_level === 'moderate' ? 'warning' : 'danger') }}">
                    {{ ucfirst($tour->difficulty_level) }}
                  </span>
                </div>
              </div>
            </div>
          </a>
        </div>
        @empty
        <div class="col-12">
          <div class="block block-rounded">
            <div class="block-content text-center">
              <p class="text-muted">No tours found matching your criteria.</p>
            </div>
          </div>
        </div>
        @endforelse
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        {{ $tours->links() }}
      </div>
    </div>
    <!-- END Tours Grid -->
  </div>
</div>
<!-- END Tours List -->
@endsection

@section('css_after')
<style>
  /* Tour card hover effects */
  .block-link-shadow {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .block-link-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }

  .block-link-shadow img {
    transition: transform 0.3s ease;
  }

  .block-link-shadow:hover img {
    transform: scale(1.05);
  }

  /* Price ribbon */
  .ribbon {
    position: absolute;
    top: 10px;
    right: -5px;
  }

  .ribbon-box {
    padding: 5px 10px;
    background: rgba(230, 126, 34, 0.9);
    color: #fff;
    font-weight: bold;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  /* Filter sidebar */
  .space-y-2 > * + * {
    margin-top: 0.5rem;
  }

  /* Responsive adjustments */
  @media (max-width: 991.98px) {
    .col-lg-3 {
      margin-bottom: 2rem;
    }
  }
</style>
@endsection

@section('js_after')
<script>
  Dashmix.onLoad(() => {
    // Auto-submit form when sort option changes
    document.querySelector('select[name="sort"]').addEventListener('change', function() {
      this.form.submit();
    });
  });
</script>
@endsection
