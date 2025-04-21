@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create User</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        @include('shared.error')

        <!-- User Form -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">User Information</h3>
                <div class="block-options">
                    <a href="{{ route('admin.users.index') }}" class="btn-block-option">
                        <i class="fa fa-arrow-left"></i> Back to Users
                    </a>
                </div>
            </div>
            <div class="block-content">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="row push">
                        <div class="col-lg-8 col-xl-6">
                            <div class="mb-4">
                                <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="User's full name" required>
                                <div class="form-text">Enter the user's full name as it will appear in the system.</div>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="user@example.com" required>
                                <div class="form-text">This email will be used for login and notifications.</div>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimum 8 characters" required>
                                    <button type="button" class="btn btn-alt-primary" onclick="togglePassword('password')">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Password must be at least 8 characters long.</div>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Type password again" required>
                                    <button type="button" class="btn btn-alt-primary" onclick="togglePassword('password_confirmation')">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Re-enter the password to confirm.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="role">User Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <div class="form-text">
                                    <strong>Admin:</strong> Full system access | <strong>User:</strong> Limited access
                                </div>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-success">
                                    <i class="fa fa-fw fa-plus me-1"></i> Create User
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-alt-secondary">
                                    <i class="fa fa-fw fa-times me-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Form -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle icon
        const icon = event.currentTarget.querySelector('i');
        if (type === 'text') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
