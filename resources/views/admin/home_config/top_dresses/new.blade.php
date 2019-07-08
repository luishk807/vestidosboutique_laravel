@extends('admin/layouts.app')
@section('content')

<style>
.top-dress-list img {
    max-width: 100%;
}
.top-dress-list td{
    width:20%;
}
</style>
<script type="text/javascript">
function checkSubmit(){
    $(".error > ul").empty();
    if($("input[name*='top_dresses']:checked").length==3){
        $(form).submit();
    }else{
        $(".error > ul").append("<li>Must Be 3</li>");
    }
    return false;
}
</script>
<form name="topdress_form" action="{{ route('create_top_dress') }}" method="post" onsubmit="return checkSubmit()">
{{ csrf_field() }}

    <table class="table top-dress-list">
        <thead>
            <tr>
                <td class="item"></td>
                <td class="item">Image</td>
                <td class="item">Name</td>
                <td class="item">Status</td>
                <td class="item">Rate</td>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $indexKey=>$product)
            <tr>
                <td class="item">
                    <label class="form-check-label" for="productcheck{{$indexKey}}" class="label-table"></label>
                    <input type="checkbox"
                    @if($product->top_dress)
                    checked
                    @endif
                    name="top_dresses[{{$indexKey}}][product_id]" id="productcheck{{$indexKey}}" value="{{ $product->id }}">
                </td>
                <td class="item"><img src="
                @if($product->images->count()>0)
                    {{asset('images/products')}}/{{$product->getMainImage()[0]->img_url}}
                @else
                {{asset('images/no-image.jpg')}}
                @endif
                " alt="" class="img-fluid"></td>
                <td class="item">{{$product->products_name}}</td>
                <td class="item">{{$product->getStatus->name}}</td>
                <td class="item">
                    {{ $product->rates->avg("user_rate") }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <small class="error">
    <ul>
    @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
    </ul>
    </small>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Select Top Dresses"/>
            </div>
        </div>
    </div>
</form>
@endsection