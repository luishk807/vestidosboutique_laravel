@extends('admin/layouts.app')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(function () {
        var $order_year = <?php echo $order_year; ?>;
        $('#container_year').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Yearly Orders'
            },
            // xAxis: {
            //     categories: ['Jan','Feb']
            // },
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
                text: 'Weekly Orders'
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

        var $order_week = <?php echo $order_week; ?>;
        $('#container_week').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Weekly Orders'
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
            series: [{
                name: 'Name',
                colorByPoint: true,
                data: popular_dresses
            }]
        });
        

        var range_ages = <?php echo $age_ranges[0]; ?>;
        var range_titles = <?php echo $age_ranges[1]; ?>;
        Highcharts.chart('container_age_range', {
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
            series: [{
                name: 'Name',
                colorByPoint: true,
                data: range_ages
            }]
        });

    });
</script>
<div class="container">
    <div class="row">
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
    <div class="row">
        <div class="col-md-4">
            <div class="homesection-orders">
                <div class="text-center pv-4">Latest Orders</div>
                <ul>
                @foreach($orders as $order)
                    <li>
                        <a href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">
                            {{ $order->order_number }}{{ $order->order_total }}
                            {{ $order->purchase_date }} {{ $order->getStatusName->name }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div><!--end of nav container-->
        </div>
        <div class="col">
            <div class="text-center pv-4">Orders Unshipped</div>
            <ul>
            @foreach($unshipped_orders as $unshipped_order)
                <li>
                    <a href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">
                        {{ $unshipped_order->getOrderInfo->order_number }}{{ $unshipped_order->total }}
                        {{ $unshipped_order->getOrderInfo->purchase_date }} {{ $unshipped_order->getStatusName->name }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="col">
            <div class="text-center pv-4">Product Low Stock</div>
            <ul>
            @foreach($product_stocks as $product_stock)
                <li>
                    <a href="{{ route('edit_product',['product_id'=>$product_stock->getColor->product->id])}}">
                        {{ $product_stock->getColor->product->products_name }}
                        {{ $product_stock->stock }}
                        {{ $product_stock->getStatusName->name }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="text-center pv-4">Unapproved Users</div>
            <ul>
            @foreach($users as $user)
                <li>
                    <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">
                        {{ $user->first_name }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="col">
            <div class="text-center pv-4">Latest Users</div>
            <ul>
            @foreach($users as $user)
                <li>
                    <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">
                        {{ $user->first_name }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="col">
            <div class="text-center pv-4">Age Estimate</div>
            <div id="container_age_range"></div>
        </div>
    </div>
</div>
@endsection