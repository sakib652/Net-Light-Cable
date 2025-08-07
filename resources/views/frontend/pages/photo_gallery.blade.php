@extends('frontend.layouts.master')

@push('styles')
    <style>
        .gallery_image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 1px solid black !important;
        }

        .gallery_image {
            overflow: hidden;
            position: relative;
        }

        .gallery_image:hover img {
            0 transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">Photo Gallery</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item mb-4"><a href="#">Gallery</a></li>
                <li class="breadcrumb-item active text-danger mb-4">Photo Gallery</li>
            </ol>
        </div>
    </div>

    <section id="photo-gallery" class="photo-gallery section" style="padding: 40px 0px 60px;">
        <div class="container">
            <div class="row gy-4 justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                @foreach ($galleryItems as $gallery)
                    @if (!empty($gallery->image))
                        <div class="col-md-4 mb-4">
                            <div class="gallery_image text-center">
                                <a href="{{ asset('uploads/gallery/' . $gallery->image) }}" title="{{ $gallery->title_1 }}"
                                    data-gallery="photo-gallery" class="glightbox">
                                    <img src="{{ asset('uploads/gallery/' . $gallery->image) }}"
                                        class="img-fluid rounded border shadow-sm" alt="Gallery Image">
                                </a>
                                <h5 class="text-center mt-2 text-black">
                                    {{ $gallery->title_1 }}
                                </h5>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
