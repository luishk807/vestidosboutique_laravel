@extends("layouts.sub-layout")
@section('content')
<style>
.product_in{
  padding:50px 0px;
  margin: 100px auto 50px auto;
}
.product_thumnnail img{
    width:150px;
}
.product_main_img img{
    width:100%;
}
.product_thumnnail,
.product_main_img{

}
.product_main_txt{

}
</style>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="container-fluid product_in">
                <div class="row">
                    <div class="col-md-2 product_thumnnail">
                        <div class="thumbnail">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt /></a>
                        </div>
                        <div class="thumbnail">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt /></a>
                        </div>
                        <div class="thumbnail">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt /></a>
                        </div>
                    </div>
                    <div class="col-md-6 product_main_img">
                        <div class="product_main_img_in">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt /></a>
                        </div>
                    </div>
                    <div class="col-md-4 product_main_txt">
                        <div>
                            <div class="product_in">
                                    <h2>Our Story</h2>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection