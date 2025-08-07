@extends('admin.layouts.master')

@section('title', 'User List')

@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i>
                    <a href="{{ route('dashboard') }}">Dashboard</a> > User List
                </span>
            </div>

            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head">
                        <i class="fas fa-users me-1"></i> User List
                    </div>
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ route('users.create') }}" class="btn btn-addnew">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                    @endif
                </div>

                <div class="card-body table-card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>User Type</th>
                                @if (auth()->user()->type == 'admin')
                                    <th>Status</th>
                                @endif
                                @if (auth()->user()->type == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($user->image)
                                            <img src="{{ asset($user->image) }}" alt="User Image"
                                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; margin-left: 11px;">
                                        @else
                                            <img src="{{ asset('uploads/no_images/no-image.png') }}" alt="User Image"
                                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; margin-left: 11px;">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ ucfirst($user->type) }}</td>
                                    @if (auth()->user()->type == 'admin')
                                        {{-- <td>
                                            <form action="{{ route('users.updateStatus', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm"
                                                    onchange="this.form.submit()">
                                                    <option value="a" {{ $user->status == 'a' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="p" {{ $user->status == 'p' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="d" {{ $user->status == 'd' ? 'selected' : '' }}>
                                                        Deactivated
                                                    </option>
                                                </select>
                                            </form>
                                        </td> --}}
                                        <td class="text-center">
                                            <form action="{{ route('users.updateStatus', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"
                                                    value="{{ $user->status == 'a' ? 'p' : ($user->status == 'p' ? 'd' : 'a') }}">

                                                <button type="submit"
                                                    class="btn btn-sm 
                                                    {{ $user->status == 'a' ? 'btn-success' : ($user->status == 'p' ? 'btn-warning' : 'btn-danger') }}"
                                                    style="padding: 2px 10px; font-size: 12px; display: flex; align-items: center; gap: 5px; margin-top: 7px;">

                                                    @if ($user->status == 'a')
                                                        <i class="fas fa-check-circle"></i> Active
                                                    @elseif ($user->status == 'p')
                                                        <i class="fas fa-clock"></i> Pending
                                                    @else
                                                        <i class="fas fa-ban"></i> Deactivated
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                    @if (auth()->user()->type == 'admin')
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit"
                                                style="margin-top: 10px;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete" style="margin-top: 10px;"
                                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form> --}}
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-delete show-confirm"
                                                    style="margin-top: 10px;">
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
