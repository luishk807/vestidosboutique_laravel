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
    -webkit-column-rule: 1px dotted #ddd;
     -moz-column-rule: 1px dotted #ddd;
          column-rule: 1px dotted #ddd;
}
.shoplist-cont li{
    display:table-cell;
    padding-top: 10px;
}
</style>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col container-in-center">
            <div class="container container-in-space">
                <div class="row">
                    <div class="col-md-2">
                    
                        <div>
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


                    </div>
                    <div class="col-md-8">
                        <div><img src="{{ asset('images/ad_testing.jpg') }}" class="img-fluid" alt/></div>    
                        <div>
                            <!-- <div class="container shoplist-cont">
                                <div class="row">
                                    <div class="shoplist-list col-sm-6 mt-4 col-md-4">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                    </div>
                                    <div class="shoplist-list col-sm-6 mt-4 col-md-4">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                    </div>
                                    <div class="shoplist-list col-sm-6 mt-4 col-md-4">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                    </div>
                                    <div class="shoplist-list col-sm-6 mt-4 col-md-4">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                    </div>
                                    <div class="shoplist-list col-sm-6 mt-4 col-md-4">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                    </div>
                                    <div class="shoplist-list col-sm-6 mt-4 col-md-4">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                    </div>
                                </div>
                            </div> -->
                            <ul class="shoplist-cont">
                                <li class="shoplist-list">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                </li>
                                <li class="shoplist-list">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                </li>
                                <li class="shoplist-list">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                </li>
                                <li class="shoplist-list">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                </li>
                                <li class="shoplist-list">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                </li>
                                <li class="shoplist-list">
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        <a href='' class="flash_hover_link thumbnail"><img class="img-fluid" src="{{asset('images/home_main_img4.jpg')}}" alt/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection