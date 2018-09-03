<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"><strong>{{ $data["status_name"] }}</strong></td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello {{ $data["first_name"]}}, <br/><br/>
            <p>{{$data["message"]}}</p>
            <p>To log in when visiting our site just click on:<br/>
            <a href="https://www.vestidosboutique.com/signin/" target="_blank">www.vestidosboutique.com/signin/</a></p>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>