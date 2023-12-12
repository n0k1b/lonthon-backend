@extends('admin.index')
@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            USER
        </h3>
        {{-- <a href="{{ url('/show') }}" class="btn btn-primary">Create Ads</a> --}}
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">User Table</h4>
            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>role</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>



                                </tr>
                            </thead>
                            <tbody>
                           @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>

                                     {{-- <td>
                                            <a href="{{ route('ads-editing', ['id' => $ad->id]) }}"
                                                class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('ads-deleting', ['id' => $ad->id]) }}"
                                                class="btn btn-outline-danger">Delete</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    {{-- <td>
                                        @if ($categories->currentPage() != 0 && $categories->previousPageUrl())
                                            <a href="{{ $categories->previousPageUrl() }}"
                                                class="btn btn-primary">Previous</a>
                                        @endif
                                        @if ($categories->hasMorePages())
                                            <a href="{{ $categories->nextPageUrl() }}" class="btn btn-primary">Next</a>
                                        @endif --}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endsection
