@extends('admin.index')

@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Subcategory
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Subcategory</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Subcategory</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample" action="{{ route('subcategory-updating',["id"=>$subcategory->id]) }}" method="post">
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
                            <label for="exampleInputUsername1">Name</label>
                            <input name="name" type="text" class="form-control" id="exampleInputUsername1"
                                placeholder="Category name" value="{{$subcategory->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea name="description" class="form-control" id="exampleTextarea1" rows="4">{{$subcategory->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
