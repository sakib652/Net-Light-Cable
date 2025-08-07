@php $setting = \App\Helpers\SettingsHelper::getSetting(); @endphp

@extends('frontend.layouts.master')

@push('styles')
    <style>
        .contact_section h2 {
            display: inline-block;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            text-align: center;
        }

        .contact-card {
            border-top: 2px solid red;
            padding: 20px;
            border-radius: 6px;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.09);
            margin-bottom: 30px;
            flex: 1;
        }

        .company-title {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .social-icons a {
            /* font-size: 20px; */
            /* margin-right: 10px; */
            color: #000;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #E70002;
        }

        .map-responsive {
            overflow: hidden;
            padding-bottom: 50%;
            position: relative;
            height: 0;
        }

        .map-responsive iframe {
            left: 0;
            top: 0;
            height: 200%;
            width: 100%;
            position: absolute;
        }

        .row.align-items-stretch {
            display: flex;
            flex-wrap: wrap;
        }

        .row.align-items-stretch>div[class*='col-'] {
            display: flex;
            flex-direction: column;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item active text-danger mb-4">Contact</li>
            </ol>
        </div>
    </div>

    <section class="contact-us-wrapper" style="margin-top: 60px;">
        <div class="container pb-5">
            <div class="row align-items-stretch" data-aos="fade-up" data-aos-delay="200">

                <!-- Left: Company Info -->
                <div class="col-md-6 d-flex">
                    <div class="contact-card flex-grow-1">
                        <h2 class="company-title">{{ $setting->company_name }}</h2>
                        <p><i class="bi bi-geo-alt-fill"></i>
                            {{ $setting->company_address ?? 'Demo Address' }}
                        </p>
                        <p><i class="bi bi-telephone-fill"></i> Contact: {{ $setting->company_phone ?? '0226638613' }}</p>

                        <!-- Social Media Icons -->
                        <div class="social-icons mt-3 mb-3">
                            @if (!empty($setting->twitter_url))
                                <a href="{{ $setting->twitter_url }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            @endif
                            @if (!empty($setting->facebook_url))
                                <a href="{{ $setting->facebook_url }}" target="_blank"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if (!empty($setting->instagram_url))
                                <a href="{{ $setting->instagram_url }}" target="_blank"><i class="bi bi-instagram"></i></a>
                            @endif
                            @if (!empty($setting->linkedin_url))
                                <a href="{{ $setting->linkedin_url }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </div>

                        <!-- Google Map -->
                        <div class="map-responsive">
                            <iframe src="{{ $setting->google_map }}" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="col-md-6 d-flex">

                    <div class="contact-card flex-grow-1">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
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

                        <h4>Contact Us</h4>
                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="mb-3">
                                <label>Mobile <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="Mobile Number"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject here"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Write here" required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-danger px-4">Submit</button>
                            </div>
                        </form>

                        <!-- Message display area -->
                        <div id="form-message" class="mt-3"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm'),
                messageDiv = document.getElementById('form-message');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                messageDiv.innerHTML = '';
                const fd = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: fd
                    })
                    .then(async res => {
                        const ct = res.headers.get('content-type') || '';
                        const text = await res.text();
                        if (!ct.includes('application/json')) {
                            throw new Error('Expected JSON, got: ' + text);
                        }
                        const data = JSON.parse(text);
                        if (!res.ok) throw data;

                        messageDiv.innerHTML =
                            `<div class="alert alert-success">${data.message}</div>`;
                        form.reset();

                        setTimeout(() => {
                            messageDiv.innerHTML = '';
                        }, 5000);
                    })
                    .catch(err => {
                        console.error('ContactForm error:', err);
                        let msg = (err.errors ? Object.values(err.errors).flat().join('<br>') : err
                                .message) ||
                            'Something went wrong.';
                        messageDiv.innerHTML = `<div class="alert alert-danger">${msg}</div>`;

                        setTimeout(() => {
                            messageDiv.innerHTML = '';
                        }, 5000);
                    });
            });
        });
    </script>
@endpush
