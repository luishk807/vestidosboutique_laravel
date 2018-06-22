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
                            <a href="{{ route('admin_users')}}">Users</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_colors')}}">Colors</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_products')}}">Products</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin_orders')}}">Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection