@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    @if(session('success'))
    <div class="row result-mg">
        <div class="col">
            <div class="warning-cont">
                <P>{{ session('success') }}</P>
            </div>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="row result-mg">
        <div class="col">
            <div class="warning-cont">
                <P>{{ session('error') }}</P>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <P>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table no-top-border">
                <tbody>
                    <tr>
                        <th scope="row">{{ __('header.profile') }}</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>{{$user->getFullName()}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"><a href="{{ route('edituser') }}" class="vestidos-simple-link" href="">{{ __('buttons.edit') }}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <tbody>
                    
                    <tr>
                        <th scope="row">{{ trans_choice('general.form.address',1) }}</th>
                        <td class="text-right"><a class="vestidos-simple-link" href="{{ route('newaddress')}}">{{ __('buttons.add_address') }}</a></td>
                    </tr>
                    @foreach($user->getAddresses as $address)
                    <tr>
                        <td>
                           @if($address->nick_name)
                           <strong>{{ $address->nick_name}}</strong><br/>
                           @endif
                           {{ $address->first_name}} {{ $address->middle_name}} {{ $address->last_name}}<br/>
                           {{ $address->address_1}} {{ $address->address_2}}<br/>
                           {{ $address->city}} {{ $address->state}}
                           {{ $address->getProvince->name }} {{ $address->getDistrict->name }} {{ $address->getCorregimiento->name }}, {{ $address->getCountry->countryName }}
                           <br/>
                           @if($address->phone_number_1)
                           {{ $address->phone_number_1}}<br/>
                           @endif
                           @if($address->phone_number_2)
                           {{ $address->phone_number_2 }}<br/>
                           @endif
                           @if($address->email)
                           {{ $address->email}}<br/>
                           @endif
                        </td>
                        <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">{{ __('buttons.edit') }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!--end of main container-->
@endsection