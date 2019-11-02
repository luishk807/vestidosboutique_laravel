<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"><strong>{{ $order_detail["order"]["status"] }}</strong></td>
    </tr>
    <tr>
        <td colspan='2'>
            {{ __('emails.order_user_update.line_hello',['name'=>$order_detail["user"]["first_name"]]) }},<br/><br/>
            {{ __('emails.order_user_update.line_1') }}<br/><br/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td width="30%" align="left" valign="top">
                        <strong>{{ __('emails.order_user_update.line_2') }}</strong>
                    </td>
                    <td width="70%" align="left" valign="top">
                        {{ $order_detail["order"]["order_number"] }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    @if($order_detail['order']['allow_shipping']=="true")
                    <td width="50%" align="left" valign="top">
                        <strong>{{ __('emails.order_user_update.line_3') }}</strong>
                    </td>
                    @endif
                    <td width="{{ $order_detail['order']['allow_shipping']=='true'? '50%' : '100%'}}" align="left" valign="top">
                        <strong>{{ __('emails.order_user_update.line_4') }}</strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    @if($order_detail['order']['allow_shipping']=="true")
                    <td width="50%" align="left" valign="top">
                        {{ $order_detail["order"]["shipping_name"] }}<br/>
                        {{ $order_detail["order"]["shipping_address_1"] }}<br/>
                        {{ $order_detail["order"]["shipping_address_2"] }}<br/>
                        {{ $order_detail["order"]["shipping_province"] }} {{ $order_detail["order"]["shipping_district"] }} {{ $order_detail["order"]["shipping_corregimiento"] }} {{ $order_detail["order"]["shipping_zip_code"] }}<br/>
                        {{ $order_detail["order"]["shipping_country"] }}<br/>
                    </td>
                    @endif
                    @if($order_detail['order']['allow_billing']=="true")
                    <td width="{{ $order_detail['order']['allow_shipping']=='true'? '50%' : '100%'}}" align="left" valign="top">
                        {{ $order_detail["order"]["billing_name"] }}<br/>
                        {{ $order_detail["order"]["billing_address_1"] }}<br/>
                        {{ $order_detail["order"]["billing_address_2"] }}<br/>
                        {{ $order_detail["order"]["billing_province"] }} {{ $order_detail["order"]["billing_district"] }} {{ $order_detail["order"]["billing_corregimiento"] }} {{ $order_detail["order"]["billing_zip_code"] }}<br/>
                        {{ $order_detail["order"]["billing_country"] }}<br/>
                    </td>
                    @endif
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan='2'><strong>{{ __('emails.order_user_update.line_5') }}</strong></td>
    </tr>

    <tr>
        <td colspan='2' width="100%">
            <table width="100%">
                <tr>
                    <th width="30%" align="center">

                    </th>
                    <th width="40%" align="center">
                    {{ __('emails.order_user_update.line_6') }}
                    </th>
                    <th width="10%" align="center">
                    {{ __('emails.order_user_update.line_7') }}
                    </th>
                    <th width="20%" align="right">
                    {{ __('emails.order_user_update.line_8') }}
                    </th>
                </tr>
                @foreach($order_detail["order"]["products"] as $product)
                <tr>
                    <td valign="top"  align="center">
                        <img width="100" src="{{ asset('/images/products')}}/{{ $product['img'] }}" alt class="img-fluid"/>
                    </td>
                    <td valign="top" align="center">
                        {{ $product["name"] }}<br/>
                        {{ __('emails.order_user_update.line_9') }}: {{ $product["size"] }}<br/>
                        {{ __('emails.order_user_update.line_10') }}: {{ $product["color"] }}
                    </td>
                    <td valign="top" align="center">
                        {{ $product["quantity"] }}
                    </td>
                    <td valign="top" align="right">
                        {{ $product["total"] }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_11') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_total"],'2','.',',') }}
                    </td>
                </tr>
                @if($order_detail['order']['discount_app'] > 0)
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_12') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["subtotal"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_13') }}</strong>
                    </td>
                    <td align="right">
                        - ${{ number_format($order_detail["order"]["discount_app"],'2','.',',') }}
                    </td>
                </tr>
                @endif
                @if($order_detail['order']['allow_shipping']=="true")
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_14') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["shipping_total"],'2','.',',') }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_15') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_tax"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_16') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["grand_total"],'2','.',',') }}
                    </td>
                </tr>
                @if($order_detail['order']['allow_delivery_speed']=="true")
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ $order_detail["order"]["delivery_speed_name"] }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["delivery_speed_total"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_user_update.line_18') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["grand_total_delivery"],'2','.',',') }}
                    </td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>