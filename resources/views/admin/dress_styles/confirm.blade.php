@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_dressstyle',['dressstyle_id'=>$dressstyle->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $dressstyle->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_dressstyles') }}">
                    Back To Dress Style
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn-block vesti_in_btn" value="Delete Dress Style"/>
        </div>
    </div>
</div>
</form>
@endsection