@extends('layouts.simple')

@section('content')
  <!-- Hero Carousel -->
  <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="8000" data-bs-pause="false">
    <div class="carousel-inner">
      @foreach($heroImages as $index => $image)
      <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="8000">
        <div class="hero overflow-hidden bg-image" style="background-image: url('{{ $image->url }}'); background-size: cover; background-position: center; min-height: 90vh;">
          <div class="hero-inner">
            <div class="content content-full text-center pt-7 pb-5">
              <h1 class="fw-bold text-white mb-2 move-up-on-hover mobile-responsive-heading" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                Tanzania <span class="text-warning">Safari</span> Adventures
              </h1>
              <h2 class="h3 fw-medium text-white-75 mb-5 move-up-on-hover mobile-responsive-subheading" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
                Experience the magic of African wildlife and breathtaking landscapes
              </h2>
              <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a class="btn btn-hero btn-primary px-4 py-3 mb-2 mb-sm-0" href="#tours">
                  <i class="fa fa-fw fa-compass me-1"></i> Explore Tours
                </a>
                <a class="btn btn-hero btn-alt-success px-4 py-3" href="#booking">
                  <i class="fa fa-fw fa-calendar-alt me-1"></i> Book Now
                </a>
              </div>
              <div class="mt-3 text-white-50">
                <small>Photo by <a href="{{ $image->photographer_url }}" class="text-white-75" target="_blank">{{ $image->photographer }}</a> on <a href="https://www.pexels.com" class="text-white-75" target="_blank">Pexels</a></small>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    <div class="carousel-indicators">
      @foreach($heroImages as $index => $image)
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
      @endforeach
    </div>
  </div>
  <!-- END Hero Carousel -->

  <!-- Featured Tours -->
  <div id="tours" class="content content-full">
    <div class="text-center py-5">
      <h2 class="h3">Popular <span class="text-primary">Safari</span> Tours</h2>
      <p class="text-muted">Explore our most sought-after adventures across Tanzania</p>
    </div>

    <div id="tours-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
      <div class="carousel-inner">
        @foreach($featuredTours->chunk(3) as $index => $tourGroup)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="8000">
          <div class="row g-3">
            @foreach($tourGroup as $tour)
            <div class="col-12 col-md-6 col-lg-4">
              <a class="block block-rounded block-link-pop h-100 mb-4" href="{{ route('tours.show', $tour->slug) }}">
                <div class="block-content p-0 overflow-hidden position-relative">
                  <div class="tour-image-wrapper">
                    <img class="img-fluid tour-image" src="{{ $tour->image_source ? ($tour->image_type === 'pexels' ? $tour->image_source : asset('storage/' . $tour->image_source)) : asset('media/photos/photo21.jpg') }}" alt="{{ $tour->title }}">
                  </div>
                  <div class="ribbon ribbon-bookmark ribbon-primary">
                    <div class="ribbon-box">
                      ${{ number_format($tour->price, 2) }}
                    </div>
                  </div>
                </div>
                <div class="block-content block-content-full">
                  <h4 class="h5 mb-1">{{ $tour->title }}</h4>
                  <p class="fs-sm text-muted mb-2">{{ Str::limit($tour->description, 100) }}</p>
                  <div class="fs-sm">
                    <i class="fa fa-map-marker-alt text-primary me-1"></i> {{ $tour->location }}
                  </div>
                  <div class="py-2 d-flex flex-wrap gap-2">
                    <span class="badge bg-primary">
                      <i class="fa fa-clock me-1"></i> {{ $tour->duration }} days
                    </span>
                    <span class="badge bg-{{ $tour->difficulty_level === 'easy' ? 'success' : ($tour->difficulty_level === 'moderate' ? 'warning' : 'danger') }}">
                      <i class="fa fa-hiking me-1"></i> {{ ucfirst($tour->difficulty_level) }}
                    </span>
                    <span class="badge bg-info">
                      <i class="fa fa-users me-1"></i> Max {{ $tour->max_people }} people
                    </span>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#tours-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#tours-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="text-center mt-4">
      <a href="{{ route('tours.index') }}" class="btn btn-lg btn-alt-primary">
        View All Tours <i class="fa fa-arrow-right ms-1"></i>
      </a>
    </div>
  </div>
  <!-- END Featured Tours -->

  <!-- Features -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="py-5">
        <div class="text-center mb-5">
          <h2 class="h3">Why Choose Us</h2>
          <p class="text-muted">Experience the difference with our premium services</p>
        </div>
        <div class="row g-4">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="text-center mb-4">
              <div class="item item-circle mx-auto mb-3">
                <i class="fa fa-2x fa-map-marked-alt text-primary"></i>
              </div>
              <h4>Expert Local Guides</h4>
              <p class="text-muted mb-0">Our experienced guides know every trail and secret spot</p>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="text-center mb-4">
              <div class="item item-circle mx-auto mb-3">
                <i class="fa fa-2x fa-shield-alt text-primary"></i>
              </div>
              <h4>Safe Adventures</h4>
              <p class="text-muted mb-0">Your safety is our top priority on every expedition</p>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 mx-auto">
            <div class="text-center mb-4">
              <div class="item item-circle mx-auto mb-3">
                <i class="fa fa-2x fa-heart text-primary"></i>
              </div>
              <h4>Unforgettable Experiences</h4>
              <p class="text-muted mb-0">Create memories that will last a lifetime</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Features -->

  <!-- Testimonials -->
  <div id="testimonials" class="content content-full py-7" style="background-color: #f8f9fa;">
    <div class="container">
      <h2 class="h1 text-center mb-2">
        <span class="fw-bold">Testimonials</span>
      </h2>
      <p class="text-muted text-center mb-5 fs-lg">What our clients say about their experiences</p>

      <div class="position-relative testimonials-wrapper">
        <div id="testimonials-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="7000">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                  <div class="testimonial-card h-100">
                    <div class="quote-icon">
                      <i class="fa fa-quote-left text-light"></i>
                    </div>
                    <p class="testimonial-text">
                      Our safari with Tanzania Safari Adventures was simply incredible. The guides were knowledgeable, accommodation was excellent, and we saw the Big Five in just three days!
                    </p>
                    <div class="testimonial-rating">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="testimonial-author">
                      <img src="https://placehold.co/120x120/e67e22/ffffff?text=SJ&font=playfair+display" class="testimonial-avatar" alt="Sarah Johnson">
                      <div class="testimonial-info">
                        <h5 class="mb-0">Sarah Johnson</h5>
                        <p class="mb-0 text-muted">New York, USA</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                  <div class="testimonial-card h-100 highlighted">
                    <div class="quote-icon">
                      <i class="fa fa-quote-left text-primary"></i>
                    </div>
                    <p class="testimonial-text">
                      Climbing Kilimanjaro was the challenge of a lifetime. Thanks to our amazing guides, we all made it to the summit safely. An unforgettable achievement!
                    </p>
                    <div class="testimonial-rating">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="testimonial-author">
                      <img src="https://placehold.co/120x120/2c3e50/ffffff?text=DM&font=playfair+display" class="testimonial-avatar" alt="David Miller">
                      <div class="testimonial-info">
                        <h5 class="mb-0">David Miller</h5>
                        <p class="mb-0 text-muted">London, UK</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                  <div class="testimonial-card h-100">
                    <div class="quote-icon">
                      <i class="fa fa-quote-left text-light"></i>
                    </div>
                    <p class="testimonial-text">
                      Our family safari exceeded all expectations. The children were mesmerized by the animals, and the accommodations were perfect for families. Highly recommend!
                    </p>
                    <div class="testimonial-rating">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="testimonial-author">
                      <img src="https://placehold.co/120x120/c0392b/ffffff?text=MR&font=playfair+display" class="testimonial-avatar" alt="Maria Rodriguez">
                      <div class="testimonial-info">
                        <h5 class="mb-0">Maria Rodriguez</h5>
                        <p class="mb-0 text-muted">Madrid, Spain</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                  <div class="testimonial-card h-100">
                    <div class="quote-icon">
                      <i class="fa fa-quote-left text-light"></i>
                    </div>
                    <p class="testimonial-text">
                      The safari experience was beyond our wildest dreams. Professional guides and luxurious accommodations made this the trip of a lifetime.
                    </p>
                    <div class="testimonial-rating">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="testimonial-author">
                      <img src="https://placehold.co/120x120/3498db/ffffff?text=JB&font=playfair+display" class="testimonial-avatar" alt="John Brown">
                      <div class="testimonial-info">
                        <h5 class="mb-0">John Brown</h5>
                        <p class="mb-0 text-muted">Toronto, Canada</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                  <div class="testimonial-card h-100 highlighted">
                    <div class="quote-icon">
                      <i class="fa fa-quote-left text-primary"></i>
                    </div>
                    <p class="testimonial-text">
                      What an incredible adventure! The Serengeti was breathtaking, and our guide's knowledge of wildlife made every day exciting and educational.
                    </p>
                    <div class="testimonial-rating">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star-half-alt text-warning"></i>
                    </div>
                    <div class="testimonial-author">
                      <img src="https://placehold.co/120x120/27ae60/ffffff?text=LS&font=playfair+display" class="testimonial-avatar" alt="Laura Smith">
                      <div class="testimonial-info">
                        <h5 class="mb-0">Laura Smith</h5>
                        <p class="mb-0 text-muted">Sydney, Australia</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                  <div class="testimonial-card h-100">
                    <div class="quote-icon">
                      <i class="fa fa-quote-left text-light"></i>
                    </div>
                    <p class="testimonial-text">
                      Tanzania Safari Adventures made our honeymoon magical. Private game drives, sunset dinners, and attentive service at every turn.
                    </p>
                    <div class="testimonial-rating">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="testimonial-author">
                      <img src="https://placehold.co/120x120/8e44ad/ffffff?text=MJ&font=playfair+display" class="testimonial-avatar" alt="Michael Johnson">
                      <div class="testimonial-info">
                        <h5 class="mb-0">Michael Johnson</h5>
                        <p class="mb-0 text-muted">Berlin, Germany</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Minimal Control Buttons -->
          <button class="carousel-control-prev" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="prev">
            <span class="control-icon"><i class="fa fa-chevron-left"></i></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="next">
            <span class="control-icon"><i class="fa fa-chevron-right"></i></span>
          </button>
        </div>

        <!-- Carousel Indicators -->
        <div class="carousel-indicators-custom">
          <button type="button" data-bs-target="#testimonials-carousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
          <button type="button" data-bs-target="#testimonials-carousel" data-bs-slide-to="1"></button>
        </div>
      </div>
    </div>
  </div>
  <!-- END Testimonials -->

  <!-- Booking Section -->
  <div id="booking" class="bg-body-extra-light">
    <div class="content content-full">
      <div class="py-5">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-xl-8">
            <div class="text-center mb-5">
              <h2 class="h1 mb-4">
                Book Your <span class="text-primary">Tanzania</span> Adventure
              </h2>
              <p class="fs-lg text-muted">
                Contact us today to start planning your perfect safari experience
              </p>
            </div>
            <div class="block block-rounded">
              <div class="block-content">
                <form action="/api/booking" method="POST">
                  @csrf
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label class="form-label" for="booking-name">Full Name</label>
                        <input type="text" class="form-control" id="booking-name" name="name" placeholder="Enter your name.." required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label class="form-label" for="booking-email">Email</label>
                        <input type="email" class="form-control" id="booking-email" name="email" placeholder="Enter your email.." required>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label class="form-label" for="booking-tour">Select Tour</label>
                        <select class="form-select" id="booking-tour" name="tour">
                          <option value="">Please select</option>
                          <option value="serengeti">Serengeti Migration Safari</option>
                          <option value="kilimanjaro">Kilimanjaro Trek</option>
                          <option value="zanzibar">Zanzibar Beach Getaway</option>
                          <option value="tarangire">Tarangire & Ngorongoro Safari</option>
                          <option value="custom">Custom Safari Package</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label class="form-label" for="booking-date">Preferred Date</label>
                        <input type="date" class="form-control" id="booking-date" name="date" min="{{ date('Y-m-d') }}">
                      </div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label" for="booking-message">Special Requirements</label>
                    <textarea class="form-control" id="booking-message" name="message" rows="5" placeholder="Any special requests or questions.."></textarea>
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="booking-terms" name="terms" required>
                      <label class="form-check-label" for="booking-terms">
                        I agree to the <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-terms">terms of service</a>
                      </label>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-hero btn-primary">
                      <i class="fa fa-paper-plane opacity-50 me-1"></i> Send Booking Request
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Booking Section -->

  <!-- Contact Section -->
  <div id="contact" class="content content-full bg-primary-dark text-white">
    <div class="py-5">
      <div class="row g-0 justify-content-center">
        <div class="col-md-4 py-3 text-center">
          <div class="p-4">
            <div class="item item-circle bg-white-10 mx-auto mb-3">
              <i class="fa fa-2x fa-map-marker-alt text-white"></i>
            </div>
            <h4 class="text-white mb-2">Our Location</h4>
            <p class="text-white-75 mb-0">
              123 Safari Street<br>
              Arusha, Tanzania
            </p>
          </div>
        </div>
        <div class="col-md-4 py-3 text-center">
          <div class="p-4">
            <div class="item item-circle bg-white-10 mx-auto mb-3">
              <i class="fa fa-2x fa-envelope text-white"></i>
            </div>
            <h4 class="text-white mb-2">Email Us</h4>
            <p class="text-white-75 mb-0">
              info@tanzaniasafari.com<br>
              bookings@tanzaniasafari.com
            </p>
          </div>
        </div>
        <div class="col-md-4 py-3 text-center">
          <div class="p-4">
            <div class="item item-circle bg-white-10 mx-auto mb-3">
              <i class="fa fa-2x fa-phone-alt text-white"></i>
            </div>
            <h4 class="text-white mb-2">Call Us</h4>
            <p class="text-white-75 mb-0">
              +255 123 456 789<br>
              +255 987 654 321
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mt-4">
        <div class="col-lg-8 text-center">
          <div class="fs-5 fw-semibold text-white">Connect With Us</div>
          <div class="d-flex justify-content-center mt-2">
            <a class="btn btn-sm btn-alt-secondary me-1" href="javascript:void(0)">
              <i class="fab fa-fw fa-facebook-f"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary me-1" href="javascript:void(0)">
              <i class="fab fa-fw fa-twitter"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary me-1" href="javascript:void(0)">
              <i class="fab fa-fw fa-instagram"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary me-1" href="javascript:void(0)">
              <i class="fab fa-fw fa-tripadvisor"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
              <i class="fab fa-fw fa-youtube"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Contact Section -->

  <!-- Terms Modal -->
  <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Terms &amp; Conditions</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
            <h5>1. Booking and Payment</h5>
            <p>A deposit of 30% is required to confirm your booking. The full payment is due 30 days before your safari begins.</p>

            <h5>2. Cancellation Policy</h5>
            <p>Cancellations made 60+ days before departure: Full refund minus processing fees<br>
            30-59 days: 50% refund<br>
            Less than 30 days: No refund</p>

            <h5>3. Travel Insurance</h5>
            <p>All clients are required to have comprehensive travel insurance that covers emergency medical evacuation.</p>

            <h5>4. Responsibility</h5>
            <p>Tanzania Safari Adventures acts as an agent for accommodation, transport and activity providers and cannot be held responsible for any injury, damage, loss, delay or irregularity.</p>
          </div>
          <div class="block-content block-content-full text-end bg-body">
            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">I Agree</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Terms Modal -->

  <!-- Login Button -->
  <div class="position-fixed top-0 end-0 p-3">
    <a href="/dashboard" class="btn btn-sm btn-alt-primary">
      <i class="fa fa-fw fa-sign-in-alt me-1"></i> Admin Login
    </a>
  </div>
  <!-- END Login Button -->

