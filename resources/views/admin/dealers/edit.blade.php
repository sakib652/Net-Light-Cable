@extends('admin.layouts.master')

@section('title', 'Edit Dealer')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading">
                    <i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> > Edit Dealer
                </span>
            </div>

            <!-- Edit Dealer Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-user-edit me-1"></i> Edit Dealer</div>
                    <a href="{{ route('dealer.index') }}" class="btn btn-addnew">
                        <i class="fa fa-file-alt"></i> View All
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('dealer.update', $dealer->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group row mt-2">
                                    <!-- Organization Name -->
                                    <label for="org_name" class="col-sm-1 col-form-label">Org. Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="org_name"
                                            name="org_name" value="{{ old('org_name', $dealer->org_name) }}" required>
                                        @error('org_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Area -->
                                    <label for="area_id" class="col-sm-1 col-form-label">Area</label>
                                    <div class="col-sm-3">
                                        <select name="area_id" id="area_id" class="form-select form-select-sm">
                                            <option value="">Select Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}"
                                                    {{ old('area_id', $dealer->area_id) == $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Owner Name -->
                                    <label for="owner_name" class="col-sm-1 col-form-label">Owner</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="owner_name"
                                            name="owner_name" value="{{ old('owner_name', $dealer->owner_name) }}">
                                        @error('owner_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <!-- Phone -->
                                    <label for="phone" class="col-sm-1 col-form-label">Phone</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="phone"
                                            name="phone" value="{{ old('phone', $dealer->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <label for="address" class="col-sm-1 col-form-label">Address</label>
                                    <div class="col-sm-3">
                                        <textarea class="form-control form-control-sm" id="address" name="address" rows="2">{{ old('address', $dealer->address) }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-primary">Update Dealer</button>
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
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error('CKEditor Error:', error);
            });
    </script>
@endsection
