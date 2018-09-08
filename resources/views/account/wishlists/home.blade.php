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

    <table class="table">
        <tbody>
            <tr>
                <td class="col">
                    <!--wishlist list begins-->
                    <table class="table account-wishlist-table">

                        @if($wishlists->count() > 0)
                        <thead>
                            <tr>
                                <th class="image"></th>
                                <th clas="desc">Description</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlists as $wishlist)
                            <tr>
                                <td width="15%" class="image"><img class="img-fluid" src="{{ asset('images/products')}}/{{$wishlist->getProduct->images->first()->img_url}}" alt="{{$wishlist->getProduct->images->first()->img_name}}"></td>
                                <td width="65%"class="desc">
                                    <strong><a href="{{ route('product_page',['product_id'=>$wishlist->getProduct->id])}}">{{$wishlist->getProduct->products_name}}</a></strong><br/>
                                    <div class='rate-view' data-rate-value="{{ $wishlist->getProduct->rates->avg('user_rate') }}"></div>
                                    ${{ number_format($wishlist->getProduct->total_rent,'2','.',',') }}
                                </td>
                                <td width="20%"class="action"><a href='{{ route("deletewishlist",["wishlist_id"=>$wishlist->id])}}'>{{ __('buttons.remove') }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td class="no-wishlist">
                                <strong>{{ __('general.wishlist_empty') }}</strong>
                                </td>
                            </tr>
                        </tbody>
                        @endif

                    </table>
                    <!--wishlist list ends-->
                </td>
            </tr>
        </tbody>
    </table>

    </div>
</div><!--end of main container-->
@endsection