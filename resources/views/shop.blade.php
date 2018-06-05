@extends("layouts.sub-layout")
@section('content')
<style>
.vesti-new-border-b{
  border-top: 60px solid #87124a;
  border-right: 60px solid transparent;
}
.vesti-new-txt-b{
  font-size: .7rem;
  margin-top: 10px;
    margin-left: 5px;
}
.shoplist-cont{
    list-style-type: none;
    display: block;
    padding: 0;
    margin: 0;
    position: relative;
    -moz-columns: 3 200px;
    -webkit-columns: 3 200px;
    columns: 3 200px;
    -moz-column-gap: 1em;
    -webkit-column-gap: 1em;
    column-gap: 1em;
}
.shoplist-cont li{
    /* display:table-cell; */
    padding-top: 30px;
}
.shoplist-list > div{
    display:inline-table;
}
.shoplist-list-cont-in .row div{
    padding-right:0px;
    padding-left:0px;
}
.shoplist-list-cont-in .row div:nth-child(1){
    text-align:left;
}
.shoplist-list-cont-in .row div:nth-child(2){
    text-align:right;
}
.shoplist-list-cont-in .shoplist-thumb-name{
    font-family: Arial;
    font-size: .8rem;
    font-weight: bold;
}
.shoplist-list-cont-in .shoplist-thumb-price{
    font-family: Arial;
    font-size: 1.1rem;
    font-weight: bold;
}
.shoplist-list-cont-in .shoplist-thumb-auth{
    font-family: Arial;
    font-size: .8rem;
    font-weight: bold;
}
.color_cubes_view_a{
  width: 23px;
  height: 15px;
}
.shoplist-nav{
    text-align:right;
    margin: 20px 0px 10px 0px;
}
.shoplist-nav ul{
    list-style:none;
}
.shoplist-nav ul li{
    display:inline-block;
}
.shoplist-nav ul li:not(:first-child):not(:last-child){
    margin:0px 10px;
}
.shoplist-nav a,
.shoplist-nav{
    font-family: arial;
    font-size: 1rem;
    color: black;
}
.shoplist-nav select{
    padding: 10px 40px 10px 2px;
    background-color: transparent;
    text-align: left;
    background: none;
}
.shoplist-search-cont ul{
    list-style:none;
    padding: 0;
    margin: 0;
}
.shoplist-search-cont h3{
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    line-height: 3rem;
}
.shoplist-search-cont ul li{
    text-align:left;
}
.shoplist-search-list-cont{
    max-height: 250px;
    overflow: auto;
}
</style>
<script>
	$(document).ready(function(){
		$(".rate-shop").rate({
			readonly:true
		});
	})
</script>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col container-in-center">
            <div class="container container-in-space">
                <div class="row">
                    <div class="col-md-3">
                    
                        <div class="shoplist-search-cont vesti-search-cont">
                            <div>
                                <h3>Category</h3>
                                <div class="shoplist-search-list-cont">
                                    <ul>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                        <li>Test</li>
                                    </ul>
                                </div>   
                            </div>
                        </div>


                    </div>
                    <div class="col-md-9">
                        <div><img src="{{ asset('images/ad_testing.jpg') }}" class="img-fluid" alt/></div>
                        <div class="shoplist-nav">
                            <ul>
                                <li>312 Products</li>
                                <li>Sort By 
                                    <select>
                                        <option>Name</option>
                                    </select>
                                </li>
                                <li>1 of 3</li>
                                <li><a href="">Next ></a></li>
                            </ul>
                        </div>
                        <div>
                            
                            <ul class="shoplist-cont">
                                <!--each pod-->
                                <li class="shoplist-list">
                                    <div>
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='/product' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">Long Organaza Sweetheart</span><br/><span class="shoplist-thumb-auth">By Joanna</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">$578.00</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="4"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:red"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:pink"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:green"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                                 <!--each pod-->
                                 <li class="shoplist-list">
                                    <div>
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='/product' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">Long Organaza Sweetheart</span><br/><span class="shoplist-thumb-auth">By Joanna</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">$578.00</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="4"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:red"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:pink"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:green"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                                 <!--each pod-->
                                 <li class="shoplist-list">
                                    <div>
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='/product' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">Long Organaza Sweetheart</span><br/><span class="shoplist-thumb-auth">By Joanna</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">$578.00</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="4"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:red"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:pink"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:green"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                                <!--each pod-->
                                <li class="shoplist-list">
                                    <div>
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='/product' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">Long Organaza Sweetheart</span><br/><span class="shoplist-thumb-auth">By Joanna</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">$578.00</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="4"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:red"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:pink"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:green"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                                <!--each pod-->
                                <li class="shoplist-list">
                                    <div>
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='/product' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">Long Organaza Sweetheart</span><br/><span class="shoplist-thumb-auth">By Joanna</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">$578.00</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="4"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:red"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:pink"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:green"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                                <!--each pod-->
                                <li class="shoplist-list">
                                    <div>
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='/product' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">Long Organaza Sweetheart</span><br/><span class="shoplist-thumb-auth">By Joanna</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">$578.00</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="4"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:red"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:pink"></span>
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:green"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                            </ul>
                        </div><!--end of product list container-->
                        <div class="shoplist-nav">
                            <ul>
                                <li>1 of 3</li>
                                <li><a href="">Next ></a></li>
                            </ul>
                        </div><!--end of nav container-->
                    </div><!--end of main product list container-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection