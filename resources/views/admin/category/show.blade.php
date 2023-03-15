@extends('admin.index')
@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Category
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Category Table</h4>
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
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <a href="{{ route('category-editing', ['id' => $category->id]) }}"
                                                class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('category-deleting', ['id' => $category->id]) }}"
                                                class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td>
                                        @if ($categories->currentPage() != 0 && $categories->previousPageUrl())
                                            <a href="{{ $categories->previousPageUrl() }}"
                                                class="btn btn-primary">Previous</a>
                                        @endif
                                        @if ($categories->hasMorePages())
                                            <a href="{{ $categories->nextPageUrl() }}" class="btn btn-primary">Next</a>
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
