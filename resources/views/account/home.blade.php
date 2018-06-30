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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table no-top-border">
                <tbody>
                    <tr>
                        <th scope="row">Profile</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>Luis Ho Ku</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>evil_luis@hotmail.com</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"><a href="{{ route('edituser',['user_id'=>$user->id]) }}" class="vestidos-simple-link" href="">Edit</a></td>
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
                        <th scope="row">Address</th>
                        <td class="text-right"><a class="vestidos-simple-link" href="{{ route('newaddress',['user_id'=>$user->id])}}">Add Address</a></td>
                    </tr>
                    @foreach($user->getAddresses as $address)
                    <tr>
                        <td>
                           {{ $address->nick_name}}<br/>
                           {{ $address->first_name}} {{ $address->middle_name}} {{ $address->last_name}}<br/>
                           {{ $address->address_1}} {{ $address->address_2}}<br/>
                           
                           {{ $address->phone_number}}<br/>
                           {{ $address->email}}<br/>
                           {{ $address->city}} {{ $address->state}} {{ $address->getCountry->countryName}} {{ $address->zip_code}}<br/>
                        </td>
                        <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!--end of main container-->
@endsection