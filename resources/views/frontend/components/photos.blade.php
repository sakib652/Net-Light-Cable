<!-- Photo Gallery Start -->

@push('styles')
    <style>
        .gallary-main-image {
            height: 274px;
            width: 100%;
        }

        .gallary-image {
            height: 135px;
            width: 100%;
        }
    </style>
@endpush

<section id="photo" class="py-4">
    <div class="container py-5">
        <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Check Our Photos</h4>
        </div>
        <div class="row">
            {{-- Left Big Image --}}
            <div class="col-md-5 col-12 wow fadeInUp" data-wow-delay="0.2s">
                <div>
                    @if ($galleryImages->count() > 0)
                        <a href="{{ asset('uploads/gallery/' . $galleryImages[0]->image) }}" class="glightbox"
                            data-gallery="gallery1" title="{{ $galleryImages[0]->title_1 ?? 'Photo' }}">
                            <img src="{{ asset('uploads/gallery/' . $galleryImages[0]->image) }}" alt="Gallery Image"
                                class="gallary-main-image">
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right Thumbnail Images --}}
            <div class="col-md-7 col-12 mt-md-0 mt-2 wow fadeInUp" data-wow-delay="0.2s">
                <div class="row row-cols-md-3 row-cols-2 g-1">
                    @foreach ($galleryImages->skip(1) as $gallery)
                        <div class="col">
                            <div>
                                <a href="{{ asset('uploads/gallery/' . $gallery->image) }}" class="glightbox"
                                    data-gallery="gallery1" title="{{ $gallery->title_1 ?? 'Gallery' }}">
                                    <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" alt="Gallery Image"
                                        class="gallary-image">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a class="btn btn-primary btn-sm rounded-pill py-2 px-3" href="{{ route('gallery.photo') }}">View More</a>
        </div>
    </div>
</section>
<!-- Photo Gallery End -->
