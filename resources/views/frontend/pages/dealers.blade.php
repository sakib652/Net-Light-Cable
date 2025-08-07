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
        <div class="container pb-3">
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="mb-4">
                        <label for="dealerSelect" class="form-label fw-bold">Select a Dealer</label>
                        <select id="dealerSelect" class="form-select">
                            <option selected disabled>-- Choose a Dealer --</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="dealerDescriptionCard" class="card shadow-sm border-0 d-none" style="background: #f9f9f9;">
                        <div class="card-body">
                            <h5 id="dealerName" class="card-title text-primary fw-semibold text-center"></h5>
                            <ol id="dealerDescription" class="card-text mt-2 text-dark ps-3 mt-4"></ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const dealers = @json($dealers);

            document.getElementById('dealerSelect').addEventListener('change', function() {
                const selectedId = this.value;
                const dealer = dealers.find(d => d.id == selectedId);

                if (dealer) {
                    document.getElementById('dealerName').textContent = dealer.name;

                    const descriptionContainer = document.getElementById('dealerDescription');
                    descriptionContainer.innerHTML = dealer.description?.trim() || '<p>No description available.</p>';

                    document.getElementById('dealerDescriptionCard').classList.remove('d-none');
                }
            });
        </script>
    @endpush
@endsection
