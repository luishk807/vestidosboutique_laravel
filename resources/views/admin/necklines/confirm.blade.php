@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_neckline',['neckline_id'=>$neckline->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $neckline->name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_necklines') }}">
                    Back To Neckline Type
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Neckline"/>
        </div>
    </div>
</div>
</form>
@endsection