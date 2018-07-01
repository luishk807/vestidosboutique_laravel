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

        <form action="{{ route('deleteorder',['order_id'=>$order->id])}}" method="post">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    are you sure want to delete order {{ $order->order_number }}
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <input type="submit" class="btn-block vesti_in_btn" value="Delete Oder"/>
                </div>
            </div>
        </div>
        </form>

    </div>
</div><!--end of main container-->
@endsection