@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Users</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        @include('shared.success')
        @include('shared.error')

        <!-- Users List -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">All Users</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#modal-new-user">
                        <i class="fa fa-fw fa-plus me-1"></i> Add New User
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="d-none d-sm-table-cell">Role</th>
                                <th class="d-none d-md-table-cell">Created</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="d-none d-sm-table-cell">
                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="d-none d-md-table-cell">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-secondary edit-user-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-user"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email }}"
                                                data-user-role="{{ $user->role }}">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-alt-secondary delete-user-btn"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
        <!-- END Users List -->
    </div>
    <!-- END Page Content -->

    <!-- New User Modal -->
    <div class="modal fade" id="modal-new-user" tabindex="-1" role="dialog" aria-labelledby="modal-new-user" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add New User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="new-user-form" action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="">Select Role</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-primary" id="create-user-btn">
                            <i class="fa fa-fw fa-check me-1"></i> Create User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END New User Modal -->

    <!-- Edit User Modal -->
    <div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="modal-edit-user" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="edit-user-form" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit-user-id" name="user_id">
                            <div class="row">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter name" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="edit-email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="edit-email" name="email" placeholder="Enter email" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="edit-password">Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                                        <input type="password" class="form-control" id="edit-password" name="password" placeholder="Enter new password">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="edit-password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="edit-password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="edit-role">Role <span class="text-danger">*</span></label>
                                        <select class="form-select" id="edit-role" name="role" required>
                                            <option value="">Select Role</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-primary" id="update-user-btn">
                            <i class="fa fa-fw fa-check me-1"></i> Update User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Edit User Modal -->

    <!-- Delete User Confirmation Modal -->
    <div class="modal fade" id="modal-delete-user" tabindex="-1" role="dialog" aria-labelledby="modal-delete-user" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Delete User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <p>Are you sure you want to delete the user <strong id="delete-user-name"></strong>?</p>
                        <p class="text-danger">This action cannot be undone.</p>
                        <p class="text-danger" id="delete-self-warning" style="display: none;">
                            <strong>Warning:</strong> You cannot delete your own account.
                        </p>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <form id="delete-user-form" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" id="confirm-delete-user-btn">
                                <i class="fa fa-fw fa-trash me-1"></i> Delete User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Delete User Confirmation Modal -->
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create new user
        document.getElementById('create-user-btn').addEventListener('click', function() {
            document.getElementById('new-user-form').submit();
        });

        // Edit user modal
        document.querySelectorAll('.edit-user-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');
                const userEmail = this.getAttribute('data-user-email');
                const userRole = this.getAttribute('data-user-role');

                // Update the form's action URL
                document.getElementById('edit-user-form').action = `/dashboard/users/${userId}`;

                // Populate the form fields
                document.getElementById('edit-user-id').value = userId;
                document.getElementById('edit-name').value = userName;
                document.getElementById('edit-email').value = userEmail;
                document.getElementById('edit-role').value = userRole;

                // Clear password fields
                document.getElementById('edit-password').value = '';
                document.getElementById('edit-password_confirmation').value = '';
            });
        });

        // Update user
        document.getElementById('update-user-btn').addEventListener('click', function() {
            document.getElementById('edit-user-form').submit();
        });

        // Delete user modal
        document.querySelectorAll('.delete-user-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');

                document.getElementById('delete-user-name').textContent = userName;
                document.getElementById('delete-user-form').action = `/dashboard/users/${userId}`;

                // Check if trying to delete own account
                const currentUserId = {{ auth()->id() }};
                if (userId == currentUserId) {
                    document.getElementById('delete-self-warning').style.display = 'block';
                    document.getElementById('confirm-delete-user-btn').disabled = true;
                } else {
                    document.getElementById('delete-self-warning').style.display = 'none';
                    document.getElementById('confirm-delete-user-btn').disabled = false;
                }

                const modal = new bootstrap.Modal(document.getElementById('modal-delete-user'));
                modal.show();
            });
        });
    });
</script>
@endpush
