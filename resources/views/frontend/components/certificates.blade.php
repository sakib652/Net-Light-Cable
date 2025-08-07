<!-- Photo Gallery Start -->

<section id="photo" class="py-4">
    <div class="container">
        <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Certificates</h4>
        </div>

        <div class="row">
            @foreach ($certificate as $cert)
                <div class="col-md-3">
                    <div class="certificate_item text-center">
                        <a href="{{ asset($cert->image) }}" title="{{ $cert->title }}"
                            data-gallery="certificate-gallery" class="glightbox">
                            <img src="{{ asset($cert->image) }}" class="img-fluid rounded border shadow-sm"
                                alt="{{ $cert->title }}">
                        </a>
                        <h5 class="text-center mt-2 text-white">{{ htmlspecialchars($cert->title) }}</h5>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- View More Button --}}
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary btn-sm rounded-pill py-2 px-3" href="{{ route('front.certificate.view') }}">View
                More</a>
        </div>
    </div>
</section>
<!-- Photo Gallery End -->
