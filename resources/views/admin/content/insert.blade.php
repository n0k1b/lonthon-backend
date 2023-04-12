@extends('admin.index')

@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Content
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Content</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Content</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample" action="{{ route('content-inserting') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        {{-- <p>{{$categories}}</p> --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input name="title" type="text" class="form-control" id="Title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="js-example-basic-single w-100" id="category" name="category"></select>
                        </div>
                        <div class="form-group">
                            <label>Subcategory</label>
                            <select class="js-example-basic-single w-100" id="subcategory" name="subcategory"></select>
                        </div>
                        <div class="form-group">
                            <label>Genre</label>
                            <select class="js-example-basic-single w-100" id="genre" name="genre"></select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input name="price" type="number" class="form-control" id="price" placeholder="Price">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="type" class="checkbox" type="checkbox">
                                Paid
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="statues" class="checkbox" type="checkbox">
                                Status
                            </label>
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleTextarea1">Summary</label>
                            <textarea name="summary" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch("category-for-content")
        .then(x => x.json())
        .then(y => {
            console.log(y);
            document.querySelector("#category").innerHTML += "<option value=''>Select category</option>"
            for (const key in y) {
                if (Object.hasOwnProperty.call(y, key)) {
                    const element = y[key];
                    document.querySelector("#category").innerHTML += "<option value=" + element.id + ">" + element.name + "</option>"
                }
            }
        });
        fetch("subcategory-for-content")
        .then(x => x.json())
            .then(y => {
                document.querySelector("#subcategory").innerHTML += "<option value=''>Select subcategory</option>"
                for (const key in y) {
                    if (Object.hasOwnProperty.call(y, key)) {
                        const element = y[key];
                        document.querySelector("#subcategory").innerHTML += "<option value=" + element.id + ">" + element.name + "</option>"
                    }
                }
            });
        fetch("genre-for-content")
            .then(x => x.json())
            .then(y => {
                document.querySelector("#genre").innerHTML += "<option value=''>Select genre</option>"
                for (const key in y) {
                    if (Object.hasOwnProperty.call(y, key)) {
                        const element = y[key];
                        document.querySelector("#genre").innerHTML += "<option value=" + element.id + ">" + element.name + "</option>"
                    }
                }
            });
    </script>
@endsection

@section('page-js')
    {{-- <script src="{{ asset('assets/js/file-upload.js') }}"></script> --}}
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
