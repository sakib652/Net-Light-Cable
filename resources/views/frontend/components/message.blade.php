<div class="container-fluid testimonial pt-5">
    <div class="container pb-3">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Message from the Authorities</h4>
        </div>

        <div class="row g-4 justify-content-center pt-4">
            @if ($message)
                {{-- Chairman Message --}}
                <div class="col-md-6">
                    <div class="testimonial-item rounded h-100" style="background: #4b645b">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ $message->image ? asset('uploads/message/' . $message->image) : asset('frontend/assets/img/no-image.png') }}"
                                    class="img-fluid h-100 rounded" style="object-fit: cover;"
                                    alt="{{ $message->name }}">
                            </div>
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="p-4">
                                    <h4 class="text-white fw-bold mb-0">{{ $message->name }}</h4>
                                    <p class="text-white mb-3">{{ $message->designation }}</p>
                                    <p class="text-white mb-3" style="text-align: justify;">
                                        {{ Str::limit($message->message, 150, '...') }}
                                    </p>
                                </div>
                                <div class="px-4 pb-3 d-flex justify-content-end">
                                    <a class="btn btn-outline-light btn-sm rounded-pill px-3"
                                        href="{{ route('front.about.view') }}#chairman">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- GM or Other Message --}}
                <div class="col-md-6">
                    <div class="testimonial-item rounded h-100" style="background: #4b645b">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ $message->image_2 ? asset('uploads/message/' . $message->image_2) : asset('frontend/assets/img/no-image.png') }}"
                                    class="img-fluid h-100 rounded" style="object-fit: cover;"
                                    alt="{{ $message->name_2 }}">
                            </div>
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="p-4">
                                    <h4 class="text-white fw-bold mb-0">{{ $message->name_2 }}</h4>
                                    <p class="text-white mb-3">{{ $message->designation_2 }}</p>
                                    <p class="text-white mb-3" style="text-align: justify;">
                                        {{ Str::limit($message->message_2, 150, '...') }}
                                    </p>
                                </div>
                                <div class="px-4 pb-3 d-flex justify-content-end">
                                    <a class="btn btn-outline-light btn-sm rounded-pill px-3"
                                        href="{{ route('front.about.view') }}#gm">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
