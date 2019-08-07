<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"><strong>{{ $data["status_name"] }}</strong></td>
    </tr>
    <tr>
        <td colspan='2'>
            {{ __('emails.admin_user_update.line_hello',['name'=>$data["first_name"]]) }},<br/><br/>
            <p>{{$data["message"]}}</p>
            <p>{{ __('emails.admin_user_update.line_1') }}<br/>
            <a href="https://www.vestidosboutique.com/signin/" target="_blank">www.vestidosboutique.com/signin/</a></p>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>