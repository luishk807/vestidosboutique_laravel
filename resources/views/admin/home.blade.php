@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @foreach($orders as $order)
            {{$order->order_number}}
            @endforeach
        </div>
        <div class="col">
            @foreach($products as $product)
            {{$product->products_name}}
            @endforeach
        </div>
        <div class="col">
            @foreach($restocks as $restock)
            {{$restock->restock_date}}
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col">
            @foreach($users as $user)
                {{$user->first_name}}
            @endforeach
        </div>
        <div class="col">
            @foreach($rates as $rate)
                {{$rate->getUser->first_name}}
            @endforeach
        </div>
    </div>
</div>
@endsection