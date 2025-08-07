<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <!-- Categories -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::routeIs('categories.*') ? 'show' : '' }}" id="collapseCategories"
                    aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('categories.create') ? 'active' : '' }}"
                                href="{{ route('categories.create') }}">Create Category</a>
                        @endif
                        <a class="nav-link {{ Request::routeIs('categories.index') ? 'active' : '' }}"
                            href="{{ route('categories.index') }}">Category List</a>
                    </nav>
                </div>

                <!-- Areas -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAreas"
                    aria-expanded="false" aria-controls="collapseAreas">
                    <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                    Areas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::routeIs('areas.*') ? 'show' : '' }}" id="collapseAreas"
                    aria-labelledby="headingAreas" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('areas.create') ? 'active' : '' }}"
                                href="{{ route('areas.create') }}">Create Area</a>
                        @endif
                        <a class="nav-link {{ Request::routeIs('areas.index') ? 'active' : '' }}"
                            href="{{ route('areas.index') }}">Area List</a>
                    </nav>
                </div>

                <!-- Web Content -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseWebContentMenu"
                    aria-expanded="{{ Request::is('sliders*') || Request::is('client*') || Request::is('dealer*') || Request::is('gallery*') || Request::is('products*') || Request::is('certificate*') || Request::is('management*') || Request::routeIs('counters.create', 'about-us.index', 'message.index', 'contact-us.index') ? 'true' : 'false' }}"
                    aria-controls="collapseWebContentMenu">
                    <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                    Web Content
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('sliders*') || Request::is('client*') || Request::is('dealer*') || Request::is('gallery*') || Request::is('products*') || Request::is('certificate*') || Request::is('management*') || Request::routeIs('counters.create', 'about-us.index', 'message.index', 'contact-us.index') ? 'show' : '' }}"
                    id="collapseWebContentMenu" aria-labelledby="headingWebContentMenu"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">

                        <!-- Sliders -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseSlidersMenu"
                            aria-expanded="{{ Request::is('sliders*') ? 'true' : 'false' }}"
                            aria-controls="collapseSlidersMenu">
                            Sliders
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('sliders*') ? 'show' : '' }}" id="collapseSlidersMenu"
                            aria-labelledby="headingSlidersMenu" data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('sliders.create') ? 'active' : '' }}"
                                        href="{{ route('sliders.create') }}">Create Slider</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('sliders.index') ? 'active' : '' }}"
                                    href="{{ route('sliders.index') }}">Slider Lists</a>
                            </nav>
                        </div>

                        <!-- Brands -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseClientsMenu"
                            aria-expanded="{{ Request::is('client*') ? 'true' : 'false' }}"
                            aria-controls="collapseClientsMenu">
                            Brands
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('client*') ? 'show' : '' }}" id="collapseClientsMenu"
                            aria-labelledby="headingClientsMenu" data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('client.create') ? 'active' : '' }}"
                                        href="{{ route('client.create') }}">Create Brand</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('client.index') ? 'active' : '' }}"
                                    href="{{ route('client.index') }}">Brand List</a>
                            </nav>
                        </div>

                        <!-- Dealers -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseDealersMenu"
                            aria-expanded="{{ Request::is('dealer*') ? 'true' : 'false' }}"
                            aria-controls="collapseDealersMenu">
                            Dealers
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('dealer*') ? 'show' : '' }}" id="collapseDealersMenu"
                            aria-labelledby="headingDealersMenu" data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('dealer.create') ? 'active' : '' }}"
                                        href="{{ route('dealer.create') }}">Create Dealer</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('dealer.index') ? 'active' : '' }}"
                                    href="{{ route('dealer.index') }}">Dealer List</a>
                            </nav>
                        </div>

                        <!-- Products -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseProductsMenu"
                            aria-expanded="{{ Request::is('products*') ? 'true' : 'false' }}"
                            aria-controls="collapseProductsMenu">
                            Products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('products*') ? 'show' : '' }}" id="collapseProductsMenu"
                            aria-labelledby="headingProductsMenu" data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('products.create') ? 'active' : '' }}"
                                        href="{{ route('products.create') }}">Create Product</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('products.index') ? 'active' : '' }}"
                                    href="{{ route('products.index') }}">Product Lists</a>
                            </nav>
                        </div>

                        <!-- Gallery -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseGalleryMenu"
                            aria-expanded="{{ Request::is('gallery*') ? 'true' : 'false' }}"
                            aria-controls="collapseGalleryMenu">
                            Gallery
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('gallery*') ? 'show' : '' }}" id="collapseGalleryMenu"
                            aria-labelledby="headingGalleryMenu" data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('gallery.create') ? 'active' : '' }}"
                                        href="{{ route('gallery.create') }}">Create Gallery</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('gallery.index') ? 'active' : '' }}"
                                    href="{{ route('gallery.index') }}">Gallery Lists</a>
                            </nav>
                        </div>

                        <!-- Certificates -->
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseCertificatesMenu"
                            aria-expanded="{{ Request::is('certificate*') ? 'true' : 'false' }}"
                            aria-controls="collapseCertificatesMenu">
                            Certificates
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('certificate*') ? 'show' : '' }}"
                            id="collapseCertificatesMenu" aria-labelledby="headingCertificatesMenu"
                            data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('certificate.create') ? 'active' : '' }}"
                                        href="{{ route('certificate.create') }}">Create Certificate</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('certificate.index') ? 'active' : '' }}"
                                    href="{{ route('certificate.index') }}">Certificate Lists</a>
                            </nav>
                        </div> --}}

                        <!-- Team -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseManagementMenu"
                            aria-expanded="{{ Request::is('management*') ? 'true' : 'false' }}"
                            aria-controls="collapseManagementMenu">
                            Team
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('management*') ? 'show' : '' }}"
                            id="collapseManagementMenu" aria-labelledby="headingManagementMenu"
                            data-bs-parent="#collapseWebContentMenu">
                            <nav class="sb-sidenav-menu-nested nav">
                                @if (auth()->user()->type == 'admin')
                                    <a class="nav-link {{ Request::routeIs('management.create') ? 'active' : '' }}"
                                        href="{{ route('management.create') }}">Create Team</a>
                                @endif
                                <a class="nav-link {{ Request::routeIs('management.index') ? 'active' : '' }}"
                                    href="{{ route('management.index') }}">Team List</a>
                            </nav>
                        </div>

                        <!-- Counter -->
                        @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('counters.create') ? 'active' : '' }}"
                                href="{{ route('counters.create') }}">
                                Create Counter
                            </a>
                        @endif

                        <!-- About Us -->
                        @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('about-us.index') ? 'active' : '' }}"
                                href="{{ route('about-us.index') }}">About Us</a>
                        @endif

                        <!-- Chairman Message -->
                        {{-- @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('message.index') ? 'active' : '' }}"
                                href="{{ route('message.index') }}">Chairman's Message</a>
                        @endif --}}

                        <!-- Contact Us -->
                        @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('contact-us.index') ? 'active' : '' }}"
                                href="{{ route('contact-us.index') }}">Contact Messages</a>
                        @endif

                    </nav>
                </div>
                <!-- Users -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayouts" aria-expanded="{{ Request::is('users*') ? 'true' : 'false' }}"
                    aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('users*') ? 'show' : '' }}" id="collapseLayouts"
                    aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if (auth()->user()->type == 'admin')
                            <a class="nav-link {{ Request::routeIs('users.create') ? 'active' : '' }}"
                                href="{{ route('users.create') }}">Create User</a>
                        @endif
                        <a class="nav-link {{ Request::routeIs('users.index') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">User List</a>
                    </nav>
                </div>

                <!-- Settings -->
                @if (auth()->user()->type == 'admin')
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseWebContent"
                        aria-expanded="{{ Request::routeIs('setting') ? 'true' : 'false' }}"
                        aria-controls="collapseWebContent">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Settings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ Request::routeIs('setting') ? 'show' : '' }}" id="collapseWebContent"
                        aria-labelledby="headingWebContent" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Request::routeIs('setting') ? 'active' : '' }}"
                                href="{{ route('setting') }}">Company Settings</a>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>
