@extends("layouts.sub-layout")
@section('content')
<!-- <script>
var nextUrl="{{ route('checkout_save_shipping') }}";
function checkoutNext(inputVar){
        var address= $("input[name='"+inputVar+"']:checked").val();
        window.location.href=nextUrl+"?address="+address;

}
</script> -->
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space">
                        <form action="{{ route('checkout_save_shipping') }}" method="post">
                        <!--content-->
                        <div class="row">
                        @foreach($checkout_menus as $checkoutKey=>$checkout_menu)
                            <div class="col">
                               {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                            </div>
                        @endforeach
                        </div>
                        <div class="row">
                            <div class="col">
                                {{$page_title}}
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 text-center">
                               <span id="session_msg">
                               @if(count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach
                                @endif
                               </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                    
                                <table class="table">
                                    <tbody>
                                        
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td class="text-right" colspan='2' ><a class="vestidos-simple-link" href="{{ route('newaddress',['user_id'=>$user->id])}}">Add Address</a></td>
                                        </tr>
                                        @foreach($user->getAddresses as $address)
                                        <tr>
                                            <td>
                                                <input type="radio" value="{{ $address->id }}" name="shipping_address" >
                                            </td>
                                            <td>
                                            {{ $address->nick_name}}<br/>
                                            {{ $address->first_name}} {{ $address->middle_name}} {{ $address->last_name}}<br/>
                                            {{ $address->address_1}} {{ $address->address_2}}<br/>
                                            
                                            {{ $address->phone_number}}<br/>
                                            {{ $address->email}}<br/>
                                            {{ $address->city}} {{ $address->state}} {{ $address->getCountry->countryName}} {{ $address->zip_code}}<br/>
                                            </td>
                                            <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">Edit</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!--end of form-->
                            <div class="col-md-5"><!--load session-->
                                @php( $header_cart_total=0 )
                                @foreach(Session::get('vestidos_shop') as $header_cart_key=>$header_cart)
                               <div class="row cart-top-items"> <!--item-->
                                   <div class="col-md-3"><span><a href=""><img src="{{ asset('/images/products') }}/{{ $header_cart['image']}}" alt width="100%"/></a></span></div>
                                   <div class="col-md-9 cart-top-item-txt">
                                       <div>
                                        <p><a href="/product/{{ $header_cart['id']}}">{{ $header_cart["name"] }}</a></p>
                                        <span>Size: {{ $header_cart["size"] }}</span>
                                        <span>Color: {{ $header_cart["color"] }}</span>
                                        <span>Quantity: {{ $header_cart["quantity"] }}</span>
                                        <p>Unit Price: ${{ number_format($header_cart["total"],2) }}</p>
                                       </div>
                                   </div>
                               </div><!--end of item-->
                               @php( $header_cart_total +=$header_cart["total"] * $header_cart["quantity"] )
                               @endforeach
                               <div class="row">
                                   {{$header_cart_total}}
                               </div>
                            </div><!-- end of load session-->
                        </div>`
                        <div class="row">
                            <div class="col">
                            <!-- <a class="btn-block vesti_in_btn checkout_next" href="javascript:checkoutNext('shipping_address')">Continue</a> -->
                            <input type="submit" class="btn-block vesti_in_btn checkout_next" value="Continue"/>
                            </div>
                        </div>
                        </form>
                        <!--end of content-->
               </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection