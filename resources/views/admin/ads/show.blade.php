@extends('admin.index')
@section('page-content')
<div class="page-header">
<h3 class="page-title">
Ads
</h3>
<a href="{{ url('/ads/create') }}" class="btn btn-primary">Create Ads</a>
</div>
<div class="card">
<div class="card-body">
<h4 class="card-title">Ads Table</h4>
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
            <th>header</th>
            <th>Image</th>
            <th>Footer</th>
            <th>Image</th>


            <th>#</th>
            <th>#</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($ads as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td><h5>{{ $ad->HeaderName }}</h5></td>
                <td> <img src="{{ asset('storage/'.$ad->headerImg)}}"style="height: 100%;
                    border-radius: inherit; width: 100%;" alt=""></td>
                <td><h5>{{ $ad->FooterName }}</h5></td>
                <td><img src="{{ asset('storage/'.$ad->footerImg)}}"style="height: 100%;
                    border-radius: inherit; width: 100%;" alt=""></td>

                <td>
                    <a href="{{ route('ads-editing', ['id' => $ad->id]) }}"
                        class="btn btn-outline-primary">Edit</a>
                </td>
                <td>
                    <a href="{{ route('ads-deleting', ['id' => $ad->id]) }}"
                        class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>

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
