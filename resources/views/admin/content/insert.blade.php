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
                    <form class="forms-sample" action="{{ route('content-inserting') }}" enctype="multipart/form-data"
                        method="post">
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
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input name="title" type="text" class="form-control" id="Title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="js-example-basic-single w-100" id="category" name="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
                            <input name="price" type="number" class="form-control" id="price" placeholder="Price" value="0">
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
        categoryDom = document.querySelector("#category");
        subcategoryDom = document.querySelector("#subcategory");
        genreDom = document.querySelector("#genre");
        subcategoryDom.innerHTML = `<option value="">Select Subcategory</option>`
        genreDom.innerHTML = `<option value="">Select Genre</option>`
        subcats = [];
        categoryDom.onchange = function() {
            var value = this.options[this.selectedIndex].value;
            subcategoryDom.innerHTML = `<option value="">Select Subcategory</option>`
            if (value) {
                subcats = @json($categories).find(category => category.id == value).maps
                subcats.map(subcat => subcategoryDom.innerHTML += `<option value="${subcat.sub_category.id}">${subcat.sub_category.name}</option>`)
            }
        }

        subcategoryDom.onchange = function() {
            var value = this.options[this.selectedIndex].value;
            genreDom.innerHTML = `<option value="">Select Genre</option>`
            if (value) {
                console.log(value);
                console.log(subcats);
                console.log(subcats.find(subcat => subcat.subcategory_id==value).sub_category.maps);
                genres = subcats.find(subcat => subcat.subcategory_id==value).sub_category.maps
                genres.map(el => genreDom.innerHTML+= `<option value="${el.genre.id}">${el.genre.name}</option>`)
            }
        }
    </script>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
