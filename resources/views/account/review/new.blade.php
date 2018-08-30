@extends("layouts.sub-layout-account")
@section('content')
<script>
$(document).ready(function(){
    var options = {
        step_size: 0.5,
        cursor: 'default',
        readonly: false,
        change_once: false, // Determines if the rating can only be set once
    }

    $(".review-rate-view").rate(options);

    $(".review-rate-view").on("change", function(ev, data){
    document.getElementById("user_rate").value=data.to;
    });


})

</script>

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
                    <form action="{{ route('user_create_review',['product_id'=>$product->id])}}" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{ asset('images/products')}}/{{ $product->images->first()->img_url }}" alt="{{ $product->images->first()->img_name }}">
                                </div>
                                <div class="col-md-8">
                                    
                                    <div class="form-group">
                                            <label for="reviewRate">Your Rate:</label>
                                            <div id="reviewRate" class='review-rate-view' data-rate-value="{{ old('user_rate') ? old('user_rate') : $product->rates->avg('user_rate') }}"></div>
                                            <input type="hidden" id="user_rate" name="user_rate" value=""/>
                                            <small class="error">{{$errors->first("user_rate")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="reviewHeadline">Headline:</label>
                                            <input type="text" id="reviewHeadline" class="form-control" name="user_headline" value="" placeholder="Review Headline"/>
                                            <small class="error">{{$errors->first("user_headline")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="reviewComment">Comment:</label>
                                            <textarea class="form-control" id="reviewComment" rows="3" name="user_comment"></textarea>
                                            <small class="error">{{$errors->first("user_comment")}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="vesti_in_btn_pnl">
                                        <input type="submit" class="btn-block vesti_in_btn" value="Submit Review"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- review-->
                </td>
            </tr>
        </tbody>
    </table>

    </div>
</div><!--end of main container-->
@endsection