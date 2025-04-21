@extends('layouts.simple')

@section('content')
<!-- Hero -->
<div class="bg-primary-dark">
    <div class="content content-full text-center">
        <div class="my-3">
            <img class="img-avatar img-avatar-thumb" src="https://via.placeholder.com/160x160" alt="Tanzania Safari Adventures Logo">
        </div>
        <h1 class="h2 text-white mb-0">Tanzania Safari Adventures</h1>
        <h2 class="h4 fw-normal text-white-75">Admin Login</h2>
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
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted fs-sm">Forgot Password?</a>
                                    @endif
                        </div>
                                <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" required>
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
</div>
<!-- END Page Content -->

@endsection

@section('css_after')
<style>
  /* Safari-themed custom styles */
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
</style>
@endsection
