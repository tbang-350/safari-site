@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">System Settings</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <form action="#" method="POST">
            @csrf

            <!-- General Settings -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">General Settings</h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="site_name">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" value="Tanzania Safari Adventures">
                                <div class="form-text">The name of your website as it appears to users</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="site_tagline">Site Tagline</label>
                                <input type="text" class="form-control" id="site_tagline" name="site_tagline" value="Explore the Beauty of Tanzania">
                                <div class="form-text">A short description of your website</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="contact_email">Contact Email</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email" value="info@tanzaniasafari.com">
                                <div class="form-text">Main email address for receiving inquiries</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="+255 123 456 789">
                                <div class="form-text">Main contact phone number</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END General Settings -->

            <!-- Social Media Settings -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Social Media</h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="facebook_url">
                                    <i class="fab fa-facebook fa-fw"></i> Facebook URL
                                </label>
                                <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="https://facebook.com/tanzaniasafari">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="twitter_url">
                                    <i class="fab fa-twitter fa-fw"></i> Twitter URL
                                </label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="https://twitter.com/tanzaniasafari">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="instagram_url">
                                    <i class="fab fa-instagram fa-fw"></i> Instagram URL
                                </label>
                                <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="https://instagram.com/tanzaniasafari">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="youtube_url">
                                    <i class="fab fa-youtube fa-fw"></i> YouTube Channel
                                </label>
                                <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="https://youtube.com/tanzaniasafari">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Social Media Settings -->

            <!-- Email Settings -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Email Configuration</h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="mail_driver">Mail Driver</label>
                                <select class="form-select" id="mail_driver" name="mail_driver">
                                    <option value="smtp" selected>SMTP</option>
                                    <option value="sendmail">Sendmail</option>
                                    <option value="mailgun">Mailgun</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="mail_host">SMTP Host</label>
                                <input type="text" class="form-control" id="mail_host" name="mail_host" value="smtp.mailtrap.io">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="mail_port">SMTP Port</label>
                                <input type="text" class="form-control" id="mail_port" name="mail_port" value="2525">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="mail_username">SMTP Username</label>
                                <input type="text" class="form-control" id="mail_username" name="mail_username" value="username">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="mail_password">SMTP Password</label>
                                <input type="password" class="form-control" id="mail_password" name="mail_password" value="password">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="mail_encryption">Encryption</label>
                                <select class="form-select" id="mail_encryption" name="mail_encryption">
                                    <option value="null">None</option>
                                    <option value="tls" selected>TLS</option>
                                    <option value="ssl">SSL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Email Settings -->

            <!-- Submit -->
            <div class="row push">
                <div class="col-lg-8 col-xl-5">
                    <div class="mb-4">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-fw fa-save me-1"></i> Save Settings
                        </button>
                    </div>
                </div>
            </div>
            <!-- END Submit -->
        </form>
    </div>
    <!-- END Page Content -->
@endsection
