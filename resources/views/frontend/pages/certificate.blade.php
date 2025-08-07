@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">Certificates</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item active text-danger mb-4">Certificates</li>
            </ol>
        </div>
    </div>

    <section class="certificate_section" style="padding: 40px 0px 60px;">
        <div class="container">
            <div class="row">
                @foreach ($certificate as $cert)
                    <div class="col-md-4 mb-4">
                        <div class="certificate_item text-center">
                            <a href="{{ asset($cert->image) }}" title="{{ $cert->title }}"
                                data-gallery="certificate-gallery" class="glightbox">
                                <img src="{{ asset($cert->image) }}" class="img-fluid rounded border shadow-sm"
                                    alt="Certificate Image">
                            </a>
                            <h5 class="text-center mt-2 text-black">{{ htmlspecialchars($cert->title) }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .certificate_section h2 {
            display: inline-block;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            text-align: center;
        }

        .certificate_item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 1px solid black !important;
        }
    </style>
@endsection
