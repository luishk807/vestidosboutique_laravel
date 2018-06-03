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
    display:table;
}
.product_in_txt{
    display:table-cell;
    text-align:left;
}
.product_in_title{
    font-weight:700 !important;
    font-size:1.5rem;
    padding-bottom: 0px !important;
}
.product_in_vendor{
    font-weight: 700;
    font-family: "Playfair Display";
    font-style: italic;
}
.product_in_detail{
    font-size: 1.1rem;
    line-height: 1.4;
    padding: 10px 0px;
}
.product_in_price{
    font-family: Arial;
    font-weight: bold;
    font-size: 2rem;
}
.product_in_sub_title{
    font-family: "Playfair Display";
    font-style: italic;
    font-size: 1.1rem;
}
.product_in_colors,
.product_in_size{
    margin-bottom: 10px;
}
.colors_cubes{
    width: 33px;
    height: 20px;
    display: inline-block;
    border-radius: 4px;
    margin:2px 2px 2px 0px;
    border:1px rgba(0,0,0,.2) solid;
    cursor: pointer;
}
.size_spheres{
    width: 33px;
    height: 33px;
    display: inline-block;
    border-radius: 18px;
    margin: 2px 2px 2px 0px;
    border: 1px rgba(0,0,0,.2) solid;
    cursor: pointer;
    font-family:"Arial";
    font-size: .8rem;
}
.product_in_btn_pnl{
    margin:25px 0px;
}
.product_in_btn{
    background-color: #df1174;
    color: white;
    border: 0px;
    padding: 10px 100px;
    font-family: "playfair display";
    text-align:center;
    font-style: italic;
    cursor:pointer;
    font-size:1rem;
}
</style>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="container-fluid product_in">
                <div class="row">
                    <div class="col-md-2 product_thumnnail">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="thumbnail"/></a>
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="thumbnail" /></a>
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="thumbnail" /></a>
                    </div>
                    <div class="col-md-6 product_main_img">
                        <div class="product_main_img_in">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt /></a>
                        </div>
                    </div>
                    <div class="col-md-4 product_main_txt">
                        <div>
                            <div class="product_in_txt">
                                    <h2 class="product_in_title">Long Organaza Sweetheart Mori Lee Quinceanera Dress</h2>
                                    <div class="product_in_vendor">By Joanna</div>
                                    <div class="product_in_rate">
                                    </div>
                                    <div class="product_in_detail crimson-txt">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris iaculis elementum lacus ac condimentum. In eget tincidunt sem. Morbi aliquam justo at posuere lobortis. Sed id ex euismod, scelerisque tortor imperdiet, pharetra purus. Proin sed velit non dui ullamcorper tincidunt. Aliquam sed est diam.
                                    </div>
                                    <div class="product_in_price">$578.00</div>
                                    <div class="product_in_colors">
                                        <div class="product_in_sub_title">
                                            Select Colors
                                        </div>
                                        <button class="colors_cubes" style="background-color:red"></button>
                                        <button class="colors_cubes" style="background-color:pink"></button>
                                        <button class="colors_cubes" style="background-color:blue"></button>
                                    </div>
                                    <div class="product_in_size">
                                        <div class="product_in_sub_title">
                                            Select Size
                                        </div>
                                        <button class="size_spheres">9</button>
                                        <button class="size_spheres">10</button>
                                        <button class="size_spheres">13</button>
                                    </div>
                                    <div class="product_in_detail_drop"></div>
                                    <div class="product_in_btn_pnl"><button class="product_in_btn">ADD TO CART</button></div>
                                    <div class="product_in_social">
                                    </div>

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