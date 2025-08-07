@extends('admin.layouts.master')

@section('title', 'Create Management')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> >
                    Create Management</span>
            </div>

            <!-- Create Management Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-user-plus me-1"></i> Add New Management Member</div>
                    <a href="{{ route('management.index') }}" class="btn btn-addnew">
                        <i class="fa fa-file-alt"></i> View All
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('management.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Management Image -->
                                <div class="form-group row mt-2">
                                    <label for="management_image" class="col-sm-1 col-form-label">Image</label>
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center">
                                            <img id="imagePreview" src="{{ asset('uploads/no_images/no-image.png') }}"
                                                alt="Management Image Preview" width="40" class="me-2">
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

                                    <!-- Management Name -->
                                    <label for="management_name" class="col-sm-1 col-form-label">Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="management_name"
                                            name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Management Designation -->
                                    <label for="management_designation" class="col-sm-1 col-form-label">Designation</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm"
                                            id="management_designation" name="designation" value="{{ old('designation') }}">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Management Phone -->
                                <div class="form-group row mt-2">
                                    <label for="management_phone" class="col-sm-1 col-form-label">Phone</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="management_phone"
                                            name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Management Email -->
                                    <label for="management_email" class="col-sm-1 col-form-label">Email</label>
                                    <div class="col-sm-3">
                                        <input type="email" class="form-control form-control-sm" id="management_email"
                                            name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Facebook Link -->
                                    <label for="facebook_link" class="col-sm-1 col-form-label">Facebook</label>
                                    <div class="col-sm-3">
                                        <input type="url" class="form-control form-control-sm" id="facebook_link"
                                            name="facebook_link" value="{{ old('facebook_link') }}">
                                        @error('facebook_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-2">
                                    <!-- LinkedIn Link -->
                                    <label for="linkedin_link" class="col-sm-1 col-form-label">LinkedIn</label>
                                    <div class="col-sm-3">
                                        <input type="url" class="form-control form-control-sm" id="linkedin_link"
                                            name="linkedin_link" value="{{ old('linkedin_link') }}">
                                        @error('linkedin_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Twitter Link -->
                                    <label for="twitter_link" class="col-sm-1 col-form-label">Twitter</label>
                                    <div class="col-sm-3">
                                        <input type="url" class="form-control form-control-sm" id="twitter_link"
                                            name="twitter_link" value="{{ old('twitter_link') }}">
                                        @error('twitter_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Type Dropdown -->
                                    <label for="management_type" class="col-sm-1 col-form-label">Type</label>
                                    <div class="col-sm-3">
                                        <select name="type" id="management_type" class="form-select form-select-sm"
                                            required>
                                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select
                                                Type</option>
                                            <option value="management"
                                                {{ old('type') == 'management' ? 'selected' : '' }}>Management</option>
                                            <option value="employee" {{ old('type') == 'employee' ? 'selected' : '' }}>
                                                Employee</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-primary">Add Member</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Management List Table -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-list me-1"></i>Management List</div>
                </div>
                <div class="card-body table-card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Social Links</th>
                                @if (auth()->user()->type == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($management as $key => $member)
                                <tr class="text-center">
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $member->image ? asset($member->image) : asset('uploads/no_images/no-image.png') }}"
                                            alt="Management Image" width="50">
                                    </td>
                                    <td class="text-center align-middle">{{ $member->name }}</td>
                                    <td class="text-center align-middle">{{ $member->designation }}</td>
                                    <td class="text-center align-middle">{{ $member->phone ?? 'N/A' }}</td>
                                    <td class="text-center align-middle">{{ $member->email ?? 'N/A' }}</td>
                                    <td class="text-center align-middle text-capitalize">{{ $member->type }}</td>
                                    <td class="text-center align-middle">
                                        @if (!$member->facebook_link && !$member->linkedin_link && !$member->twitter_link)
                                            N/A
                                        @else
                                            <div class="d-flex justify-content-center gap-2">
                                                @if ($member->facebook_link)
                                                    <a href="{{ $member->facebook_link }}" target="_blank"
                                                        class="text-primary">
                                                        <i class="bi bi-facebook"></i>
                                                    </a>
                                                @endif
                                                @if ($member->linkedin_link)
                                                    <a href="{{ $member->linkedin_link }}" target="_blank"
                                                        class="text-info">
                                                        <i class="bi bi-linkedin"></i>
                                                    </a>
                                                @endif
                                                @if ($member->twitter_link)
                                                    <a href="{{ $member->twitter_link }}" target="_blank"
                                                        class="text-info">
                                                        <i class="bi bi-twitter-x"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    @if (auth()->user()->type == 'admin')
                                        <td class="text-center align-middle" style="vertical-align: middle;">
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height: 100%;">
                                                <form action="{{ route('management.updateStatus', $member->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status"
                                                        value="{{ $member->status == 'a' ? 'd' : 'a' }}">
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $member->status == 'a' ? 'btn-success' : 'btn-danger' }} d-flex align-items-center justify-content-center"
                                                        style="padding: 4px 12px; font-size: 12px;">
                                                        @if ($member->status == 'a')
                                                            <i class="fas fa-check-circle me-1"></i> Active
                                                        @else
                                                            <i class="fas fa-ban me-1"></i> Deactive
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="{{ route('management.edit', $member->id) }}" class="btn btn-edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            {{-- <form action="{{ route('management.destroy', $member->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete"
                                                    onclick="return confirm('Are you sure you want to delete this member?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form> --}}
                                            <form action="{{ route('management.destroy', $member->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-delete show-confirm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
