@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Message Details</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Message</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
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

    <div class="row">
      <div class="col-md-8">
        <!-- Message Content -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Message</h3>
            <div class="block-options">
              <button type="button" class="btn btn-sm btn-alt-danger" onclick="confirmDelete({{ $contact->id }})">
                <i class="fa fa-fw fa-trash-alt me-1"></i> Delete
              </button>
            </div>
          </div>
          <div class="block-content">
            <div class="mb-4">
              <h4 class="mb-1">{{ $contact->subject }}</h4>
              <div class="fs-sm text-muted">
                From <strong>{{ $contact->name }}</strong> &lt;{{ $contact->email }}&gt;
                <span class="ms-2">{{ $contact->formatted_created_at }}</span>
              </div>
            </div>
            <hr>
            <div class="py-3">
              {{ $contact->message }}
            </div>
          </div>
        </div>
        <!-- END Message Content -->

        <!-- Reply Form -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Reply</h3>
          </div>
          <div class="block-content">
            <form action="javascript:void(0)" method="POST" onsubmit="sendReply()">
              <div class="mb-4">
                <label class="form-label" for="reply-message">Message</label>
                <textarea class="form-control" id="reply-message" name="message" rows="6" placeholder="Enter your reply.."></textarea>
              </div>
              <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-fw fa-reply me-1"></i> Send Reply
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- END Reply Form -->
      </div>
      <div class="col-md-4">
        <!-- Contact Information -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Contact Information</h3>
          </div>
          <div class="block-content">
            <div class="row mb-4">
              <div class="col-sm-12">
                <h4 class="fs-sm text-muted mb-1">Name</h4>
                <div class="fw-semibold">{{ $contact->name }}</div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-12">
                <h4 class="fs-sm text-muted mb-1">Email</h4>
                <div class="fw-semibold">
                  <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </div>
              </div>
            </div>
            <hr>
            <div class="mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="fs-sm text-muted mb-0">Status</h4>
                {!! $contact->status_badge !!}
              </div>
            </div>
            <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-4">
                <label class="form-label" for="status">Update Status</label>
                <select class="form-select" id="status" name="status">
                  <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>New</option>
                  <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                  <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                  <option value="archived" {{ $contact->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
              </div>
              <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-fw fa-check me-1"></i> Update Status
                </button>
              </div>
            </form>
            <hr>
            <div class="mb-4">
              <button type="button" class="btn btn-alt-info" onclick="window.location.href='mailto:{{ $contact->email }}'">
                <i class="fa fa-fw fa-envelope me-1"></i> Email Contact
              </button>
            </div>
          </div>
        </div>
        <!-- END Contact Information -->
      </div>
    </div>
  </div>
  <!-- END Page Content -->

  <!-- Delete Contact Confirmation Modal -->
  <div class="modal fade" id="modal-delete-contact" tabindex="-1" role="dialog" aria-labelledby="modal-delete-contact" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Delete Message</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
            <p>Are you sure you want to delete this message? This action cannot be undone.</p>
          </div>
          <div class="block-content block-content-full text-end bg-body">
            <form id="delete-form" action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js_after')
<script>
  function confirmDelete(contactId) {
    new bootstrap.Modal(document.getElementById('modal-delete-contact')).show();
  }

  function sendReply() {
    // Get the reply message
    const message = document.getElementById('reply-message').value;

    if (!message.trim()) {
      // Show an error if the message is empty
      Dashmix.helpers('jq-notify', {
        type: 'danger',
        icon: 'fa fa-exclamation-triangle me-1',
        message: 'Please enter a reply message.'
      });
      return;
    }

    // Open the user's email client with pre-filled data
    const email = '{{ $contact->email }}';
    const subject = 'Re: {{ addslashes($contact->subject) }}';
    const mailToLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(message)}`;
    window.location.href = mailToLink;

    // Update the status to replied
    document.getElementById('status').value = 'replied';

    // Show a success message
    Dashmix.helpers('jq-notify', {
      type: 'success',
      icon: 'fa fa-check me-1',
      message: 'Reply email opened in your email client.'
    });
  }
</script>
@endsection
