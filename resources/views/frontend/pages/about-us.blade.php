@extends('frontend.layouts.master')

@push('styles')
    <style>
        .img-box {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 160px;
            overflow: hidden;
            padding: 0 10px;
        }

        .img-box img {
            max-height: 100%;
            width: auto;
            object-fit: contain;
            position: relative;
            right: 106px;
        }

        .img-box-reverse {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 160px;
            overflow: hidden;
            padding: 0 10px;
        }

        .img-box-reverse img {
            max-height: 100%;
            width: auto;
            object-fit: contain;
            position: relative;
            left: 110px;
        }

        .text-box {
            position: relative;
            right: 190px;
        }

        .text-box-reverse {
            position: relative;
            left: 190px;
        }

        .card .card-body {
            background-color: #fff;
        }

        #chairman,
        #gm {
            background: #fff;
        }

        @media (max-width: 768px) {
            .img-box img {
                position: relative;
                right: 20px;
            }

            .img-box-reverse img {
                position: relative;
                left: -20px;
            }

            .text-box {
                position: relative;
                left: 170px;
            }

            .text-box-reverse {
                position: relative;
                left: 170px;
            }

        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item active text-danger mb-4">About</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid bg-light about pt-5 pb-5">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <h4 class="text-primary">About Our Company</h4>
                        <h1 class="display-4 mb-4">{{ $aboutUs->title }}</h1>
                        <p style="text-align: justify;">{{ $aboutUs->description }}</p>
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

        {{-- <div class="container pb-3">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary mb-4">Message from the Authorities</h4>
            </div>

            @if ($message)
                <div class="card mb-4 shadow-sm rounded border-0" id="chairman">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-4">
                            <div class="img-box">
                                <img src="{{ $message->image ? asset('uploads/message/' . $message->image) : asset('frontend/assets/img/no-image.png') }}"
                                    alt="{{ $message->name }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-box">
                                <h5 class="fw-bold mb-1">{{ $message->name }}</h5>
                                <h6 class="text-muted mb-0">{{ $message->designation }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-3">
                        <p class="card-text" style="text-align: justify;">{{ $message->message }}</p>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm rounded border-0" id="gm">
                    <div class="row g-0 align-items-center flex-md-row-reverse">
                        <div class="col-md-4">
                            <div class="img-box-reverse">
                                <img src="{{ $message->image_2 ? asset('uploads/message/' . $message->image_2) : asset('frontend/assets/img/no-image.png') }}"
                                    alt="{{ $message->name_2 }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-box-reverse text-md-end">
                                <h5 class="fw-bold mb-1">{{ $message->name_2 }}</h5>
                                <h6 class="text-muted mb-0">{{ $message->designation_2 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-3">
                        <p class="card-text" style="text-align: justify;">{{ $message->message_2 }}</p>
                    </div>
                </div>
            @endif
        </div> --}}
    </div>
@endsection
