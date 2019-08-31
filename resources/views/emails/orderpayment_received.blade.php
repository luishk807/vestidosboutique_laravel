<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"><strong>{{ $order_detail["order"]["status"] }}</strong></td>
    </tr>
    <tr>
        <td colspan='2'>
            {{ __('emails.order_payment_update.line_hello',['name'=>$order_detail["user"]["first_name"]]) }},<br/><br/>
            {{ __('emails.order_payment_update.line_1') }}<br/><br/>
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
                        <strong>{{ __('emails.order_payment_update.line_2') }}</strong>
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
                    <td width="5%" align="center" valign="top">

                    </td>
                    <td width="35%" align="center" valign="top">
                    {{ __('emails.order_payment_update.line_3') }}
                    </td>
                    <td width="35%" align="center" valign="top">
                    {{ __('emails.order_payment_update.line_4') }}
                    </td>
                    <td width="25%" align="center" valign="top">
                    {{ __('emails.order_payment_update.line_6') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><hr/></td>
                </tr>
                <tr>
                    <td width="5%" align="center" valign="top">
                        1.
                    </td>
                    <td width="35%" align="center" valign="top">
                        {{ $order_detail["payment"]["payment_method"] }}
                    </td>
                    <td width="35%" align="center" valign="top">
                        ${{ number_format($order_detail["payment"]["total"],'2','.',',') }}
                    </td>
                    <td width="25%" align="center" valign="top">
                        {{ $order_detail["payment"]["created_at"] }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan='2'><strong>{{ __('emails.order_payment_update.line_7') }}</strong></td>
    </tr>

    <tr>
        <td colspan='2' width="100%">
            <table width="100%">
                <tr>
                    <th width="30%" align="center">

                    </th>
                    <th width="40%" align="center">
                    {{ __('emails.order_payment_update.line_8') }}
                    </th>
                    <th width="10%" align="center">
                    {{ __('emails.order_payment_update.line_9') }}
                    </th>
                    <th width="20%" align="right">
                    {{ __('emails.order_payment_update.line_10') }}
                    </th>
                </tr>
                @foreach($order_detail["order"]["products"] as $product)
                <tr>
                    <td valign="top"  align="center">
                        <img width="100" src="{{ asset('/images/products')}}/{{ $product['img'] }}" alt class="img-fluid"/>
                    </td>
                    <td valign="top" align="center">
                        {{ $product["name"] }}<br/>
                        {{ __('emails.order_payment_update.line_11') }}: {{ $product["size"] }}<br/>
                        {{ __('emails.order_payment_update.line_12') }}: {{ $product["color"] }}
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
                        <strong>{{ __('emails.order_payment_update.line_13') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_total"],'2','.',',') }}
                    </td>
                </tr>
                @if($order_detail['order']['discount_app'] > 0)
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_14') }}</strong>
                    </td>
                    <td align="right">
                        - ${{ number_format($order_detail["order"]["discount_app"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_15') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["subtotal"],'2','.',',') }}
                    </td>
                </tr>
                @endif
                @if($order_detail['order']['allow_shipping']=="true")
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_16') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["shipping_total"],'2','.',',') }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_17') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_tax"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_18') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["grand_total"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_19') }}</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["payment"]["total_paid"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>{{ __('emails.order_payment_update.line_20') }}</strong>
                    </td>
                    <td align="right">
                        @if($order_detail['order']['allow_shipping']=="true")
                        @php( $amount_total = $order_detail["order"]["order_total"] + $order_detail["order"]["order_tax"] + $order_detail["order"]["shipping_total"] )
                        ${{ number_format($amount_total - $order_detail["payment"]["total_paid"],'2','.',',') }}
                        @else
                        @php( $amount_total = $order_detail["order"]["order_total"] + $order_detail["order"]["order_tax"])
                        ${{ number_format($amount_total - $order_detail["payment"]["total_paid"] ,'2','.',',') }}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>