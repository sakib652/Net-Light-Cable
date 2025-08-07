@extends('admin.layouts.master')

@section('title', 'Brand List')

@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i>
                    <a href="{{ route('dashboard') }}">Dashboard</a> > Brand List
                </span>
            </div>

            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-list me-1"></i>Brand List</div>
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ route('client.create') }}" class="btn btn-addnew">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                    @endif
                </div>
                <div class="card-body table-card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Sl</th>
                                <th>Brand Logo</th>
                                <th>Brand Name</th>
                                @if (auth()->user()->type == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $key => $client)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $client->image ? asset($client->image) : asset('uploads/no_images/no-image.png') }}"
                                            alt="Client Logo" width="50">
                                    </td>
                                    <td>{{ $client->name }}</td>
                                    @if (auth()->user()->type == 'admin')
                                        <td class="text-center">
                                            <form action="{{ route('client.updateStatus', $client->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"
                                                    value="{{ $client->status == 'a' ? 'd' : 'a' }}">
                                                <button type="submit"
                                                    class="btn btn-sm {{ $client->status == 'a' ? 'btn-success' : 'btn-danger' }}"
                                                    style="padding: 2px 10px; font-size: 12px; align-items: center; gap: 5px;">
                                                    @if ($client->status == 'a')
                                                        <i class="fas fa-check-circle"></i> Active
                                                    @elseif ($client->status == 'd')
                                                        <i class="fas fa-ban"></i> Deactive
                                                    @endif
                                                </button>
                                            </form>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('client.edit', $client->id) }}" class="btn btn-edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            {{-- <form action="{{ route('client.destroy', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete"
                                                    onclick="return confirm('Are you sure you want to delete this client?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form> --}}
                                            <form action="{{ route('client.destroy', $client->id) }}" method="POST"
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
