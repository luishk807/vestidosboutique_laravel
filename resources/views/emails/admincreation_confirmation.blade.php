<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello {{ $data["first_name"]}}, <br/><br/>
            <p>Welcome to Vestidos Boutique.</p>
            <p>Your {{ $data["account_type"] }} Account registration has created!.</p>
            <p>To log in when visiting our site just click on:<br/>
            <a href="{{ $data['link'] }}" target="_blank">www.vestidosboutique.com/admin</a></p>
            <br/><br/>
            Email: {{ $data["email"] }}<br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>