<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            <h1>New Email Received</h1>
            <table>
                <tr>
                    <td>Name:</td>
                    <td>{{$client["first_name"]." ".$client["last_name"]}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{$client["email"]}}</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>{{$client["phone"]}}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{$client["country"]}}</td>
                </tr>
                <tr>
                    <td>Message:</td>
                    <td>{{$client["message"]}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>