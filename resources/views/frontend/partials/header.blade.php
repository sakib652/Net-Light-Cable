@php
    $setting = \App\Helpers\SettingsHelper::getSetting();
    $clients = \App\Helpers\ClientHelper::client();
@endphp

<!-- Topbar Start -->
<div class="container-fluid topbar px-0 px-lg-4 bg-light py-2 d-none d-lg-block">
    <div class="container">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <div class="pe-3">
                        <a href="mailto:example@gmail.com" class="text-muted small"><i
                                class="fas fa-envelope text-success me-2"></i>{{ $setting->company_email }}</a>
                    </div>
                    <div class="border-start border-success ps-3">
                        <a href="#" class="text-muted small"><i
                                class="fa fa-phone text-success me-2"></i>{{ $setting->hotline }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex justify-content-end">
                    <div class="d-flex pe-3">
                        <a class="btn p-0 text-success me-3" href="{{ $setting->facebook_url }}"><i
                                class="bi bi-facebook"></i></a>
                        <a class="btn p-0 text-success me-3" href="{{ $setting->twitter_url }}"><i
                                class="bi bi-twitter-x"></i></a>
                        <a class="btn p-0 text-success me-3" href="{{ $setting->instagram_url }}"><i
                                class="bi bi-instagram"></i></a>
                        <a class="btn p-0 text-success me-0" href="{{ $setting->linkedin_url }}"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{ route('home') }}" class="navbar-brand p-0">
                <img src="{{ asset('uploads/logo_and_icon/' . ($setting->company_logo ?? 'no-images/no-image.png')) }}"
                    alt="Logo">
                <span class="ms-2 fw-bold">{{ $setting->company_name ?? 'Company Name' }}</span>
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-0 ms-lg-auto">

                    <a href="{{ route('home') }}"
                        class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle 
                            {{ request()->routeIs('front.about.view') || (request()->routeIs('front.team.view') && request('type') !== null) ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            About
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('front.about.view') }}"
                                class="dropdown-item {{ request()->routeIs('front.about.view') ? 'active' : '' }}">
                                Company Information
                            </a>
                            <a href="{{ route('front.team.view', ['type' => 'management']) }}"
                                class="dropdown-item {{ request()->routeIs('front.team.view') && request('type') === 'management' ? 'active' : '' }}">
                                Management
                            </a>
                            <a href="{{ route('front.team.view', ['type' => 'employee']) }}"
                                class="dropdown-item {{ request()->routeIs('front.team.view') && request('type') === 'employee' ? 'active' : '' }}">
                                Team
                            </a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ request()->routeIs('product.productList') || request()->routeIs('client.show') ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            Products
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('product.productList') }}"
                                class="dropdown-item {{ request()->routeIs('product.productList') ? 'active' : '' }}">All
                                Products</a>
                            @foreach ($clients as $client)
                                <a href="{{ route('client.show', $client->slug) }}"
                                    class="dropdown-item {{ request()->routeIs('client.show') && request()->route('slug') === $client->slug ? 'active' : '' }}">
                                    {{ $client->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('front.dealer.view') }}"
                        class="nav-item nav-link {{ request()->routeIs('front.dealer.view') ? 'active' : '' }}">Dealers</a>

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ request()->routeIs('gallery.photo') || request()->routeIs('gallery.video') ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            Gallery
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('gallery.photo') }}"
                                class="dropdown-item {{ request()->routeIs('gallery.photo') ? 'active' : '' }}">Photo
                                Gallery</a>
                            {{-- <a href="{{ route('gallery.video') }}"
                                class="dropdown-item {{ request()->routeIs('gallery.video') ? 'active' : '' }}">Video
                                Gallery</a> --}}
                        </div>
                    </div>

                    {{-- <a href="{{ route('front.certificate.view') }}"
                        class="nav-item nav-link {{ request()->routeIs('front.certificate.view') ? 'active' : '' }}">Certificates</a> --}}

                    {{-- <a href="{{ route('front.team.view') }}"
                        class="nav-item nav-link {{ request()->routeIs('front.team.view') ? 'active' : '' }}">Management</a> --}}

                    {{-- <a href="{{ route('front.facilities.view') }}"
                        class="nav-item nav-link {{ request()->routeIs('front.facilities.view') ? 'active' : '' }}">Facilities</a> --}}

                    <a href="{{ route('front.contact.create') }}"
                        class="nav-item nav-link {{ request()->routeIs('front.contact.create') ? 'active' : '' }}">Contact</a>

                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Navbar & Hero End -->
