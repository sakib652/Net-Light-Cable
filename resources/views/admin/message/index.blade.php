@extends('admin.layouts.master')

@section('title', 'About Us')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="card my-3">
                <div class="heading-title p-2 my-2">
                    <span class="my-3 heading"><i class="fas fa-home"></i>
                        <a href="{{ route('dashboard') }}">Dashboard</a> > About Us
                    </span>
                </div>
                <div class="card-body table-card-body">
                    @if ($message)
                        <form method="POST" action="{{ route('message.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Message Section 1 -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header bg-dark text-white">
                                            <h5>Message Section 1</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $message->name ?? '') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="designation">Designation</label>
                                                <input type="text" class="form-control" id="designation"
                                                    name="designation"
                                                    value="{{ old('designation', $message->designation ?? '') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <div class="d-flex align-items-center">
                                                    <img id="imagePreview"
                                                        src="{{ $message->image ? asset('uploads/message/' . $message->image) : asset('uploads/no_images/no-image.png') }}"
                                                        alt="Image Preview" width="50" class="me-2">
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        onchange="previewImage(event, 'imagePreview')">
                                                </div>
                                                <small class="text-muted d-inline-block text-nowrap">
                                                    <span style="color: red; position: relative;">
                                                        JPG/JPEG/PNG • Max: 2MB • 400×500px
                                                    </span>
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message', $message->message ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message Section 2 -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header bg-dark text-white">
                                            <h5>Message Section 2</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name_2">Name</label>
                                                <input type="text" class="form-control" id="name_2" name="name_2"
                                                    value="{{ old('name_2', $message->name_2 ?? '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="designation_2">Designation</label>
                                                <input type="text" class="form-control" id="designation_2"
                                                    name="designation_2"
                                                    value="{{ old('designation_2', $message->designation_2 ?? '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="image_2">Image</label>
                                                <div class="d-flex align-items-center">
                                                    <img id="imagePreview2"
                                                        src="{{ $message->image_2 ? asset('uploads/message/' . $message->image_2) : asset('uploads/no_images/no-image.png') }}"
                                                        alt="Image Preview" width="50" class="me-2">
                                                    <input type="file" class="form-control" id="image_2" name="image_2"
                                                        onchange="previewImage(event, 'imagePreview2')">
                                                </div>
                                                <small class="text-muted d-inline-block text-nowrap">
                                                    <span style="color: red; position: relative;">
                                                        JPG/JPEG/PNG • Max: 2MB • 400×500px
                                                    </span>
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label for="message_2">Message</label>
                                                <textarea class="form-control" id="message_2" name="message_2" rows="5">{{ old('message_2', $message->message_2 ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">Message content found. Please create a new entry.</div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById(previewId);
                imgElement.src = reader.result;
                imgElement.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        ClassicEditor
            .create(document.querySelector('#message'))
            .catch(error => {
                console.error('CKEditor Error:', error);
            });

        ClassicEditor
            .create(document.querySelector('#message_2'))
            .catch(error => {
                console.error('CKEditor Error:', error);
            });
    </script>
@endsection
