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
.home_button_box{
    padding: 10px;
    text-align: center;
}
.home_button_box .number_links{
    color:white;
    text-decoration:none;
    font-family:Arial;
    font-size:.9rem;
    padding:0px 5px;
}
.home_button_box .number_links:hover{
    text-decoration:underline;
}
.homesection-orders .title{
    padding:10px 0px;
    color:white;
}
.home_button_box .orders_links{
    width:100%;
    padding:5px 0px;
    color:white;
    font-family:Arial;
    margin:2px 0px;
}
.home_button_box .orders_links:hover{
    text-decoration:none;
}
.home_button_box .orders_links .orders-content .col-left,
.home_button_box .orders_links .orders-content .col-center,
.home_button_box .orders_links .orders-content .col-right{
    display:inline-block;
    padding-right:0px;
    padding-left:0px;
}
.home_button_box .orders-content{
    display:inline-block;
    width:100%;
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
            <div class="home_button_box bg_color_1">
                <div class="title">Latest Orders [<a class="number_links" href="{{ route('admin_orders')}}">{{ $orders->count() }}</a>]</div>
                <div class="container">
                    <div class="row">
                        @foreach($orders as $order)
                        <a class="orders_links" href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">
                            <span class="orders-content">
                                <span class="col-md-6 text-left col-left">{{ $order->order_number }}</span>
                                <span class="col-md-5 text-right col-right">{{ $order->purchase_date }}</span>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 homesection-orders">
            <div class="home_button_box bg_color_2">
                <div class="title">Unshipped Orders [<a class="number_links" href="{{ route('admin_orders')}}">{{ $unshipped_orders->count() }}</a>]</div>
                <div class="container">
                    <div class="row">
                        @foreach($unshipped_orders as $unshipped_order)
                        <a class="orders_links" href="{{ route('admin_edit_order',['order_id'=>$unshipped_order->order_id])}}">
                            <span class="orders-content">
                                <span class="col-md-6 text-left col-left">{{ $unshipped_order->getOrderInfo->order_number }}</span>
                                <span class="col-md-5 text-right col-right">{{ $unshipped_order->getOrderInfo->purchase_date }}</span>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 homesection-orders">
            <div class="home_button_box bg_color_3">
                <div class="title">Product Low Stock [<a class="number_links" href="{{ route('admin_orders')}}">{{ $product_stocks->count() }}</a>]</div>
                <div class="container">
                    <div class="row">
                        @foreach($product_stocks as $product_stock)
                        <a class="orders_links" href="{{ route('edit_product',['product_id'=>$product_stock->getColor->product->id])}}">
                            <span class="orders-content">
                                <span class="col-md-4 text-left col-left">{{ $product_stock->getColor->product->products_name }}</span>
                                <span class="col-md-5 text-center col-center">{{ $product_stock->getColor->name }}</span>
                                <span class="col-md-2 text-right col-right">{{ $product_stock->stock }}</span>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row sub-main-row">
        <div class="col homesection-orders">

             <div class="home_button_box bg_color_4">
                <div class="title">Unapproved Users [<a class="number_links" href="{{ route('admin_orders')}}">{{ $unapproved_users->count() }}</a>]</div>
                <div class="container">
                    <div class="row">
                        @foreach($unapproved_users as $user)
                        <a class="orders_links" href="{{ route('admin_edituser',['user_id'=>$user->id])}}">
                            <span class="orders-content">
                                <span class="col-md-4 text-left col-left">{{ $user->first_name }} {{ $user->last_name }}</span>
                                <span class="col-md-5 text-center col-center">{{ $user->status_name }}</span>
                                <span class="col-md-2 text-right col-right">{{ $user->gender_name}}</span>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col homesection-orders">
            <div class="home_button_box bg_color_5">
                <div class="title">Latest Users [<a class="number_links" href="{{ route('admin_users')}}">{{ $last_ten_users->count() }}</a>]</div>
                <div class="container">
                    <div class="row">
                        @foreach($last_ten_users as $user)
                        <a class="orders_links" href="{{ route('admin_edituser',['user_id'=>$user->id])}}">
                            <span class="orders-content">
                                <span class="col-md-4 text-left col-left">{{ $user->first_name }} {{ $user->last_name }}</span>
                                <span class="col-md-5 text-center col-center">{{ $user->date_of_birth }}</span>
                                <span class="col-md-2 text-right col-right">{{ $user->gender_name}}</span>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div id="container_age_range"></div>
        </div>
    </div>
</div>
@endsection