<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            <h1>{{ __('emails.new_email_admin.line_1') }}</h1>
            <table>
                <tr>
                    <td>{{ __('emails.new_email_admin.line_2') }}</td>
                    <td>{{$client["first_name"]." ".$client["last_name"]}}</td>
                </tr>
                <tr>
                    <td>{{ __('emails.new_email_admin.line_3') }}</td>
                    <td>{{$client["email"]}}</td>
                </tr>
                <tr>
                    <td>{{ __('emails.new_email_admin.line_4') }}</td>
                    <td>{{$client["phone"]}}</td>
                </tr>
                <tr>
                    <td>{{ __('emails.new_email_admin.line_5') }}</td>
                    <td>{{$client["country"]}}</td>
                </tr>
                <tr>
                    <td>{{ __('emails.new_email_admin.line_6') }}</td>
                    <td>{{$client["message"]}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>