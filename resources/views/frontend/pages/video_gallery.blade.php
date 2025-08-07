@extends('frontend.layouts.master')

<style>
    .gallery_image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border: 1px solid black !important;
    }
</style>

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">Photo Gallery</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item mb-4"><a href="#">Gallery</a></li>
                <li class="breadcrumb-item active text-danger mb-4">Video Gallery</li>
            </ol>
        </div>
    </div>

    <section id="video-gallery" class="video-gallery section" style="padding: 45px 0px 60px;">
        <div class="container">
            <div class="row gy-4 justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                @foreach ($videoGalleries as $gallery)
                    @if ($gallery->type === 'video' && !empty($gallery->video_url))
                        <div class="col-md-4 mb-4">
                            <div class="gallery_video text-center">
                                <div class="embed-responsive embed-responsive-16by9">
                                    @if ($gallery->video_url)
                                        <iframe width="100%" height="215"
                                            src="https://www.youtube.com/embed/{{ parse_youtube_video_id($gallery->video_url) }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <p>No video available for this gallery item.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection

@php
    function parse_youtube_video_id($url)
    {
        preg_match(
            '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|\S+[\?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches,
        );
        return $matches[1] ?? null;
    }
@endphp
