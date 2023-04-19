@extends('admin.index')

@section('page-content')
    <div class="page-header">
        <h3 class="page-title">
            Business Settings
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Update Text Info</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="form-sample" action="{{url('settings/text/update')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input name="homepage_title" type="text" class="form-control"
                                            value="{{ $data?->homepage_title }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" value="{{ $data?->email }}" name="email"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">Contact Info</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contct Info 1</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $data?->contact_info1 }}" name="contact_info1"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contct Info 2</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $data?->contact_info2 }}" name="contact_info2"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contct Info 3</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $data?->contact_info3 }}" name="contact_info3"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">Links</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $data?->facebook_url }}" name="facebook_url"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Instagram</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $data?->instagram_url }}" name="instagram_url"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Twitter</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $data?->twitter_url }}" name="twitter_url"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">Homepage Description</label>
                            <textarea type="text" id="desc" value="" name="homepage_description" class="form-control">{{ $data?->homepage_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_us">About Us</label>
                            <textarea type="text" id="about_us" name="about_us" class="form-control">{{ $data?->about_us }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="terms_and_condition">Terms And Condition</label>
                            <textarea type="text" id="terms_and_condition" value="" name="terms_and_condition" class="form-control">{{ $data?->terms_and_condition }}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endsection
