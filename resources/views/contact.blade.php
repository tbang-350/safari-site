@extends('layouts.simple')

@section('content')
  <!-- Hero -->
  <div class="hero bg-image" style="background-image: url('/media/safari/contact.jpg'); background-size: cover; background-position: center;">
    <div class="hero-inner">
      <div class="content content-full text-center pt-7 pb-5">
        <h1 class="fw-bold text-white mb-2 move-up-on-hover" style="font-size: 3.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
          Contact Us
        </h1>
        <h2 class="h3 fw-medium text-white-75 mb-5 move-up-on-hover" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
          We'd love to hear from you
        </h2>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content content-full">
    <div class="py-5">
      <div class="row">
        <div class="col-md-6">
          <!-- Contact Form -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Send Us a Message</h3>
            </div>
            <div class="block-content">
              @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  <p class="mb-0">{{ session('success') }}</p>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <p class="mb-0">{{ session('error') }}</p>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label class="form-label" for="contact-name">Full Name</label>
                      <input type="text" class="form-control" id="contact-name" name="name" value="{{ old('name') }}" placeholder="Enter your name.." required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label class="form-label" for="contact-email">Email</label>
                      <input type="email" class="form-control" id="contact-email" name="email" value="{{ old('email') }}" placeholder="Enter your email.." required>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label class="form-label" for="contact-subject">Subject</label>
                  <input type="text" class="form-control" id="contact-subject" name="subject" value="{{ old('subject') }}" placeholder="Enter message subject.." required>
                </div>
                <div class="mb-4">
                  <label class="form-label" for="contact-message">Message</label>
                  <textarea class="form-control" id="contact-message" name="message" rows="6" placeholder="Enter your message.." required>{{ old('message') }}</textarea>
                </div>
                <div class="row mb-4">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-paper-plane opacity-50 me-1"></i> Send Message
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END Contact Form -->
        </div>
        <div class="col-md-6">
          <!-- Company Information -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Contact Information</h3>
            </div>
            <div class="block-content">
              <div class="row mb-5">
                <div class="col-md-4 text-center">
                  <div class="item item-circle bg-primary-light mx-auto mb-3">
                    <i class="fa fa-2x fa-map-marker-alt text-primary"></i>
                  </div>
                  <h4 class="mb-2">Address</h4>
                  <p class="text-muted mb-0">
                    123 Safari Street<br>
                    Arusha, Tanzania
                  </p>
                </div>
                <div class="col-md-4 text-center">
                  <div class="item item-circle bg-primary-light mx-auto mb-3">
                    <i class="fa fa-2x fa-envelope text-primary"></i>
                  </div>
                  <h4 class="mb-2">Email</h4>
                  <p class="text-muted mb-0">
                    info@tanzaniasafari.com<br>
                    bookings@tanzaniasafari.com
                  </p>
                </div>
                <div class="col-md-4 text-center">
                  <div class="item item-circle bg-primary-light mx-auto mb-3">
                    <i class="fa fa-2x fa-phone-alt text-primary"></i>
                  </div>
                  <h4 class="mb-2">Phone</h4>
                  <p class="text-muted mb-0">
                    +255 123 456 789<br>
                    +255 987 654 321
                  </p>
                </div>
              </div>

              <!-- Map -->
              <div class="mb-5">
                <h4 class="mb-3">Find Us</h4>
                <div class="ratio ratio-16x9">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252843.59459046587!2d36.50931724553244!3d-3.386936824905039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x183d4b37311afa29%3A0x797deb5e170bea89!2sArusha%2C%20Tanzania!5e0!3m2!1sen!2sus!4v1635347835747!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
              </div>

              <!-- Working Hours -->
              <div class="mb-5">
                <h4 class="mb-3">Business Hours</h4>
                <div class="table-responsive">
                  <table class="table table-borderless table-vcenter">
                    <tbody>
                      <tr>
                        <td class="fw-semibold">Monday - Friday</td>
                        <td>8:00 AM - 5:00 PM</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Saturday</td>
                        <td>9:00 AM - 3:00 PM</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Sunday</td>
                        <td>Closed</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Public Holidays</td>
                        <td>Closed</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Social Media -->
              <div>
                <h4 class="mb-3">Connect With Us</h4>
                <div class="d-flex">
                  <a class="btn btn-lg btn-alt-primary me-2" href="javascript:void(0)" data-bs-toggle="tooltip" title="Facebook">
                    <i class="fab fa-fw fa-facebook-f"></i>
                  </a>
                  <a class="btn btn-lg btn-alt-primary me-2" href="javascript:void(0)" data-bs-toggle="tooltip" title="Twitter">
                    <i class="fab fa-fw fa-twitter"></i>
                  </a>
                  <a class="btn btn-lg btn-alt-primary me-2" href="javascript:void(0)" data-bs-toggle="tooltip" title="Instagram">
                    <i class="fab fa-fw fa-instagram"></i>
                  </a>
                  <a class="btn btn-lg btn-alt-primary me-2" href="javascript:void(0)" data-bs-toggle="tooltip" title="TripAdvisor">
                    <i class="fab fa-fw fa-tripadvisor"></i>
                  </a>
                  <a class="btn btn-lg btn-alt-primary" href="javascript:void(0)" data-bs-toggle="tooltip" title="YouTube">
                    <i class="fab fa-fw fa-youtube"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- END Company Information -->
        </div>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
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

  /* Safari-themed color adjustments */
  .text-primary {
    color: #e67e22 !important;
  }

  .bg-primary-light {
    background-color: rgba(230, 126, 34, 0.1) !important;
  }

  .btn-primary {
    background-color: #e67e22;
    border-color: #d35400;
  }

  .btn-primary:hover {
    background-color: #d35400;
    border-color: #c0392b;
  }
</style>
@endsection
