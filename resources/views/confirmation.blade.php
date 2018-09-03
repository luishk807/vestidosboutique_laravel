@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space confirm-col">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <img src="{{ asset('images') }}/{{ $thankyou_img }}" class="vesti-svg vestidos-icons-confirm"/>
                        </div>
                        <div class="col-md-8">
                            <h3>{{$thankyou_title}}</h3>
                            <div class="error_msg">{{ $thankyou_msg }}</div>
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