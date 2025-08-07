<!-- Category Start -->
<div class="container-fluid category">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Product Categories</h4>
        </div>

        <!-- Owl Carousel wrapper -->
        <div class="owl-carousel category-carousel owl-theme">
            @foreach ($category as $cat)
                <div class="category-item p-2">
                    <div class="category-img">
                        <img src="{{ asset($cat->image ?? 'uploads/no_images/no-image.png') }}"
                            class="img-fluid rounded-top w-100" alt="{{ $cat->name }}">
                    </div>
                    <div class="category-content text-center py-3">
                        <div class="category-content-inner">
                            <a href="#" class="d-inline-block h5 mb-3">{{ $cat->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Category End -->
