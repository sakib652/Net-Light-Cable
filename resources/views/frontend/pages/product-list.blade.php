@extends('frontend.layouts.master')

@push('styles')
    <style>
        .product-button {
            display: inline-block;
            padding: 4px 20px;
            border: 2px solid #16243d;
            border-radius: 25px;
            color: black;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .product-button:hover {
            background-color: #16243d;
            color: white;
        }

        .fixed-height-image {
            width: 612px;
            height: 280px;
        }

        .products {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-top {
            flex: 1;
            background: transparent;
        }

        .product-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .product-bottom {
            background: #1f1f1f;
            padding: 10px 12px;
            border-top: 1px solid #333;
            border-radius: 0 0 10px 10px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 90px;
        }

        .product-bottom h4 {
            color: white !important;
            font-size: 1rem;
            margin: 2px 0 4px 0;
        }

        .product-bottom span {
            color: white !important;
            font-size: 0.875rem;
            margin-bottom: 2px;
        }

        .custom-button {
            display: inline-block;
            padding: 4px 16px;
            border: 2px solid #009444;
            border-radius: 25px;
            color: white;
            font-size: 0.75rem;
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        .custom-button:hover {
            background-color: #009444;
            color: white;
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: #fff;
            padding: 5px 8px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 0 0 0 5px;
            z-index: 10;
        }

        @media(max-width: 767px) {
            .products {
                position: relative;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">
                {{ isset($clientName) ? $clientName : 'Product List' }}
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4">
                    <a href="{{ route('home') }}" class="text-white">Home</a>
                </li>

                @if (isset($clientName))
                    <li class="breadcrumb-item mb-4">
                        <a href="{{ route('product.productList') }}" class="text-white">Products</a>
                    </li>
                    <li class="breadcrumb-item active text-danger mb-4">{{ $clientName }}</li>
                @else
                    <li class="breadcrumb-item active text-danger mb-4">Product List</li>
                @endif
            </ol>
        </div>
    </div>

    <!-- Products -->
    <div class="container-fluid brand">
        <div class="container" style="padding: 50px 0 90px;">
            <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay="0.2s" id="product-list">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 product-item" data-client-id="{{ $product->client->id ?? '0' }}">
                        <div class="products">
                            <div class="product-top position-relative">
                                @if ($product->discount_price && $product->discount_price < $product->price)
                                    @php
                                        $discountPercent = round(
                                            (($product->price - $product->discount_price) / $product->price) * 100,
                                        );
                                    @endphp
                                    <div
                                        class="discount-badge position-absolute top-0 end-0 bg-danger text-white px-2 py-1 small rounded-start">
                                        {{ $discountPercent }}% OFF
                                    </div>
                                @endif
                                <div class="product-image">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                        <img src="{{ asset($product->thumbnail_image ?? 'uploads/no_images/no-image.png') }}"
                                            class="img-fluid product-height-image" alt="{{ $product->name }}">
                                    </a>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <h4 class="text-white">{{ $product->name }}</h4>
                                @if ($product->discount_price && $product->discount_price < $product->price)
                                    <span class="text-success fw-bold">
                                        ৳ {{ number_format($product->discount_price, 2) }}
                                        <del class="text-danger">৳ {{ number_format($product->price, 2) }}</del>
                                    </span>
                                @else
                                    <span class="text-light">৳ {{ number_format($product->price, 2) }}</span>
                                @endif
                                <div>
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                        class="custom-button">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
