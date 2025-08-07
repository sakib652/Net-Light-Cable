@php $setting = \App\Helpers\SettingsHelper::getSetting(); @endphp

<!-- Footer Start -->
<div class="container-fluid footer py-6 wow fadeIn" data-wow-delay="0.2s">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-9">
                <div class="mb-5">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-6 col-xl-5">
                            <div class="footer-item">
                                <a href="index.html" class="p-0">
                                    <h3 class="text-white">{{ $setting->company_name }}</h3>
                                </a>
                                <p class="text-white mb-4">{{ $setting->company_about }}</p>
                                <div class="footer-btn d-flex">
                                    <a class="btn btn-md-square rounded-circle me-3"
                                        href="{{ $setting->facebook_url }}"><i class="bi bi-facebook"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-3"
                                        href="{{ $setting->twitter_url }}"><i class="bi bi-twitter-x"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-3"
                                        href="{{ $setting->instagram_url }}"><i class="bi bi-instagram"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-0"
                                        href="{{ $setting->linkedin_url }}"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="footer-item">
                                <h4 class="text-white mb-4">Useful Links</h4>
                                <a href="{{ route('home') }}"><i class="fas fa-angle-right me-2"></i> Home</a>
                                <a href="{{ route('front.about.view') }}"><i class="fas fa-angle-right me-2"></i>
                                    About</a>
                                <a href="{{ route('front.dealer.view') }}"><i class="fas fa-angle-right me-2"></i>
                                    Dealers</a>
                                <a href="{{ route('front.team.view') }}"><i class="fas fa-angle-right me-2"></i>
                                    Management</a>
                                {{-- <a href="{{ route('front.facilities.view') }}"><i class="fas fa-angle-right me-2"></i>
                                    Facilities</a> --}}
                                <a href="{{ route('front.contact.create') }}"><i class="fas fa-angle-right me-2"></i>
                                    Contact</a>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="footer_map text-white">
                                <h4 class="mb-4 text-white">We are On Map</h4>
                                <div class="map-container">
                                    <iframe src="{{ $setting->google_map }}" loading="lazy" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Contact Info</h4>

                    <div class="d-flex mb-3">
                        <div class="btn-md-square bg-success text-white rounded me-3">
                            <i class="fas fa-map-marker-alt fa-lg p-2"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-1">Address</h6>
                            <small class="text-white">{{ $setting->company_address }}</small>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="btn-md-square bg-success text-white rounded me-3">
                            <i class="fas fa-envelope fa-lg p-2"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-1">Mail Us</h6>
                            <small class="text-white">{{ $setting->company_email }}</small>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="btn-md-square bg-success text-white rounded me-3">
                            <i class="fa fa-phone-alt fa-lg p-2"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-1">Telephone</h6>
                            <small class="text-white">{{ $setting->company_phone }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright py-3">
    <div class="container">
        <div class="row g-4 align-items-center justify-content-between">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-body">
                    <a href="{{ route('home') }}" class="border-bottom text-white">
                        <i class="fas fa-copyright text-light me-2"></i>
                        {{ now()->year }} {{ $setting->company_name }}
                    </a>, {{ $setting->copyright }}
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end text-body">
                Design & Developed by
                <a href="http://linktechbd.com/" class="text-white">Link-Up Technology Ltd.</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