@endsection

@section('js_after')
<script>
  Dashmix.onLoad(() => {
    // Initialize the carousel with custom settings
    const toursCarousel = document.getElementById('tours-carousel');
    const carousel = new bootstrap.Carousel(toursCarousel, {
      interval: 8000,  // 8 seconds between slides
      ride: 'carousel',
      pause: 'hover',  // Pause on mouse hover
      wrap: true,      // Continuous loop
      touch: true      // Allow touch swipe
    });

    // Add smooth transition
    document.querySelectorAll('.carousel-item').forEach(item => {
      item.style.transition = 'transform 1.5s ease-in-out';
    });

    // Optional: Add keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') {
        carousel.prev();
      } else if (e.key === 'ArrowRight') {
        carousel.next();
      }
    });

    // Add animation classes on scroll
    const animateOnScroll = () => {
      document.querySelectorAll('.move-up-on-hover').forEach(element => {
        if (element.getBoundingClientRect().top < window.innerHeight) {
          element.classList.add('animated', 'fadeInUp');
        }
      });
    };

    // Initial check and add scroll listener
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);

    // Smooth scroll to tours section
    document.querySelector('a[href="#tours"]').addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector('#tours').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    });
  });
</script>
@endsection

@section('css_after')
<style>
  /* General Responsive Styles */
  @media (max-width: 576px) {
    .container {
      padding-left: 15px;
      padding-right: 15px;
    }

    .btn {
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
    }

    .btn-lg {
      padding: 0.75rem 1.25rem;
      font-size: 1rem;
    }
  }

  /* Hero Section Responsive Styles */
  .mobile-responsive-heading {
    font-size: 3.5rem;
  }

  .mobile-responsive-subheading {
    font-size: 1.25rem;
  }

  @media (max-width: 768px) {
    .mobile-responsive-heading {
      font-size: 2.5rem;
    }

    .mobile-responsive-subheading {
      font-size: 1.125rem;
    }

    .hero .hero-inner {
      padding-top: 2rem;
      padding-bottom: 2rem;
    }
  }

  @media (max-width: 576px) {
    .mobile-responsive-heading {
      font-size: 2rem;
    }

    .mobile-responsive-subheading {
      font-size: 1rem;
      margin-bottom: 1.5rem !important;
    }

    .hero {
      min-height: 70vh !important;
    }
  }

  /* Tour Cards Responsive Styles */
  .tour-image-wrapper {
    position: relative;
    overflow: hidden;
    padding-top: 66.67%; /* 2:3 Aspect Ratio */
  }

  .tour-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .block-link-pop:hover .tour-image {
    transform: scale(1.05);
  }

  @media (max-width: 576px) {
    .ribbon-box {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
    }
  }

  /* Testimonial Cards Responsive Styles */
  .testimonial-card {
    position: relative;
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    padding: 2rem;
    margin-bottom: 1rem;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .testimonial-card.highlighted {
    background-color: #f8f9fa;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border-left: 3px solid #e67e22;
  }

  .testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }

  .testimonial-text {
    font-style: italic;
    margin-bottom: 1.5rem;
    color: #6c757d;
  }

  .quote-icon {
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 1.5rem;
    background-color: #fff;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }

  .testimonial-author {
    display: flex;
    align-items: center;
    margin-top: 20px;
  }

  .testimonial-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    margin-right: 15px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }

  @media (max-width: 768px) {
    .testimonial-card {
      padding: 1.5rem;
    }

    .testimonial-text {
      font-size: 0.875rem;
    }

    .testimonial-avatar {
      width: 40px;
      height: 40px;
    }
  }

  /* Animation Styles */
  .move-up-on-hover {
    transition: transform 0.3s ease;
  }

  .move-up-on-hover:hover {
    transform: translateY(-5px);
  }
</style>
@endsection
