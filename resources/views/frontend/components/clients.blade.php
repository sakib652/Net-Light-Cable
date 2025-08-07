<!-- Brand Start -->

@push('styles')
    <style>
        .client-carousel-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            cursor: grab;
        }

        .client-carousel {
            display: flex;
            gap: 20px;
            animation: scrollAnimation 40s linear infinite;
        }

        .client-item {
            flex: 0 0 calc(100% / 5);
            text-align: center;
            user-select: none;
        }

        .client-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .client-card img {
            width: auto;
            height: 60px;
            max-width: 100%;
            object-fit: contain;
        }

        @keyframes scrollAnimation {
            from {
                transform: translateX(0%);
            }

            to {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 768px) {
            .client-item {
                flex: 0 0 calc(100% / 3);
            }
        }

        @media (max-width: 480px) {
            .client-item {
                flex: 0 0 calc(100% / 2);
            }
        }
    </style>
@endpush

<section id="client" style="position: relative; bottom: 25px;">
    <div class="container py-5">
        <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Our Brand Partners</h4>
        </div>

        <div class="row mt-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 col-md-12 col-12 ps-0">
                <div class="client-carousel-container">
                    <div class="client-carousel">
                        @foreach ($clients as $client)
                            <div class="client-item">
                                <div class="card client-card text-center">
                                    <img src="{{ $client->image ? asset($client->image) : asset('uploads/no_images/no-image.png') }}"
                                        class="card-img-top" alt="{{ $client->name }}">
                                </div>
                            </div>
                        @endforeach

                        {{-- Duplicate for continuous effect --}}
                        @foreach ($clients as $client)
                            <div class="client-item">
                                <div class="card client-card text-center">
                                    <img src="{{ $client->image ? asset($client->image) : asset('uploads/no_images/no-image.png') }}"
                                        class="card-img-top" alt="{{ $client->name }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const carousel = document.querySelector(".client-carousel");
                carousel.style.animation = "none";

                let scrollAmount = 0;
                const speed = 0.5;
                let isDragging = false,
                    startX, scrollLeft;

                function smoothScroll() {
                    if (!isDragging) {
                        scrollAmount -= speed;
                        if (Math.abs(scrollAmount) >= carousel.scrollWidth / 2) {
                            scrollAmount = 0;
                        }
                        carousel.style.transform = `translateX(${scrollAmount}px)`;
                    }
                    requestAnimationFrame(smoothScroll);
                }

                carousel.addEventListener("mousedown", (e) => {
                    isDragging = true;
                    startX = e.pageX;
                    scrollLeft = scrollAmount;
                    carousel.style.cursor = "grabbing";
                });
                document.addEventListener("mousemove", (e) => {
                    if (!isDragging) return;
                    const diff = e.pageX - startX;
                    scrollAmount = scrollLeft + diff;
                    carousel.style.transform = `translateX(${scrollAmount}px)`;
                });
                document.addEventListener("mouseup", () => {
                    isDragging = false;
                    carousel.style.cursor = "grab";
                });

                // disable image dragging
                document.querySelectorAll(".client-item img").forEach(img => img.draggable = false);

                smoothScroll();
            });
        </script>
    @endpush
</section>
<!-- Brand End -->
