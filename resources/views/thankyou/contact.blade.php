@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space missing-col">
                    <div class="row">
                        <div class="col">
                        <img src="{{ asset('images/cloth_error.svg') }}" class="vesti-svg vestidos-icons-tear-dress"/>
                        </div>
                        <div class="col">
                            <h3>404</h3>
                            <div class="error_msg">Ooops, something goes wrong</div>
                            <div class="vesti_in_btn_pnl">
                                <button class="btn-block vesti_in_btn" onclick="location.href='{{ route('home_page')}}'">Return to Home Page</button>
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