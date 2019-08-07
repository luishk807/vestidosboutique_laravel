<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            {{ __('emails.order_admin.line_hello',['name'=>$data["first_name"]]) }}<br/><br/>
            <p>{{ __('emails.order_admin.line_1') }}</p>
            <p>{{ __('emails.order_admin.line_2',['type'=>$data["account_type"]]) }}</p>
            <p>{{ __('emails.order_admin.line_3') }}<br/>
            <a href="{{ $data['link'] }}" target="_blank">www.vestidosboutique.com/admin</a></p>
            <br/><br/>
            {{ __('emails.order_admin.line_4') }}: {{ $data["email"] }}<br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>