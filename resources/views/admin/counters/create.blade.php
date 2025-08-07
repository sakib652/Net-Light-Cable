@extends('admin.layouts.master')

@section('title', 'Create Counter')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading">
                    <i class="fas fa-home"></i>
                    <a href="{{ route('dashboard') }}">Dashboard</a> > Create Counter
                </span>
            </div>

            <!-- Create Counter Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-plus-circle me-1"></i> Add New Counter</div>
                </div>
                <div class="card-body table-card-body">
                    <form method="POST"
                        action="{{ isset($counter) ? route('counters.update', $counter->id) : route('counters.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($counter))
                            @method('PUT')
                        @endif

                        <div class="row align-items-center">
                            <!-- Title -->
                            <label for="title" class="col-sm-1 col-form-label">Title</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="title" id="title"
                                    value="{{ old('title', $counter->title ?? '') }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Value -->
                            <label for="value" class="col-sm-1 col-form-label">Value</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control form-control-sm" name="value" id="value"
                                    value="{{ old('value', $counter->value ?? '') }}">
                                @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- <label for="icon" class="col-sm-1 col-form-label">Icon</label>
                            <div class="col-sm-3">
                                <div class="d-flex align-items-center">
                                    <img id="iconPreview" src="{{ isset($counter) && $counter->icon ? asset($counter->icon) : asset('uploads/no_images/no-image.png') }}"
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
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($counter) ? 'Update Counter' : 'Add Counter' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Counter List Table -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-list me-1"></i> Counter List</div>
                </div>
                <div class="card-body table-card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Value</th>
                                {{-- <th>Icon</th> --}}
                                @if (auth()->user()->type == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($counters as $key => $counter)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $counter->title }}</td>
                                    <td>{{ $counter->value }}</td>
                                    {{-- <td>
                                        @if ($counter->icon)
                                            <i class="fas {{ $counter->icon }}"></i> ({{ $counter->icon }})
                                        @else
                                            N/A
                                        @endif
                                    </td> --}}
                                    @if (auth()->user()->type == 'admin')
                                        <td class="text-center align-middle" style="vertical-align: middle;">
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height: 100%;">
                                                <form action="{{ route('counters.updateStatus', $counter->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status"
                                                        value="{{ $counter->status == 'a' ? 'd' : 'a' }}">
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $counter->status == 'a' ? 'btn-success' : 'btn-danger' }} d-flex align-items-center justify-content-center"
                                                        style="padding: 4px 12px; font-size: 12px;">
                                                        @if ($counter->status == 'a')
                                                            <i class="fas fa-check-circle me-1"></i> Active
                                                        @else
                                                            <i class="fas fa-ban me-1"></i> Deactive
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('counters.edit', $counter->id) }}" class="btn btn-edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            {{-- <form action="{{ route('counters.destroy', $counter->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete"
                                                    onclick="return confirm('Are you sure you want to delete this counter?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form> --}}
                                            <form action="{{ route('counters.destroy', $counter->id) }}" method="POST"
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
        function previewIcon(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById('iconPreview');
                imgElement.src = reader.result;
                imgElement.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }
        });
    </script>

@endsection
