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
            {{ __('general.user_section.profile_wishlist_title') }}
            </P>
        </div>
    </div>
    <div class="container account-container">

    <div class="row">
        <div class="col px-0">

                <!--wishlist list begins-->
                <div class="container px-0 account-wishlist-table">
                    @if($wishlists->count() > 0)
                    <div class="row header">
                        <div class="col-lg-3 image">

                        </div>
                        <div class="col-lg-7 text-center desc">
                        {{ __('general.user_section.profile_wishlist_desc') }}
                        </div>
                        <div class="col-lg-2 text-center action">
                        {{ __('general.user_section.profile_wishlist_action') }}
                        </div>
                    </div>
                    @foreach($wishlists as $wishlist)
                    <div class="row content">
                        <div class="col-lg-3 col-md-2 col-sm-12 image">
                            <img class="img-fluid" 
                            @if($wishlist->getProduct->images->count()>0)
                            src="{{ asset('images/products')}}/{{$wishlist->getProduct->images->first()->img_url}}" alt="{{$wishlist->getProduct->images->first()->img_name}}"
                            @else
                            src="{{asset('images/no-image.jpg')}}" alt="no image" 
                            @endif
                            >
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 desc">
                            <strong><a href="{{ route('product_page',['product_id'=>$wishlist->getProduct->id])}}">{{$wishlist->getProduct->products_name}}</a></strong><br/>
                            <div class='rate-view' data-rate-value="{{ $wishlist->getProduct->rates->avg('user_rate') }}"></div>
                            {{$wishlist->getProduct->product_model}}
                            <br/>
                            {{$wishlist->getProduct->product_detail}}
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-12 action">
                            <a href='{{ route("deletewishlist",["wishlist_id"=>$wishlist->id])}}'>{{ __('buttons.remove') }}</a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row">
                        <div class="col no-wishlist text-center">
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