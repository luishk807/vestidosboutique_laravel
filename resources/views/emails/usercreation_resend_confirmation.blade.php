<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello {{ $data["first_name"]}}, <br/><br/>
            <p>Welcome to Vestidos Boutique.</p>
            <p>To active your account, please click the link below for verification</p>
            <p><a href="{{ $data['link'] }}" target="_blank">Active Account</a></p>
            <p>To log in when visiting our site just click on:<br/>
            <a href="https://www.vestidosboutique.com/signin/" target="_blank">www.vestidosboutique.com/signin/</a></p>
            <br/><br/>
            Email: {{ $data["email"] }}<br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>