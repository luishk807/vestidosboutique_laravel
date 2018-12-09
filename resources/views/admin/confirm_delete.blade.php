@extends('admin/layouts.app')
@section('content')
<form action="{{ $confirm_delete_url }}" method="post">
{{ method_field('DELETE') }}
<div class="container cancel-container">
    @if(isset($confirm_show_warning) && $confirm_show_warning)
    <div class="row">
        <div class="col text-center">
            <h3>&#60;&#60;&#60;&#60;Warning&#62;&#62;&#62;&#62;</h3><Br/>
            Unlike, cancelling an item, deleting an item will permantely delete this item and its history.<br/><br/>
        </div>
    </div>
    @endif
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2"></div>
        <div class="col-md-5"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>
    </div>
    @foreach($confirm_data as $item)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" checked name="item_ids[]" value="{{ $item->id }}"></div>
        <div class="col-md-2">
        @if($confirm_type=="img")
        <img src="
        @if($item->col_1)
            {{asset('images/products')}}/{{$item->col_1 }}
        @else
           {{asset('images/no-image.jpg')}}
        @endif
        " class="img-fluid"/>
        @else
            <div class="col-md-5">{{$item->col_1 }}</div>
        @endif
        </div>
        <div class="col-md-5">{{$item->col_2 }}</div>
        <div class="col-md-2">{{$item->col_3 }}</div>
        <div class="col-md-2">{{$item->col_4 }}</div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ $confirm_return }}">
                    Back To {{$confirm_name}}
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete {{ $confirm_name }}"/>
        </div>
    </div>
</div>
</div>
</form>
@endsection