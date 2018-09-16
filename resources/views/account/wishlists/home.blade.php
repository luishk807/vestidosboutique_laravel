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

    <div class="row">
        <div class="col">

                <!--wishlist list begins-->
                <div class="container account-wishlist-table">
                    @if($wishlists->count() > 0)
                    <div class="row">
                        <div class="col image">

                        </div>
                        <div class="col desc">
                            Description
                        </div>
                        <div class="col action">
                            Action
                        </div>
                    </div>
                    @foreach($wishlists as $wishlist)
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 image">
                            <img class="img-fluid" src="{{ asset('images/products')}}/{{$wishlist->getProduct->images->first()->img_url}}" alt="{{$wishlist->getProduct->images->first()->img_name}}">
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 desc">
                            <strong><a href="{{ route('product_page',['product_id'=>$wishlist->getProduct->id])}}">{{$wishlist->getProduct->products_name}}</a></strong><br/>
                            <div class='rate-view' data-rate-value="{{ $wishlist->getProduct->rates->avg('user_rate') }}"></div>
                             ${{ number_format($wishlist->getProduct->total_rent,'2','.',',') }}
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 action">
                            <a href='{{ route("deletewishlist",["wishlist_id"=>$wishlist->id])}}'>{{ __('buttons.remove') }}</a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row">
                        <div class="col no-wishlist">
                            <strong>{{ __('general.empty_msg.wishlist') }}</strong>
                        </div>
                    </div>
                    @endif
                </div>
                 <!--wishlist list ends-->
        </div>
    </div>


    </div>
</div><!--end of main container-->
@endsection