<!-- Video Gallery Start -->
<section class="video py-4 bg-light" style="position: relative; bottom: 65px;">
    <div class="container py-3">
        <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Check Our Videos</h4>
        </div>

        @if ($videos->count() > 0)
            <div class="row">

                <div class="col-md-5 col-12 wow fadeInUp" data-wow-delay="0.2s">
                    <div>
                        <iframe width="100%" height="274"
                            src="{{ str_replace('watch?v=', 'embed/', $videos[0]->video_url) }}"
                            title="{{ $videos[0]->title_1 ?? 'Video' }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="col-md-7 col-12 mt-md-0 mt-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="row row-cols-md-3 row-cols-2 gx-1">
                        @foreach ($videos->skip(1)->take(6) as $video)
                            <div class="col">
                                <iframe width="100%" height="135"
                                    src="{{ str_replace('watch?v=', 'embed/', $video->video_url) }}"
                                    title="{{ $video->title_1 ?? 'Video' }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- View More Button --}}
            <div class="d-flex justify-content-end mt-4">
                <a class="btn btn-primary btn-sm rounded-pill py-2 px-3" href="{{ route('gallery.video') }}">View
                    More</a>
            </div>
        @else
            <p class="text-center text-muted">No videos available right now.</p>
        @endif
    </div>
</section>
<!-- Video Gallery End -->
