<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            {{ __('emails.user_registry_resend.line_hello',['name'=>$data["first_name"]]) }},<br/><br/>
            <p>{{ __('emails.user_registry_resend.line_1') }}</p>
            <p>{{ __('emails.user_registry_resend.line_2') }}</p>
            <p><a href="{{ $data['link'] }}" target="_blank">{{ __('emails.user_registry_resend.line_3') }}</a></p>
            <p>{{ __('emails.user_registry_resend.line_4') }}<br/>
            <a href="https://www.vestidosboutique.com/signin/" target="_blank">www.vestidosboutique.com/signin/</a></p>
            <br/><br/>
            {{ __('emails.user_registry_resend.line_4') }}: {{ $data["email"] }}<br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>