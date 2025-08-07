@extends('admin.layouts.master')

@section('title', 'All Dealers')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> >
                    All Dealers</span>
            </div>


            <!-- Dealer List Table -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-list me-1"></i> Dealer List</div>
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ route('dealer.create') }}" class="btn btn-addnew">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                    @endif
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
