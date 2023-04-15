@extends('admin.index')

@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Genre
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Genre</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Genre</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample" action="{{ route('genre-inserting') }}" method="post">
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
                            <label>Category</label>
                            <select class="js-example-basic-single w-100" id="category" name="category"></select>
                        </div>
                        <div class="form-group">
                            <label>Subcategory</label>
                            <select class="js-example-basic-single w-100" id="subcategory" name="subcategory"></select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input name="name" type="text" class="form-control" id="exampleInputUsername1"
                                placeholder="Genre name">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea name="description" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        categoryDom = document.querySelector("#category");
        categoryDom.innerHTML = `<option value="">Select Category</option>`;
        subcategoryDom = document.querySelector("#subcategory");
        subcategoryDom.innerHTML = `<option value="">Select Subcategory</option>`

        categories = [];
        fetch("/category-for-content")
            .then(x => x.json())
            .then(data => {
                categories = data;
                categories.map(category => {
                    categoryDom.innerHTML += `<option value="${category.id}">${category.name}</option>`;
                })
            });

        categoryDom.onchange = function (){
            var selectedOption = this.options[this.selectedIndex];
            var value = selectedOption.value;
            subcategoryDom.innerHTML = `<option value="">Select Subcategory</option>`
            if(value){
                categories.find(category => category.id == value).subcats.map(subcat => subcategoryDom.innerHTML+= `<option value="${subcat.id}">${subcat.name}</option>`)
            }
        }
    </script>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
