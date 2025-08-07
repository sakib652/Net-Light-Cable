@extends('admin.layouts.master')

@section('title', 'Edit Product')

@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading">
                    <i class="fas fa-home"></i>
                    <a href="{{ route('dashboard') }}">Dashboard</a> > Edit Product
                </span>
            </div>

            <!-- Edit Product Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-edit me-1"></i> Edit Product</div>
                    <a href="{{ route('products.index') }}" class="btn btn-addnew">
                        <i class="fa fa-file-alt"></i> View All
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('products.update', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group row mt-2">
                                    <!-- Product Name -->
                                    <label for="product_name" class="col-sm-1 col-form-label">Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="product_name"
                                            name="name" value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <label for="category_id" class="col-sm-1 col-form-label">Category</label>
                                    <div class="col-sm-3">
                                        <select class="form-select form-select-sm" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Brand -->
                                    <label for="client_id" class="col-sm-1 col-form-label">Brand</label>
                                    <div class="col-sm-3">
                                        <select class="form-select form-select-sm" name="client_id" id="client_id">
                                            <option value="">Select Brand</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}"
                                                    {{ old('client_id', $product->client_id) == $client->id ? 'selected' : '' }}>
                                                    {{ $client->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('client_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-2">
                                    <!-- Price -->
                                    <label for="price" class="col-sm-1 col-form-label">Price</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="0.01" class="form-control form-control-sm"
                                            id="price" name="price" value="{{ old('price', $product->price) }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Product Thumbnail -->
                                    <label for="thumbnail_image" class="col-sm-1 col-form-label">Image</label>
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center">
                                            <img id="thumbPreview"
                                                src="{{ $product->thumbnail_image ? asset($product->thumbnail_image) : asset('uploads/no_images/no-image.png') }}"
                                                alt="Thumbnail Preview" width="40" class="me-2">
                                            <input type="file" class="form-control form-control-sm" id="thumbnail_image"
                                                name="thumbnail_image" accept="image/*" onchange="previewThumbnail(event)">
                                        </div>
                                        @error('thumbnail_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Gallery Images -->
                                    <label for="gallery_images" class="col-sm-1 col-form-label">M. Image</label>
                                    <div class="col-sm-3">
                                        <input type="file" class="form-control form-control-sm" id="gallery_images"
                                            name="gallery_images[]" multiple accept="image/*">
                                        @error('gallery_images.*')
                                            <span class="text-danger d-block">{{ $message }}</span>
                                        @enderror

                                        <!-- Existing Gallery -->
                                        <div class="mt-2">
                                            @php $gallery = json_decode($product->gallery_images, true); @endphp
                                            @if ($gallery && is_array($gallery))
                                                <div>
                                                    @foreach ($gallery as $index => $image)
                                                        <div class="d-inline-block position-relative">
                                                            <img src="{{ asset($image) }}" alt="Gallery" width="40"
                                                                height="40" class="m-1 rounded">

                                                            <!-- Delete button -->
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0 start-100 translate-middle p-1"
                                                                onclick="removeImage(this, {{ $index }})">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">No Images</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Discount Price -->
                                    <label for="discount_price" class="col-sm-1 col-form-label">Discount Price</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="0.01" class="form-control form-control-sm"
                                            id="discount_price" name="discount_price"
                                            value="{{ old('discount_price', $product->discount_price) }}">
                                        @error('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Product Code -->
                                    <label for="product_code" class="col-sm-1 col-form-label">Product Code</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="product_code"
                                            name="product_code"
                                            value="{{ old('product_code', $product->product_code) }}">
                                        @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <label for="description" class="col-sm-1 col-form-label">Description</label>
                                    <div class="col-sm-3">
                                        <textarea name="description" id="description" class="form-control form-control-sm" rows="4">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Feature Toggles -->
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label class="form-label d-block text-center fw-bold mb-2">Product Tags</label>
                                        <div class="d-flex justify-content-center flex-wrap gap-3">
                                            @php
                                                $toggles = [
                                                    'is_featured' => 'Featured',
                                                    'is_top_selling' => 'Top Selling',
                                                    'is_popular' => 'Popular',
                                                    'is_special' => 'Special',
                                                    'is_best' => 'Best',
                                                    'is_new' => 'New',
                                                ];
                                            @endphp

                                            @foreach ($toggles as $key => $label)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="{{ $key }}" name="{{ $key }}"
                                                        value="Yes"
                                                        {{ old($key, $product->$key) === 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="{{ $key }}">{{ $label }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        function previewThumbnail(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById('thumbPreview');
                imgElement.src = reader.result;
                imgElement.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error('CKEditor Error:', error);
            });

        function removeImage(btn, index) {
            // index to delete
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_gallery_images[]';
            input.value = index;
            btn.closest('form').appendChild(input);

            // Remove the thumbnail container from the DOM
            btn.closest('.position-relative').remove();
        }
    </script>
@endsection
