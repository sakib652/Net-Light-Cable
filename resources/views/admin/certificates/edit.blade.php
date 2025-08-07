@extends('admin.layouts.master')

@section('title', 'Edit Certificate')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> >
                    Edit Certificate</span>
            </div>

            <!-- Edit Certificate Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-certificate me-1"></i> Edit Certificate</div>
                    <a href="{{ route('certificate.index') }}" class="btn btn-addnew">
                        <i class="fa fa-file-alt"></i> View All Certificates
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('certificate.update', $certificate->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Certificate Image -->
                                <div class="form-group row mt-2">
                                    <label for="certificate_image" class="col-sm-1 col-form-label">Image</label>
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center">
                                            <img id="imagePreview"
                                                src="{{ $certificate->image ? asset($certificate->image) : asset('uploads/no_images/no-image.png') }}"
                                                alt="Certificate Image Preview" width="40" class="me-2">
                                            <input type="file" class="form-control form-control-sm"
                                                id="certificate_image" name="image" accept="image/*"
                                                onchange="previewImage(event)">
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="text-muted d-inline-block text-nowrap">
                                            <span style="color: red; position: relative;">
                                                JPG/JPEG/PNG • Max: 2MB • 500×400px
                                            </span>
                                        </small>
                                    </div>

                                    <!-- Certificate Title -->
                                    <label for="certificate_title" class="col-sm-1 col-form-label">Title</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="certificate_title"
                                            name="title" value="{{ old('title', $certificate->title) }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Certificate Description -->
                                    <label for="certificate_description" class="col-sm-1 col-form-label">Description</label>
                                    <div class="col-sm-3">
                                        <textarea class="form-control form-control-sm" id="certificate_description" name="description">{{ old('description', $certificate->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-primary">Update Certificate</button>
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
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById('imagePreview');
                imgElement.src = reader.result;
                imgElement.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        ClassicEditor
            .create(document.querySelector('#certificate_description'))
            .catch(error => {
                console.error('CKEditor Error:', error);
            });
    </script>
@endsection
