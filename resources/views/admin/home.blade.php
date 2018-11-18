@extends('admin/layouts.app')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(function () {
        var $order_data = <?php echo $order_data; ?>;
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Yearly Orders'
        },
        xAxis: {
            categories: ['Jan','Feb']
        },
        yAxis: {
            title: {
                text: 'Orders'
            }
        },
        series: [{
            name: 'Orders',
            data: $order_data
        }]
    });
});
</script>
<div class="container">
    <div class="row">
        <div class="col">
            <div id="container">
            fff
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="homesection-orders">
                <ul>
                @foreach($orders as $order)
                    <li>{{ $order->order_total }}</li>
                @endforeach
                </ul>
            </div><!--end of nav container-->
        </div>
        <div class="col">
            something 2
        </div>
        <div class="col">
            something 3
        </div>
    </div>
</div>
@endsection