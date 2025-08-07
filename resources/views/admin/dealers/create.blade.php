@extends('admin.layouts.master')

@section('title', 'Create Dealer')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> >
                    Create Dealer</span>
            </div>

            <!-- Create Dealer Form -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-user-plus me-1"></i> Add New Dealer</div>
                    <a href="{{ route('dealer.index') }}" class="btn btn-addnew">
                        <i class="fa fa-file-alt"></i> View All
                    </a>
                </div>
                <div class="card-body table-card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('dealer.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group row mt-2">
                                    <!-- Organization Name -->
                                    <label for="org_name" class="col-sm-1 col-form-label">Org. Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="org_name"
                                            name="org_name" value="{{ old('org_name') }}" required>
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
                                                    {{ old('area_id') == $area->id ? 'selected' : '' }}>
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
                                            name="owner_name" value="{{ old('owner_name') }}">
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
                                            name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <label for="address" class="col-sm-1 col-form-label">Address</label>
                                    <div class="col-sm-3">
                                        <textarea class="form-control form-control-sm" id="address" name="address" rows="2">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-primary">Add Dealer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Dealer List Table -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-list me-1"></i> Dealer List</div>
                </div>
                <div class="card-body table-card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Sl</th>
                                <th>Organization</th>
                                <th>Area</th>
                                <th>Owner</th>
                                <th>Phone</th>
                                <th>Address</th>
                                @if (auth()->user()->type == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dealers as $key => $dealer)
                                <tr class="text-center">
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="text-center align-middle">{{ $dealer->org_name }}</td>
                                    <td class="text-center align-middle">{{ $dealer->area ? $dealer->area->name : 'N/A' }}
                                    </td>
                                    <td class="text-center align-middle">{{ $dealer->owner_name ?? '-' }}</td>
                                    <td class="text-center align-middle">{{ $dealer->phone ?? '-' }}</td>
                                    <td class="text-center align-middle">{{ $dealer->address ?? '-' }}</td>

                                    @if (auth()->user()->type == 'admin')
                                        <td class="text-center align-middle" style="vertical-align: middle;">
                                            <form action="{{ route('dealer.updateStatus', $dealer->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"
                                                    value="{{ $dealer->status == 'a' ? 'd' : 'a' }}">
                                                <button type="submit"
                                                    class="btn btn-sm {{ $dealer->status == 'a' ? 'btn-success' : 'btn-danger' }}">
                                                    @if ($dealer->status == 'a')
                                                        <i class="fas fa-check-circle me-1"></i> Active
                                                    @else
                                                        <i class="fas fa-ban me-1"></i> Deactive
                                                    @endif
                                                </button>
                                            </form>
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="{{ route('dealer.edit', $dealer->id) }}" class="btn btn-edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('dealer.destroy', $dealer->id) }}" method="POST"
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
@endsection
