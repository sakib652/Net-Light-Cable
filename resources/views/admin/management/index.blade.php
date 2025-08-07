@extends('admin.layouts.master')

@section('title', 'All Members')
@section('main-content')
    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading"><i class="fas fa-home"></i> <a href="{{ route('dashboard') }}">Dashboard</a> >
                    All Members</span>
            </div>

            <!-- Management List Table -->
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-list me-1"></i>Management List</div>
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ route('management.create') }}" class="btn btn-addnew">
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
