@extends('layouts.simple')

@section('content')
  <!-- Hero -->
  <div class="hero overflow-hidden bg-image" style="background-image: url('/media/safari/hero.jpg'); background-size: cover; background-position: center; min-height: 90vh;">
    <div class="hero-inner">
      <div class="content content-full text-center pt-7 pb-5">
        <h1 class="fw-bold text-white mb-2 move-up-on-hover" style="font-size: 3.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
          Tanzania <span class="text-warning">Safari</span> Adventures
        </h1>
        <h2 class="h3 fw-medium text-white-75 mb-5 move-up-on-hover" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
          Experience the magic of African wildlife and breathtaking landscapes
        </h2>
        <div class="d-flex justify-content-center gap-3">
          <a class="btn btn-hero btn-primary px-4 py-3 d-inline-block" href="#tours">
            <i class="fa fa-fw fa-compass me-1"></i> Explore Tours
          </a>
          <a class="btn btn-hero btn-alt-success px-4 py-3 d-inline-block" href="#booking">
            <i class="fa fa-fw fa-calendar-alt me-1"></i> Book Now
        </a>
        </div>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Features Section -->
  <div id="features" class="content content-full">
    <div class="py-5 text-center">
      <h2 class="h1 mb-4">
        Why Choose <span class="text-primary">Tanzania Safari Adventures</span>
      </h2>
      <p class="fs-lg text-muted mb-5">
        Discover why thousands of travelers choose us for their African safari experience
      </p>
      <div class="row g-4">
        <div class="col-md-4 py-3">
          <div class="block block-rounded block-link-shadow h-100">
            <div class="block-content block-content-full text-center bg-body-light">
              <div class="item item-circle bg-warning-light mx-auto mb-3">
                <i class="fa fa-2x fa-user-tie text-warning"></i>
              </div>
            </div>
            <div class="block-content block-content-full text-center">
              <h4 class="mb-2">Expert Local Guides</h4>
              <p class="fs-sm text-muted mb-0">
                Our guides are born and raised in Tanzania with decades of combined experience
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-3">
          <div class="block block-rounded block-link-shadow h-100">
            <div class="block-content block-content-full text-center bg-body-light">
              <div class="item item-circle bg-success-light mx-auto mb-3">
                <i class="fa fa-2x fa-map-marked-alt text-success"></i>
              </div>
            </div>
            <div class="block-content block-content-full text-center">
              <h4 class="mb-2">Custom Safari Tours</h4>
              <p class="fs-sm text-muted mb-0">
                Tailor-made experiences from luxury safaris to budget-friendly adventures
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-3">
          <div class="block block-rounded block-link-shadow h-100">
            <div class="block-content block-content-full text-center bg-body-light">
              <div class="item item-circle bg-info-light mx-auto mb-3">
                <i class="fa fa-2x fa-camera text-info"></i>
              </div>
            </div>
            <div class="block-content block-content-full text-center">
              <h4 class="mb-2">Unforgettable Experiences</h4>
              <p class="fs-sm text-muted mb-0">
                From the Serengeti to Kilimanjaro, create memories that last a lifetime
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Features Section -->

  <!-- Popular Tours Section -->
  <div id="tours" class="bg-body-light">
    <div class="content content-full">
      <div class="py-5 text-center">
        <h2 class="h1 mb-4">
          Popular <span class="text-primary">Safari</span> Tours
        </h2>
        <p class="fs-lg text-muted mb-5">
          Explore our most sought-after adventures across Tanzania
        </p>
        <div class="row g-4">
          <div class="col-md-4 py-3">
            <div class="block block-rounded block-link-pop overflow-hidden h-100">
              <div class="block-content p-0">
                <img src="/media/safari/serengeti.jpg" class="img-fluid" alt="Serengeti Safari">
              </div>
              <div class="block-content block-content-full">
                <h4 class="mb-1">Serengeti Migration Safari</h4>
                <div class="fs-sm fw-semibold text-warning mb-2">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <span class="text-muted ms-1">(48 reviews)</span>
                </div>
                <p class="fs-sm text-muted">
                  Witness the spectacular wildebeest migration across the endless plains of the Serengeti
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="fs-lg fw-semibold text-success">From $1,995</div>
                  <a href="#booking" class="btn btn-sm btn-primary">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 py-3">
            <div class="block block-rounded block-link-pop overflow-hidden h-100">
              <div class="block-content p-0">
                <img src="/media/safari/kilimanjaro.jpg" class="img-fluid" alt="Kilimanjaro Trek">
              </div>
              <div class="block-content block-content-full">
                <h4 class="mb-1">Kilimanjaro Trek</h4>
                <div class="fs-sm fw-semibold text-warning mb-2">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-alt"></i>
                  <span class="text-muted ms-1">(36 reviews)</span>
                </div>
                <p class="fs-sm text-muted">
                  Conquer Africa's highest peak with our experienced guides and premium equipment
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="fs-lg fw-semibold text-success">From $2,450</div>
                  <a href="#booking" class="btn btn-sm btn-primary">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 py-3">
            <div class="block block-rounded block-link-pop overflow-hidden h-100">
              <div class="block-content p-0">
                <img src="/media/safari/zanzibar.jpg" class="img-fluid" alt="Zanzibar Beach">
              </div>
              <div class="block-content block-content-full">
                <h4 class="mb-1">Zanzibar Beach Getaway</h4>
                <div class="fs-sm fw-semibold text-warning mb-2">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <span class="text-muted ms-1">(62 reviews)</span>
                </div>
                <p class="fs-sm text-muted">
                  Relax on pristine white sand beaches and explore the historic Stone Town
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="fs-lg fw-semibold text-success">From $1,295</div>
                  <a href="#booking" class="btn btn-sm btn-primary">Book Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center mt-5">
          <a href="/tours" class="btn btn-lg btn-alt-primary px-4">
            View All Tours <i class="fa fa-arrow-right ms-1 opacity-50"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- END Popular Tours Section -->

  <!-- Testimonials -->
  <div id="testimonials" class="content content-full">
    <div class="py-5 text-center">
      <h2 class="h1 mb-4">
        What Our <span class="text-primary">Clients</span> Say
      </h2>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
            <div>
              <div class="block block-rounded block-bordered bg-body-light">
                <div class="block-content block-content-full">
                  <div class="py-3">
                    <div class="fs-sm fw-semibold text-warning mb-3">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <p class="fs-lg text-muted">
                      Our safari with Tanzania Safari Adventures was simply incredible. The guides were knowledgeable, accommodation was excellent, and we saw the Big Five in just three days!
                    </p>
                  </div>
                  <div class="d-flex justify-content-center align-items-center">
                    <img src="/media/safari/avatars/1.jpg" class="img-avatar img-avatar48 me-3" alt="Client Avatar">
                    <div class="text-start">
                      <p class="fw-semibold mb-0">Sarah Johnson</p>
                      <p class="fs-sm text-muted mb-0">New York, USA</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="block block-rounded block-bordered bg-body-light">
                <div class="block-content block-content-full">
                  <div class="py-3">
                    <div class="fs-sm fw-semibold text-warning mb-3">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <p class="fs-lg text-muted">
                      Climbing Kilimanjaro was the challenge of a lifetime. Thanks to our amazing guides, we all made it to the summit safely. An unforgettable achievement!
                    </p>
                  </div>
                  <div class="d-flex justify-content-center align-items-center">
                    <img src="/media/safari/avatars/2.jpg" class="img-avatar img-avatar48 me-3" alt="Client Avatar">
                    <div class="text-start">
                      <p class="fw-semibold mb-0">David Miller</p>
                      <p class="fs-sm text-muted mb-0">London, UK</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="block block-rounded block-bordered bg-body-light">
                <div class="block-content block-content-full">
                  <div class="py-3">
                    <div class="fs-sm fw-semibold text-warning mb-3">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <p class="fs-lg text-muted">
                      Our family safari exceeded all expectations. The children were mesmerized by the animals, and the accommodations were perfect for families. Highly recommend!
                    </p>
                  </div>
                  <div class="d-flex justify-content-center align-items-center">
                    <img src="/media/safari/avatars/3.jpg" class="img-avatar img-avatar48 me-3" alt="Client Avatar">
                    <div class="text-start">
                      <p class="fw-semibold mb-0">Maria Rodriguez</p>
                      <p class="fs-sm text-muted mb-0">Madrid, Spain</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  // Initialize Slick slider for testimonials when document is ready
  Dashmix.onLoad(() => {
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
  });
</script>
@endsection

@section('css_after')
<style>
  /* Safari-themed custom styles */
  .bg-image {
    position: relative;
  }

  .bg-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.4);
    z-index: 1;
  }

  .bg-image .hero-inner {
    position: relative;
    z-index: 2;
  }

  .move-up-on-hover {
    transition: transform .3s ease;
  }

  .move-up-on-hover:hover {
    transform: translateY(-5px);
  }

  .block-link-pop {
    transition: all .2s ease;
  }

  .block-link-pop:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }

  /* Safari-themed color adjustments */
  .text-warning {
    color: #e67e22 !important;
  }

  .btn-primary {
    background-color: #e67e22;
    border-color: #d35400;
  }

  .btn-primary:hover {
    background-color: #d35400;
    border-color: #c0392b;
  }

  .text-primary {
    color: #e67e22 !important;
  }

  .bg-primary-dark {
    background-color: #2c3e50 !important;
  }
</style>
@endsection
