@extends('admin/layouts.app')
@section('content')
<script type="text/javascript" src="{{ asset('js/vendor/highchart/highcharts.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var $order_year = <?php echo $order_year; ?>;
        $('#container_year').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'This Year Orders'
            },
            xAxis: {
                categories: ['Jan','Feb','Mar','Abr','May','Jun',"Jul","Aug",'Sep','Oct','Nov','Dec']
            },
            yAxis: {
                title: {
                    text: 'Orders'
                }
            },
            series: [{
                name: 'Orders',
                data: $order_year
            }]
        });

        var $order_week = <?php echo $order_week; ?>;
        $('#container_week').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'This Week Order'
            },
            xAxis: {
                categories: ['Mon','Tue','Wed','Thr','Fri','Sat','Sun']
            },
            yAxis: {
                title: {
                    text: 'Orders'
                }
            },
            series: [{
                name: 'Orders',
                data: $order_week
            }]
        });


        var popular_dresses = <?php echo $popular_dresses; ?>;
        Highcharts.chart('container_popular', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Popular Dresses'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [
            {
                name: 'Name',
                colorByPoint: true,
                data: popular_dresses
            }
            ]
        });
        

        var range_ages = <?php echo $age_ranges; ?>;
        Highcharts.chart('container_age_range', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Age Range'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Age",
                colorByPoint: true,
                data: range_ages
            }]
        });

    });
</script>
<style>
.sub-main-row{
    margin-top:20px;
}
.sub-main-row .home-title{
    text-align: center;
    text-decoration:underline;
}
.homesection-orders li,
.homesection-products li{
    margin:10px;

}
.homesection-orders li a,
.homesection-products li a{
    text-align:center;
    text-decoration:none;
    color:black;
}
.homesection-orders li a:hover,
.homesection-products li a:hover{
    text-decoration:underline;
}
.homesection-orders li a .orders-content,
.homesection-products li a .products-content{
    display: inline-block;
    text-align: center;
    vertical-align: top;
}
.homesection-orders li a .orders-content >.title{
    padding-right:5px;

}
.homesection-orders li a .orders-content span,
.homesection-products li a .products-content span{
    font-weight:bold;
}

.home_button_box{
    background-color:#1b96f0;
    padding: 10px;
    text-align: center;
}
.home_button_box ul{
    list-style-type: none;
    margin:0px;
    padding:0px;
}
.home_button_box ul a span{
    display:inline-block;
}
.home_button_box ul a .orders-content span:first-child{
    background-color:red;
}
.homesection-orders .title{
    padding:10px 0px;
    color:white;
}
.home_button_box .orders_links{
    width:100%;
    padding:5px 0px;
    color:white;
    background-color:#1377cc;
    font-family:Arial;
    margin:2px 0px;
}
.home_button_box .orders_links:hover{
    text-decoration:none;
    background-color:#0f5f99;
}
.home_button_box .orders_links .title,
.home_button_box .orders_links .pdate{
    
}
</style>
<div class="container">
    <div class="row sub-main-row">
        <div class="col">
            <div id="container_year"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div id="container_popular"></div>
        </div>
        <div class="col-md-7">
            <div id="container_week"></div>
        </div>
    </div>
    <div class="row sub-main-row">
        <div class="col-md-4 homesection-orders">
            <div class="text-center pv-4 home-title">Latest Orders</div>
            <ol>
            @foreach($orders as $order)
                <li>
                    <a href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">
                        <span class="orders-content">
                            <span class="title">{{ $order->order_number }}</span>
                            Total: <span class="total">${{ $order->order_total }}</span><br/>
                            Status: <span class="status">{{ $order->getStatusName->name }}</span><br/>
                            Order Date: <span class="pdate">{{ $order->purchase_date }}</span>
                        </span>
                    </a>
                </li>
            @endforeach
            </ol>
        </div>
        <div class="col-md-4 homesection-orders">
            <div class="home_button_box">
                <div class="title">Unshipped Orders [2]</div>
                <div class="container">
                    <div class="row">
                        @foreach($unshipped_orders as $unshipped_order)
                        <a class="orders_links" href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">
                            <span class="orders-content">
                                <span class="col-md-8 text-left"  class="title">{{ $unshipped_order->getOrderInfo->order_number }}</span>
                                <span class="col-md-4 text-right"  class="pdate">{{ $unshipped_order->getOrderInfo->purchase_date }}</span>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 homesection-products">
            <div class="text-center pv-4 home-title">Product Low Stock</div>
            <ol>
            @foreach($product_stocks as $product_stock)
                <li>
                    <a href="{{ route('edit_product',['product_id'=>$product_stock->getColor->product->id])}}">
                        <span class="products-content">
                            Name:<span class="name">{{ $product_stock->getColor->product->products_name }}</span><br/>
                            Stock: <span class="stock">{{ $product_stock->stock }}</span>
                            Size: <span class="color">{{ $product_stock->name }}</span><br/>
                            Size: <span class="color">{{ $product_stock->getColor->name }}</span>
                            Status:<span class="status">{{ $product_stock->getStatusName->name }}</span>
                        </span>
                    </a>
                </li>
            @endforeach
            </ol>
        </div>
    </div>
    <div class="row sub-main-row">
        <div class="col">
            <div class="text-center pv-4 home-title">Unapproved Users</div>
            <ol>
            @foreach($unapproved_users as $user)
                <li>
                    <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">
                        {{ $user->first_name }} {{ $user->last_name }}
                        {{ $user->status_name }}
                        {{ $user->gender_name}}
                    </a>
                </li>
            @endforeach
            </ol>
        </div>
        <div class="col">
            <div class="text-center pv-4 home-title">Latest Users</div>
            <ol>
            @foreach($last_ten_users as $user)
                <li>
                    <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">
                        {{ $user->first_name }} {{ $user->last_name }} {{ $user->date_of_birth }} {{ $user->gender_name}}
                    </a>
                </li>
            @endforeach
            </ol>
        </div>
        <div class="col">
            <div id="container_age_range"></div>
        </div>
    </div>
</div>
@endsection