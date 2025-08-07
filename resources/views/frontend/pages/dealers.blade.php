@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">Dealers</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active text-danger mb-4">Dealers</li>
            </ol>
        </div>
    </div>

    <!-- Dealers Start -->
    <div class="container-fluid team" style="padding: 15px 0 70px;">
        <div class="container">
            <div class="row g-4 d-flex justify-content-center">
                @forelse($dealers as $dealer)
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="border rounded p-4 h-100">
                            <h5 class="mb-2 text-primary">{{ $dealer->org_name }}</h5>
                            <p class="mb-1"><strong>Organization Name:</strong> {{ $dealer->org_name }}</p>
                            <p class="mb-1"><strong>Owner:</strong> {{ $dealer->owner_name }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $dealer->phone }}</p>
                            <p class="mb-1"><strong>Address:</strong> {{ $dealer->address }}</p>
                            @if ($dealer->area)
                                <p class="mb-1"><strong>Area:</strong> {{ $dealer->area->name }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No dealers found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
