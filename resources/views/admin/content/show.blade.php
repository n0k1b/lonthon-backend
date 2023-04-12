@extends('admin.index')
@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Content
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Contents</a></li>
                <li class="breadcrumb-item active" aria-current="page">All</li>
            </ol>
        </nav>
    </div>
    <div class="card-columns">
        @foreach ($contents as $content)
            <div class="card">
                <img class="card-img-top" src="{{ asset('storage/' . $content->feature_image) }}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{ $content->title }}</h4>
                    <p class="card-text">Type : {{ $content->type ? 'Paid' : 'Free' }}</p>
                    @if ($content->type)
                        <p class="card-text">Price : {{ $content->price }}Tk</p>
                    @endif
                    <p class="card-text">Category : {{ $content->map->category?->name }}</p>
                    <p class="card-text">Subcategory : {{ $content->map->subcategory?->name }}</p>
                    <p class="card-text">Genre : {{ $content->map->genre?->name }}</p>
                    <p class="card-text">{{ $content->summary }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('content-deleting', ['id' => $content->id]) }}"
                        class="btn btn-outline-danger">Delete</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endsection
