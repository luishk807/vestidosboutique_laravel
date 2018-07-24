@extends("layouts.sub-layout")
@section('content')
<script>
	$(document).ready(function(){
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
button.size_spheres.selected {
    background: black;
    color: white;
}
button.colors_cubes.selected{
    border:2px gray solid;
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
#popup_bgOverlay{
    display:none;
    background-color:rgba(0,0,0,0.8);
    position:absolute;
    width:100%;
    height:100%;
    z-index:99999;
}
#popup_text{
    background-color: white;
    padding:40px 80px;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    top:30%;
    position: absolute;
    color:black;
}
.popup_close_btn_pnl{
    text-align:center;
}
.popup_close_btn{
    margin-top:30px;
}
</style>
<script>
$(document).ready(function(){
    $(".product_thumnb_link").click(function(e){
        e.preventDefault();
       var getImg = $($(e.target).closest("img")).attr("src");
       $(".product_main_img_in").find("img").attr("src",getImg);
    });
    $("#popup_bgOverlay").click(function(){
        closeCartPopUp();
    })
})
function closeCartPopUp(){
    $("#popup_bgOverlay").css("display","none");
    var div = document.getElementById('popup_text_in');
    div.innerHTML = '';
    $('body').css('overflow','auto');
}
function openCartPopUp(txt){
    $("#popup_bgOverlay").css("display","block");
    var div = document.getElementById('popup_text_in');
    div.innerHTML += txt;
    $('body').css('overflow','hidden');
}
function addCart(event){
    event.preventDefault();
    var dataValue=$(event.target).attr("data-value");
    var hiddenInput=$(event.target).attr("data-input");
    var dataClass=$(event.target).attr("data-class");
    $("."+dataClass).removeClass("selected");
    $(event.target).addClass("selected");
    $("#"+hiddenInput).val(dataValue);
}
function checkCartSubmit(){
    if(!$("#product_color").val()){
        openCartPopUp("Please Select Color");
        return false;
    }else if(!$("#product_size").val()){
        openCartPopUp("Please Select Size");
        return false;
    }
    return true;
}
</script>
<div id="popup_bgOverlay">
    <div id="popup_text">
        <div id="popup_text_in"></div>
        <div class="popup_close_btn_pnl"><button onclick="closeCartPopUp()" class="popup_close_btn">Close</button></div>
    </div>
</div>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col container-in-center">
            <div class="container-fluid container-in-space">
                <div class="row">
                    <div class="col-md-2 product_thumnnail">
                            @foreach($product->images as $image)
                            <a href="" class="product_thumnb_link"><img src="{{ asset('/images/products/') }}/{{ $image->img_url }}" alt="{{ $image->img_name }}" class="float-left img-thumbnail"/></a>
                            @endforeach
                    </div>
                    <div class="col-md-6 product_main_img">
                        <div class="product_main_img_in">
                            <a href="javascript:addWishlist('{{ $product->id }}')" class="vesti-heart-link-b"><span class="vesti-svg"></span></a>
                            <a href=""><img src="{{ asset('/images/products/') }}/{{ $product->images->first()->img_url }}" class="img-fluid" alt="{{ $product->images->first()->img_name }}" /></a>
                        </div>
                    </div>
                    <div class="col-md-4 product_main_txt">
                        <div>
                            <div class="col">
                                    <form action="{{ route('add_cart',['product_id'=>$product->id]) }}" method="post" onsubmit="return checkCartSubmit()">
                                    <input type="hidden" id="product_color" name="product_color" value=""/>
                                    <input type="hidden" id="product_size" name="product_size" value=""/>
                                    <h2 class="product_in_title">{{ $product->products_name }}</h2>
                                    <div class="product_in_vendor">By {{ $product->vendor->getFullVendorName() }}</div>
                                    <div class="product_in_rate">
                                        <div class='rate-view' data-rate-value="{{ $product->rates->avg('user_rate') }}"></div>
                                    </div>
                                    <div class="product_in_detail crimson-txt">
                                    {{ $product->product_detail }}
                                    </div>
                                    <div class="product_in_price">${{ $product->product_total }}</div>
                                    <div class="product_in_colors">
                                        <div class="product_in_sub_title">
                                            Select Colors
                                        </div>
                                        @foreach($product->colors as $color)
                                        <button class="colors_cubes color_cubes_btn_a" data-class="colors_cubes" data-input="product_color" data-value="{{ $color->id }}" onclick="addCart(event)" style="background-color:{{ $color->color_code }}"></button>
                                        @endforeach
                                    </div>
                                   <div class="product_in_size">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="product_in_sub_title">
                                                Select Size
                                            </div>
                                            @foreach($product->sizes as $size)
                                            <button class="size_spheres" onclick="addCart(event)" data-class="size_spheres" data-input="product_size" data-value="{{ $size->id }}">{{ $size->name }}</button>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_in_sub_title">
                                               Quantity
                                            </div>
                                            <select class="custom-select" name="product_quantity">
                                            @for ($i = 1; $i < 10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            </select>
                                        </div>
                                        </div>

                                        
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
                                                {{ $product->product_detail }}

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
                                               {{ $product->products_description }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vesti_in_btn_pnl">
                                        <input class="btn-block vesti_in_btn"  type="submit" value="ADD TO CART"/>
                                    </div>
                                    <div class="product_in_social">
                                        
                                    </div>
                                    </form>
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