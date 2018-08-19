<table>
    <tr>
        <td><img src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td>{{ $order_detail["status"] }}</td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello {{ $client_name }}, <br/><br/>
            Thank you for shopping with us.  Your order placed {{ $order_detail["order"]["purchase_date"] }} has been received. We will send you a confirmation when your item ships.
        </td>
    </tr>
    <tr>
        <td>
            Order Number:
        </td>
        <td>
            {{ $order_detail["order"]["order_number"] }}
        </td>
    </tr>
    <tr>
        <td>
            Billing Address
        </td>
        <td>
            Shipping Address
        </td>
    </tr>
    <tr>
        <td>
            {{ $order_detail["order"]["ship_address"]["name"] }}
        </td>
        <td>
            {{ $order_detail["order"]["bill_address"]["name"] }}
        </td>
    </tr>
    <tr>
        <td colspan='2'>Item Purchased</td>
    </tr>

    <tr>
        <td>
            <table>
                <tr>
                    <th>

                    </th>
                    <th>
                        Item
                    </th>
                    <th>
                        Quant
                    </th>
                    <th>
                        Total
                    </th>
                </tr>
                @foreach($order_detail["products"] as $product)
                <tr>
                    <td>
                        <img src="{{ asset('/images/products')}} / {{ $product->getProduct->first()->img_url }}" alt class="img-fluid"/>
                    </td>
                    <td>
                        {{ $product->getProduct->products_name }}<br/>
                        {{ $product->getSize->name }}<br/>
                        {{ $product->getColor->name }}
                    </td>
                    <td>
                        {{ $product->quantity }}
                    </td>
                    <td>
                        {{ $product->total }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>