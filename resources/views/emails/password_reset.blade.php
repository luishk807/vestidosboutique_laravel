<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello {{ $data["first_name"]}}, <br/><br/>
            <p>You requested a password request email.</p>
            <p>Please click the link bellow to begin:<br/>
            <a href="{{ $data['link']}}" target="_blank">Reset Password</a></p>
            <br/><br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>