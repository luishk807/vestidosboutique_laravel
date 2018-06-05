@extends("layouts.sub-layout")
@section('content')
<script src="{{ asset('/js/vendor/rater/rater.js') }}" charset="utf-8"></script>
<script>
	$(document).ready(function(){
		$(".rate").rate({
			readonly:true
		});
		$(".rate-view").rate({
			readonly:true
		});
	})
</script>
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
    width: 34px;
    height: 33px;
    background: transparent;
    display: inline-block;
    border-radius: 18px;
    margin: 2px 2px 2px 0px;
    border: 1px rgba(0,0,0,.2) solid;
    cursor: pointer;
    font-family: "Arial";
    font-size: .8rem;
}
button.size_spheres:hover {
    background: black;
    color: white;
}
.product_in_btn_pnl{
    margin:25px 0px;
}
.product_in_btn{
    background-color: #df1174;
    border:1px solid #df1174;
    color: white;
    padding: 10px 0px;
    font-family: "playfair display";
    text-align:center;
    font-style: italic;
    cursor:pointer;
    font-size:1rem;
}
.product_in_btn:hover{
    background-color: transparent;
    color: #df1174;
}
/***ACCORDEON****/
.card:first-child{
    border-bottom: none;
}
.card{
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: transparent !important;
    background-clip: border-box;
    border-top: 1px solid rgba(0,0,0,.125);
    border-bottom: 1px solid rgba(0,0,0,.125);
    border-left:none;
    border-right:none;
}
.card-header{
    padding: .2rem 1.25rem;
    margin-bottom: 0;
    background-color: transparent !important;
    border-bottom: none;
}
.collapse-btn{
    color:black;
    text-decoration: none !important;
    padding:0px;
}
#collapseOne{
    padding: 5px 10px;
    border-top: 1px solid rgba(0,0,0,.125);
}
.product_in_detail_drop{
    margin: 25px 0px;
}
.vestidos-icons-social-black{
    width: 30px;
    height: 30px;
    background-size: 30px 30px;
}
.product_in_loved{
    padding-top:100px;
}
.product_in_loved img{
    width:100%;
}
.product_in_title_loved{
    color:black !important;
    font-weight:700 !important;
    font-size:1rem;
    padding-bottom: 0px !important;
}
</style>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col container-in-center">
            <div class="container-fluid container-in-space">
                <div class="row">
                    <div class="col-md-2 product_thumnnail">
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="float-left img-thumbnail"/></a>
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="float-left img-thumbnail" /></a>
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="float-left img-thumbnail" /></a>
                    </div>
                    <div class="col-md-6 product_main_img">
                        <div class="product_main_img_in">
                            <a href="#" class="vesti-heart-link-b"><span class="vesti-svg"></span></a>
                            <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" class="img-fluid" alt /></a>
                        </div>
                    </div>
                    <div class="col-md-4 product_main_txt">
                        <div>
                            <div class="product_in_txt">
                                    <h2 class="product_in_title">Long Organaza Sweetheart Mori Lee Quinceanera Dress</h2>
                                    <div class="product_in_vendor">By Joanna</div>
                                    <div class="product_in_rate">
                                        <div class='rate-view' data-rate-value="4"></div>
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
                                    <div class="product_in_detail_drop">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                           + Detail
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelleby="headingOne" data-parent="#accordion">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.

                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                           + Description
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelleby="headingTwo" data-parent="#accordion">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_in_btn_pnl"><button class="btn-block product_in_btn">ADD TO CART</button></div>
                                    <div class="product_in_social">
                                        
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col product_in_loved">
                        <h2 class="product_in_title_loved">People Also Loved</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 col-md-2  col-md-offset-1">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                     <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
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