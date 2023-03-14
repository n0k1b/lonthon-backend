@extends('admin.index')
@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Genre
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Genre</a></li>
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Genre Table</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($genres as $genre)
                                    <tr>
                                        <td>{{ $genre->id }}</td>
                                        <td>{{ $genre->name }}</td>
                                        <td>{{ $genre->description }}</td>
                                        <td>
                                            <a href="{{ route('genre-editing', ['id' => $genre->id]) }}"
                                                class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('genre-deleting', ['id' => $genre->id]) }}"
                                                class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td>
                                        @if ($genres->currentPage() != 0 && $genres->previousPageUrl())
                                            <a href="{{ $genres->previousPageUrl() }}"
                                                class="btn btn-primary">Previous</a>
                                        @endif
                                        @if ($genres->hasMorePages())
                                            <a href="{{ $genres->nextPageUrl() }}" class="btn btn-primary">Next</a>
                                        @endif
                                    </td>
                                </tr>
                            </tfoot> --}}
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