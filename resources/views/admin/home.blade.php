@extends('admin/layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>First Content</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_brands')}}">Brands</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_colors')}}">Colors</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_closures')}}">Closures</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_dresstypes')}}">Dress Types</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_dressstyles')}}">Dress Styles</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_fits')}}">Dress Fit Types</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_category')}}">Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection