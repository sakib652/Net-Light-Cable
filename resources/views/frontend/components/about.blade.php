<!-- About Start -->
@php
    use Illuminate\Support\Str;
@endphp


<div class="container-fluid bg-light about pt-5">
    <div class="container pb-5">
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-item-content bg-white rounded p-5 h-100">
                    <h4 class="text-primary">About Our Company</h4>
                    <h1 class="display-4 mb-4">{{ $aboutUs->title }}</h1>
                    <p style="text-align: justify;">{{ Str::limit($aboutUs->description, 800, '...') }}</p>
                    <a class="btn btn-primary btn-sm rounded-pill py-2 px-3"
                        href="{{ route('front.about.view') }}">{{ $aboutUs->button_text }}</a>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="bg-white rounded p-5 h-100">
                    <div class="row g-4 justify-content-center">
                        <div class="col-12">
                            <div class="rounded bg-light">
                                @if ($aboutUs && $aboutUs->image_path)
                                    <img src="{{ asset('uploads/about/' . $aboutUs->image_path) }}"
                                        class="img-fluid rounded w-100" alt="{{ $aboutUs->title }}">
                                @else
                                    <img src="{{ asset('frontend/assets/img/about-1.png') }}"
                                        class="img-fluid rounded w-100" alt="About Us Default">
                                @endif
                            </div>
                        </div>
                        @foreach ($counters as $counter)
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $counter->value }}</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">{{ $counter->title }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
