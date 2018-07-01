@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <P>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="container account-container">


<form action="{{ route('updateorder',['order_id'=>$order_id]) }}" method="post">

    <table class="table">
        <tbody>
                <tr>
                    <th scope="row">Order Detail/th>
                    <td></td>
                </tr>
                <tr>
                    <td><span>Ordered Date: {{ $order->purchased Date }}</span> <span>Order# {{ $order->order_number }}</span></td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col">Shipped Address</th>
                                    <th class="col"></th>
                                    <th class="col">Order Summary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{$order->getAddress->getFullName()}}<br/>
                                        {{$order->getAddress->address_1}} {{$order->getAddress->address_2}}<br/>
                                        {{$order->getAddress->phone_number_1}}<br/>
                                        {{$order->getAddress->phone_number_2}}<br/>
                                        {{$order->getAddress->email}}<br/>
                                        {{$order->getAddress->city}} {{$order->getAddress->state}} {{$order->getAddress->getCountry->countryName}} {{$order->getAddress->zip_code}}<br/>
                                    </td>
                                    <td></td>
                                    <td>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Item(s) Subtotal</td>
                                                    <td>${{$order->order_quantity * $order->order_total}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Handling</td>
                                                    <td>${{$order->order_shipping}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Before Tax</td>
                                                    <td>${{($order->order_quantity * $order->order_total) + $order->order_shipping}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Estimated Tax to be collected</td>
                                                    <td>${{$order->order_tax}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Grand Total</td>
                                                    <th scope="row">${{($order->order_quantity * $order->order_total) + $order->order_shipping + $order->order_tax}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right"></td>
                </tr>
        </tbody>
    </table>


    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('confirmorders',['order_id'=>$order->id])}}" class="btn-block vesti_in_btn">Delete Order</a>
            </div>
        </div>
    </div>

</form>

    </div>
</div><!--end of main container-->
@endsection