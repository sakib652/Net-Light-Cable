<!-- Team Start -->
<div class="container-fluid team bg-light">
    <div class="container pb-3">
        <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary pt-4">Our Team</h4>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($management as $member)
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
            @endforeach
        </div>
        {{-- View More Button --}}
        <div class="d-flex justify-content-end mt-4">
            <a class="btn btn-primary btn-sm rounded-pill py-2 px-3"
                href="{{ route('front.team.view', ['type' => 'employee']) }}">
                View More
            </a>
        </div>
    </div>
</div>
<!-- Team End -->
