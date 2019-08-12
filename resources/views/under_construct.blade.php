@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
        <div>
               <div class="container-in-space under_const">
                    <div class="row">
                        <div class="col">
                        <img src="{{ asset('images/cloth_error.svg') }}" class="vesti-svg vestidos-icons-tear-dress"/>
                        </div>
                        <div class="col">
                            <h3>{{ trans('general.under_main_title')}}</h3>
                            <div class="error_msg">{{ trans('general.under_main_text')}}</div>
                            <div class="vesti_in_btn_pnl">
                                <button class="btn-block vesti_in_btn" onclick="location.href='{{ route('home_page')}}'">{{ trans('buttons.back_home')}}</button>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection