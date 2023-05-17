@extends('app')

@section('content')
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img
                        src="{{ asset('storage/settings/logo.png') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img
                        src="{{ asset('storage/settings/logo.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="fas fa-bars"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="fas fa-bars"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="fa fa-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#settings-layouts" aria-expanded="false"
                            aria-controls="settings-layouts">
                            <i class="fab fa-trello menu-icon"></i>
                            <span class="menu-title">Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="settings-layouts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('settings/text') }}">Text
                                        Settings</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('settings/media') }}">Media
                                        Settings</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#category-layouts" aria-expanded="false"
                            aria-controls="category-layouts">
                            <i class="fab fa-trello menu-icon"></i>
                            <span class="menu-title">Categories</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="category-layouts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('category') }}">All
                                        Categories</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('category/create') }}">Create
                                        Categories</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{url('category/trash')}}">Trash Categories</a></li> --}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#subcategory-layouts" aria-expanded="false"
                            aria-controls="subcategory-layouts">
                            <i class="fab fa-trello menu-icon"></i>
                            <span class="menu-title">Subcategories</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="subcategory-layouts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('subcategory') }}">All
                                        Subcategories</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('create-sub') }}">Create
                                        Subcategories</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{url('subcategory/trash')}}">Trash Subcategories</a></li> --}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#genre-layouts" aria-expanded="false"
                            aria-controls="genre-layouts">
                            <i class="fab fa-trello menu-icon"></i>
                            <span class="menu-title">Genre</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="genre-layouts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('genres') }}">View Genre</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('create-gen') }}">Create
                                        Genre</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{url('subcategory/trash')}}">Trash Subcategories</a></li> --}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#content-layouts" aria-expanded="false"
                            aria-controls="content-layouts">
                            <i class="fab fa-trello menu-icon"></i>
                            <span class="menu-title">Content</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="content-layouts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('content') }}">View Contents</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('create-cont') }}">Create
                                        Content</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{url('subcategory/trash')}}">Trash Subcategories</a></li> --}}
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('page-content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a
                                href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                            <i class="far fa-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

{{-- @section('page-js')
@endsection --}}
