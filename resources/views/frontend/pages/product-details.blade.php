@extends('frontend.layouts.master')

@push('styles')
    <style>
        .slider-border {
            /* border: 1px solid #ddd; */
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
        }

        .product-info-wrapper {
            position: relative;
            top: 60px;
        }

        .main-product-image {
            max-height: 400px;
            /* width: 100%; */
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .thumbnail-gallery {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .thumbnail-item {
            width: 60px;
            height: 60px;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .thumbnail-item:hover,
        .thumbnail-item.active {
            border-color: #0d6efd;
            transform: scale(1.05);
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        @media(max-width: 767px) {
            .product-info-wrapper {
                top: 0px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">
                {{ $product->name }}
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4">
                    <a href="{{ route('home') }}" class="text-white">Home</a>
                </li>
                <li class="breadcrumb-item mb-4">
                    <a href="{{ route('product.productList') }}" class="text-white">Products</a>
                </li>
                <li class="breadcrumb-item active text-danger mb-4">{{ $product->name }}</li>
            </ol>
        </div>
    </div>


    <section id="portfolio-details" class="portfolio-details section" style="padding: 55px 0 90px;">
        <div class="container">

            <!-- First row: main image and product info -->
            <div class="row gy-4">
                <!-- Main Image and Gallery -->
                <div class="col-lg-8 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="slider-border">
                        <!-- Main Image -->
                        <div class="main-image-wrapper text-center mb-4">
                            @if ($product->gallery_images && count($product->gallery_images))
                                <img id="mainImage" src="{{ asset($product->gallery_images[0]) }}"
                                    alt="{{ $product->name }}" class="main-product-image">
                            @elseif ($product->thumbnail_image)
                                <img id="mainImage" src="{{ asset($product->thumbnail_image) }}" alt="{{ $product->name }}"
                                    class="main-product-image">
                            @else
                                <img id="mainImage" src="{{ asset('frontend/assets/img/no-image.png') }}" alt="No Image"
                                    class="main-product-image">
                            @endif
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="thumbnail-gallery">
                            @if ($product->gallery_images && count($product->gallery_images))
                                @foreach ($product->gallery_images as $image)
                                    <div class="thumbnail-item" onclick="changeMainImage(this, '{{ asset($image) }}')">
                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}" class="thumbnail-image">
                                    </div>
                                @endforeach
                            @elseif ($product->thumbnail_image)
                                <div class="thumbnail-item"
                                    onclick="changeMainImage(this, '{{ asset($product->thumbnail_image) }}')">
                                    <img src="{{ asset($product->thumbnail_image) }}" alt="{{ $product->name }}"
                                        class="thumbnail-image">
                                </div>
                            @else
                                <div class="thumbnail-item"
                                    onclick="changeMainImage(this, '{{ asset('frontend/assets/img/no-image.png') }}')">
                                    <img src="{{ asset('frontend/assets/img/no-image.png') }}" alt="No Image"
                                        class="thumbnail-image">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-4 product-info-wrapper wow fadeInRight" data-wow-delay="0.1s">
                    <div class="portfolio-info">
                        <h3>Product Information</h3>
                        <ul>
                            <li><strong>Name</strong>: {{ $product->name ?? 'N/A' }}</li>
                            <li><strong>Category</strong>: {{ $product->category->name ?? 'N/A' }}</li>
                            <li><strong>Brand</strong>: {{ $product->client->name ?? 'N/A' }}</li>
                            <li><strong>Price</strong>: ৳ {{ number_format($product->price, 2) }}</li>
                            <li><strong>Discount Price</strong>:
                                {{ $product->discount_price ? '৳ ' . number_format($product->discount_price, 2) : 'N/A' }}
                            </li>

                            @if ($product->discount_price && $product->price > 0)
                                @php
                                    $discount = (($product->price - $product->discount_price) / $product->price) * 100;
                                @endphp
                                <li><strong>Discount</strong>: {{ number_format($discount, 1) }}% Off</li>
                            @endif
                            <li><strong>Product Code</strong>: {{ $product->product_code ?? 'N/A' }}</li>
                            <li><strong>Top Selling</strong>: {{ $product->is_top_selling === 'Yes' ? 'Yes ✅' : 'No ❌' }}
                            </li>
                            {{-- <li><strong>Popular</strong>: {{ $product->is_popular === 'Yes' ? 'Yes ✅' : 'No ❌' }}</li>
                            <li><strong>Featured</strong>: {{ $product->is_featured === 'Yes' ? 'Yes ✅' : 'No ❌' }}</li>
                            <li><strong>Special</strong>: {{ $product->is_special === 'Yes' ? 'Yes ✅' : 'No ❌' }}</li>
                            <li><strong>Best</strong>: {{ $product->is_best === 'Yes' ? 'Yes ✅' : 'No ❌' }}</li>
                            <li><strong>New Arrival</strong>: {{ $product->is_new === 'Yes' ? 'Yes ✅' : 'No ❌' }}</li> --}}
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Second row: product description -->
            <div class="row mt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12">
                    <div class="portfolio-description" style="border-top: 1px solid #ddd; padding-top: 20px;">
                        <h2>Product Description</h2>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <!-- JavaScript for image switching -->
    <script>
        function changeMainImage(thumbnail, imageUrl) {
            document.getElementById('mainImage').src = imageUrl;

            const allThumbnails = document.querySelectorAll('.thumbnail-item');
            allThumbnails.forEach(item => item.classList.remove('active'));

            thumbnail.classList.add('active');
        }
    </script>
@endpush
