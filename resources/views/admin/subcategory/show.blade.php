@extends('admin.index')
@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Subcategory
        </h3>
        <a href="{{url('create-sub')}}" class="btn btn-primary">Create</a>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Subcategory Table</h4>
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
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->subcategory->id }}</td>
                                        <td>{{ $subcategory->category->name }}</td>
                                        <td>{{ $subcategory->subCategory->name }}</td>
                                        <td>{{ $subcategory->subCategory->description }}</td>
                                        <td>
                                            <a href="{{ route('subcategory-editing', ['id' => $subcategory->subcategory->id]) }}"
                                                class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('subcategory-deleting', ['id' => $subcategory->subcategory->id]) }}"
                                                class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
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
