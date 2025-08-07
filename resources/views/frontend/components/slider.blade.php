<!-- Carousel Start -->
<div class="header-carousel owl-carousel">
    @foreach ($sliders as $key => $slider)
        <div class="header-carousel-item bg-primary">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-4 align-items-center {{ $key % 2 == 0 ? '' : 'gy-4 gy-lg-0 gx-0 gx-lg-5' }}">
                        @if ($key % 2 == 0)
                            <!-- Left Text, Right Image -->
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class="text-white text-uppercase fw-bold mb-4">{{ $slider->slider_title_one }}
                                    </h4>
                                    <h1 class="display-1 text-white mb-4">{{ $slider->slider_title_two }}</h1>
                                    <p class="mb-5 fs-5">{{ $slider->description }}</p>
                                </div>
                            </div>
                            <div class="col-lg-5 animated fadeInRight">
                                <div class="calrousel-img" style="object-fit: cover;">
                                    <img src="{{ asset('uploads/sliders/' . $slider->slider_image) }}"
                                        class="img-fluid w-100" alt="Slider Image">
                                </div>
                            </div>
                        @else
                            <!-- Left Image, Right Text -->
                            <div class="col-lg-5 animated fadeInLeft">
                                <div class="calrousel-img">
                                    <img src="{{ asset('uploads/sliders/' . $slider->slider_image) }}"
                                        class="img-fluid w-100" alt="Slider Image">
                                </div>
                            </div>
                            <div class="col-lg-7 animated fadeInRight">
                                <div class="text-sm-center text-md-end">
                                    <h4 class="text-white text-uppercase fw-bold mb-4">{{ $slider->slider_title_one }}
                                    </h4>
                                    <h1 class="display-1 text-white mb-4">{{ $slider->slider_title_two }}</h1>
                                    <p class="mb-5 fs-5">{{ $slider->description }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- Carousel End -->
