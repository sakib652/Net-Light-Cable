@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">
                {{ ucfirst($type) === 'Management' ? 'Our Management' : 'Our Team' }}
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active text-danger mb-4">{{ ucfirst($type) }}</li>
            </ol>
        </div>
    </div>

    <section id="team" class="team section mt-4 mb-4" style="padding: 35px 0 85px;">
        <div class="container">
            <div class="row gy-4 d-flex justify-content-center">
                @forelse ($management as $member)
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration * 2 }}s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset($member->image) }}" class="img-fluid rounded-top w-100"
                                    alt="{{ $member->name }}">
                                <div class="team-icon">
                                    @if ($member->facebook_link)
                                        <a class="btn btn-primary btn-sm-square rounded-pill mb-2"
                                            href="{{ $member->facebook_link }}" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if ($member->twitter_link)
                                        <a class="btn btn-primary btn-sm-square rounded-pill mb-2"
                                            href="{{ $member->twitter_link }}" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if ($member->linkedin_link)
                                        <a class="btn btn-primary btn-sm-square rounded-pill mb-2"
                                            href="{{ $member->linkedin_link }}" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="team-title p-4">
                                <h4 class="mb-0">{{ $member->name }}</h4>
                                <p class="mb-0">{{ $member->designation }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No {{ $type }} members found.</p>
                    </div>
                @endforelse
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
    </style>
@endsection
