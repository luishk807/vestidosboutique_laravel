<table>
    <tr>
        <td align="left"><img width="200" src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td align="right" valign="bottom"></td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello Admin, <br/><br/>
            A new order placed {{ $order_detail["order"]["purchase_date"] }} by {{ $order_detail["user"]["first_name"]}} and has been received.
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
                        <strong>Order Number:</strong>
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
                    <td width="50%" align="left" valign="top">
                        <strong>Billing Address</strong>
                    </td>
                    <td width="50%" align="left" valign="top">
                        <strong>Shipping Address</strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td width="50%" align="left" valign="top">
                        {{ $order_detail["order"]["shipping_name"] }}<br/>
                        {{ $order_detail["order"]["shipping_address_1"] }}<br/>
                        {{ $order_detail["order"]["shipping_address_2"] }}<br/>
                        {{ $order_detail["order"]["shipping_province"] }} {{ $order_detail["order"]["shipping_district"] }} {{ $order_detail["order"]["shipping_corregimiento"] }} {{ $order_detail["order"]["shipping_zip_code"] }}<br/>
                        {{ $order_detail["order"]["shipping_country"] }}<br/>
                    </td>
                    <td width="50%" align="left" valign="top">
                        {{ $order_detail["order"]["billing_name"] }}<br/>
                        {{ $order_detail["order"]["billing_address_1"] }}<br/>
                        {{ $order_detail["order"]["billing_address_2"] }}<br/>
                        {{ $order_detail["order"]["billing_province"] }} {{ $order_detail["order"]["billing_district"] }} {{ $order_detail["order"]["billing_corregimiento"] }} {{ $order_detail["order"]["billing_zip_code"] }}<br/>
                        {{ $order_detail["order"]["billing_country"] }}<br/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan='2'><strong>Item Purchased</strong></td>
    </tr>

    <tr>
        <td colspan='2' width="100%">
            <table width="100%">
                <tr>
                    <th width="30%" align="center">

                    </th>
                    <th width="40%" align="center">
                        Item
                    </th>
                    <th width="10%" align="center">
                        Quant
                    </th>
                    <th width="20%" align="right">
                        Total
                    </th>
                </tr>
                @foreach($order_detail["order"]["products"] as $product)
                <tr>
                    <td valign="top"  align="center">
                        <img width="100" src="{{ asset('/images/products')}}/{{ $product['img'] }}" alt class="img-fluid"/>
                    </td>
                    <td valign="top" align="center">
                        {{ $product["name"] }}<br/>
                        Size: {{ $product["size"] }}<br/>
                        Color: {{ $product["color"] }}
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
                        <strong>Subtotal</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_total"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>Tax</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_total"] * $order_detail["order"]["order_tax"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>Shipping</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["shipping_total"],'2','.',',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <strong>Grandtotal</strong>
                    </td>
                    <td align="right">
                        ${{ number_format($order_detail["order"]["order_total"] + ($order_detail["order"]["order_total"] * $order_detail["order"]["order_tax"]) + $order_detail["order"]["shipping_total"],'2','.',',') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>