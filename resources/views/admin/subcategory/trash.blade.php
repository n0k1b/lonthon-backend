@extends('admin.index')
@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Subcategory
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Subcategory</a></li>
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Subcategory Trashed Table</h4>
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
                                    {{-- <th>#</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->id }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->description }}</td>
                                        <td>
                                            <a href="{{ route('subcategory-restore', ['id' => $subcategory->id]) }}"
                                                class="btn btn-outline-primary">Restore</a>
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('subcategory-forced', ['id' => $subcategory->id]) }}"
                                                class="btn btn-outline-danger">Force Delete</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        @if ($subcategories->currentPage() != 0 && $subcategories->previousPageUrl())
                                            <a href="{{ $subcategories->previousPageUrl() }}"
                                                class="btn btn-primary">Previous</a>
                                        @endif
                                        @if ($subcategories->hasMorePages())
                                            <a href="{{ $subcategories->nextPageUrl() }}" class="btn btn-primary">Next</a>
                                        @endif
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
