@extends('admin.index')

@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Business Settings
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Update Media Info</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="form-sample" enctype="multipart/form-data" action="{{url('settings/media/update')}}" method="post">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title d-flex">Favicon</h4>
                                        <input type="file" class="dropify" name="favicon"
                                            data-height="150" data-max-file-size="1000kb" data-default-file="{{ $data?->favicon }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title d-flex">Logo</h4>
                                        <input type="file" class="dropify" name="logo"
                                            data-height="150" data-max-file-size="1000kb" data-default-file="{{  $data?->logo }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title d-flex">Homepage Banner Image</h4>
                                        <input type="file" class="dropify" name="homepage_banner_image"
                                            data-height="150" data-max-file-size="1000kb" data-default-file="{{ $data?->homepage_banner_image}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title d-flex">Homepage Promotional Banner 1</h4>
                                        <input type="file" class="dropify" name="homepage_promotional_banner1"
                                            data-height="150" data-max-file-size="1000kb" data-default-file="{{ $data?->homepage_promotional_banner1 }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title d-flex">Homepage Promotional Banner 2</h4>
                                        <input type="file" class="dropify" name="homepage_promotional_banner2"
                                            data-height="150" data-max-file-size="1000kb" data-default-file="{{  $data?->homepage_promotional_banner2 }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endsection
