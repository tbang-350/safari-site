@extends('layouts.simple')

@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('https://placehold.co/1920x400/3498db/ffffff?text=Tanzania+Safari+Adventures');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center py-6">
            <div class="mb-3">
                <img class="img-avatar img-avatar-thumb" src="https://placehold.co/160x160/e67e22/ffffff?text=TSA" alt="Tanzania Safari Adventures Logo">
            </div>
            <h1 class="h2 text-white mb-0">Tanzania Safari Adventures</h1>
            <h2 class="h4 fw-normal text-white-75">Admin Login</h2>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-4">
            <!-- Sign In Block -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Sign In</h3>
                    <div class="block-options">
                        <img src="https://placehold.co/40x40/2c3e50/ffffff?text=TSA" alt="Logo" class="img-fluid">
                    </div>
                </div>
                <div class="block-content">
                    <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-user-circle"></i>
                                    </span>
                                    <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="mt-2">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted fs-sm">Forgot Password?</a>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <button type="submit" class="btn btn-hero btn-primary">
                                    <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Sign In Block -->
        </div>
    </div>

    <!-- Safari-themed Footer -->
    <div class="fs-sm text-center text-muted py-3">
        <div class="mb-2">
            <div class="d-inline-block px-2">
                <img src="https://placehold.co/30x30/e67e22/ffffff?text=TSA" alt="Icon" class="img-fluid rounded-circle">
            </div>
            <div class="d-inline-block px-2">
                <img src="https://placehold.co/30x30/27ae60/ffffff?text=TSA" alt="Icon" class="img-fluid rounded-circle">
            </div>
            <div class="d-inline-block px-2">
                <img src="https://placehold.co/30x30/3498db/ffffff?text=TSA" alt="Icon" class="img-fluid rounded-circle">
            </div>
        </div>
        <strong>Tanzania Safari Adventures</strong> &copy; {{ date('Y') }}
    </div>
</div>
<!-- END Page Content -->

@endsection

@section('css_after')
<style>
  /* Safari-themed custom styles */
  .bg-primary-dark-op {
    background-color: rgba(44, 62, 80, 0.8);
  }

  .text-primary {
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

  .bg-primary-dark {
    background-color: #2c3e50 !important;
  }

  .img-avatar {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    border: 3px solid #e67e22;
  }

  .block-header {
    border-bottom: 2px solid #e67e22;
  }

  .form-control:focus {
    border-color: #e67e22;
  }

  .input-group-text {
    background-color: #e67e22;
    color: white;
    border-color: #d35400;
  }
</style>
@endsection
