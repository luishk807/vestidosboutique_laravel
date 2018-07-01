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

    <table class="table">
        <tbody>
            <tr>
                <td class="col">
                    @foreach($orders as $order)
                    <!--product list begins-->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Order Placed</td>
                                                <td>Total</td>
                                                <td>Order #:</td>
                                            </tr>
                                            <tr>
                                                <td>{{$order->purchased_date}}</td>
                                                <td>{{$order->order_total}}<</td>
                                                <td><a href="">Order Detail</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!--list all products of order-->
                            @foreach($order->getProducts as $product)
                            <tr>
                                <td>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Delivered Today</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td><img src="{{asset('images/products')}}/{{$product->images->first()->img_url}}"/></td>
                                                                <td>
                                                                    {{ $product->products_name}}<br/>
                                                                    {{ $product->product_model}}<br/>
                                                                    {{ $product->vendor}}<br/>
                                                                    {{ $product->product_total}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                
                                                </td>
                                                <td><a href="">Write Review</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                            <!--end list of product of orders-->
                        </tbody>
                    </table>
                    @endforeach
                    <!--product list ends-->
                </td>
            </tr>
        </tbody>
    </table>

    </div>
</div><!--end of main container-->
@endsection