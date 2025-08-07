@extends('admin.layouts.master')

@section('title', 'Edit Management Member')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> >
                    <a href="{{ route('management.create') }}">Create Management</a> > Edit Management Member</span>
            </div>

            <!-- Edit Management Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-user-edit me-1"></i> Edit Management Member</div>
                    <a href="{{ route('management.create') }}" class="btn btn-addnew">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <form method="POST" action="{{ route('management.update', $management->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Management Image -->
                            <div class="form-group row mt-2">
                                <label for="management_image" class="col-sm-1 col-form-label">Image</label>
                                <div class="col-sm-3">
                                    <div class="d-flex align-items-center">
                                        <img id="imagePreview"
                                            src="{{ $management->image ? asset($management->image) : asset('uploads/no_images/no-image.png') }}"
                                            alt="Management Image" width="40" class="me-2">
                                        <input type="file" class="form-control form-control-sm" id="management_image"
                                            name="image" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted d-inline-block text-nowrap">
                                        <span style="color: red; position: relative;">
                                            JPG/JPEG/PNG • Max: 2MB • 300×300px
                                        </span>
                                    </small>
                                </div>

                                <!-- Name -->
                                <label for="management_name" class="col-sm-1 col-form-label">Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" id="management_name"
                                        name="name" value="{{ old('name', $management->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Designation -->
                                <label for="management_designation" class="col-sm-1 col-form-label">Designation</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" id="management_designation"
                                        name="designation" value="{{ old('designation', $management->designation) }}">
                                    @error('designation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone and Email -->
                            <div class="form-group row mt-2">
                                <label for="management_phone" class="col-sm-1 col-form-label">Phone</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" id="management_phone"
                                        name="phone" value="{{ old('phone', $management->phone) }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="management_email" class="col-sm-1 col-form-label">Email</label>
                                <div class="col-sm-3">
                                    <input type="email" class="form-control form-control-sm" id="management_email"
                                        name="email" value="{{ old('email', $management->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="facebook_link" class="col-sm-1 col-form-label">Facebook</label>
                                <div class="col-sm-3">
                                    <input type="url" class="form-control form-control-sm" id="facebook_link"
                                        name="facebook_link"
                                        value="{{ old('facebook_link', $management->facebook_link) }}">
                                    @error('facebook_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Social Media Links -->
                            <div class="form-group row mt-2">
                                <label for="linkedin_link" class="col-sm-1 col-form-label">LinkedIn</label>
                                <div class="col-sm-3">
                                    <input type="url" class="form-control form-control-sm" id="linkedin_link"
                                        name="linkedin_link"
                                        value="{{ old('linkedin_link', $management->linkedin_link) }}">
                                    @error('linkedin_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="twitter_link" class="col-sm-1 col-form-label">Twitter</label>
                                <div class="col-sm-3">
                                    <input type="url" class="form-control form-control-sm" id="twitter_link"
                                        name="twitter_link" value="{{ old('twitter_link', $management->twitter_link) }}">
                                    @error('twitter_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="management_type" class="col-sm-1 col-form-label">Type</label>
                                <div class="col-sm-3">
                                    <select name="type" id="management_type" class="form-select form-select-sm"
                                        required>
                                        <option value="" disabled
                                            {{ old('type', $management->type) ? '' : 'selected' }}>Select Type</option>
                                        <option value="management"
                                            {{ old('type', $management->type) == 'management' ? 'selected' : '' }}>
                                            Management</option>
                                        <option value="employee"
                                            {{ old('type', $management->type) == 'employee' ? 'selected' : '' }}>Employee
                                        </option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <a href="{{ route('management.create') }}" class="btn btn-dark">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Member</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

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
    </script>
@endsection
