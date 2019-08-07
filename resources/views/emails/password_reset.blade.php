<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            {{ __('emails.password_reset.line_hello',['name'=>$data["first_name"]]) }},<br/><br/>
            <p>{{ __('emails.password_reset.line_1') }}</p>
            <p>{{ __('emails.password_reset.line_2') }}<br/>
            <a href="{{ $data['link']}}" target="_blank">{{ __('emails.password_reset.line_3') }}</a></p>
            <br/><br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>