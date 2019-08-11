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
            {{ __('general.user_section.profile_address_delete_title') }}
            </P>
        </div>
    </div>
    <div class="container account-container">


<form action="{{ route('deleteaddress',['address_id'=>$address->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
        {{ __('general.user_section.profile_address_delete_title2',['name'=>$address->nick_name]) }}
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
            <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.delete') }}"/>
        </div>
    </div>
</div>
</form>

    </div>
</div><!--end of main container-->
@endsection