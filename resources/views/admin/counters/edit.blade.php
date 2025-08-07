@extends('admin.layouts.master')

@section('title', 'Edit Counter')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading">
                    <i class="fas fa-home"></i>
                    <a href="{{ route('dashboard') }}">Dashboard</a> > Edit Counter
                </span>
            </div>

            <!-- Edit Counter Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-edit me-1"></i> Edit Counter</div>
                    <a href="{{ route('counters.create') }}" class="btn btn-addnew">
                        <i class="fa fa-plus-circle"></i> Add New Counter
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <form method="POST" action="{{ route('counters.update', $counter->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row align-items-center">
                            <!-- Title -->
                            <label for="title" class="col-sm-1 col-form-label">Title</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="title" id="title"
                                    value="{{ old('title', $counter->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Value -->
                            <label for="value" class="col-sm-1 col-form-label">Value</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control form-control-sm" name="value" id="value"
                                    value="{{ old('value', $counter->value) }}">
                                @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Icon -->
                            {{-- <label for="icon" class="col-sm-1 col-form-label">Icon</label>
                            <div class="col-sm-3">
                                <div class="d-flex align-items-center">
                                    <img id="iconPreview"
                                        src="{{ $counter->icon ? asset($counter->icon) : asset('uploads/no_images/no-image.png') }}"
                                        alt="Icon Preview" width="40" class="me-2">
                                    <input type="file" class="form-control form-control-sm" id="icon" name="icon"
                                        accept="image/*" onchange="previewIcon(event)">
                                </div>
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                        </div>

                        <hr class="my-2">
                        <div class="clearfix">
                            <div class="text-end m-auto">
                                <button type="reset" class="btn btn-dark">Reset</button>
                                <button type="submit" class="btn btn-primary">Update Counter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function previewIcon(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById('iconPreview');
                imgElement.src = reader.result;
                imgElement.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@endsection
