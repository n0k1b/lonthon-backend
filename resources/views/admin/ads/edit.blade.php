@extends('admin.index')

@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
           Ads
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Ads</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Ads</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample" action="{{ route('ads-updating',["id"=>$ads->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class= "row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Header Name</label>
                                    <input name="headername" value="{{$ads->HeaderName}}" type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Header Banner</label>
                                    <input name="headerimg" type="file" class="form-control" id="exampleInputUsername1"
                                    placeholder="">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/'.$ads->headerImg)}}"style="height: 100%;
                                border-radius: inherit; width: 100%; padding:5px;" alt="">
                            </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="exampleInputUsername1">Footer Name</label>
                                  <input name="footername" type="text" class="form-control" id="exampleInputUsername1"
                                  value="{{$ads->FooterName}}"   placeholder="">
                              </div>
                          </div>
                          <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">footer Banner</label>
                                    <input name="footerimg" type="file" class="form-control" id="exampleInputUsername1"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/'.$ads->footerImg)}}"style="height: 100%;
                                border-radius: inherit; width: 100%; padding:5px;" alt="">
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                            </div>
                        </div>




                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
