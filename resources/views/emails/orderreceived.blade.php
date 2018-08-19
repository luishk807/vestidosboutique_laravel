<table>
    <tr>
        <td><img src="{{ asset('/images/vestidos_boutique_image.jpg') }}" class="img-fluid" alt=""></td>
        <td>{{ $status }}</td>
    </tr>
    <tr>
        <td colspan='2'>
            Hello {{ $name }}, <br/><br/>
            Thank you for shopping with us.  Your order has been received. We will send you a confirmation when your item ships.
        </td>
    </tr>
    <tr>
        <td>
            Order Number:
        </td>
        <td>
            {{ $order_number }}
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
            {{ $billing["name"] }}
        </td>
        <td>
            {{ $shipping["name"] }}
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
                @foreach($orders->products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('/images/products')}} / {{ $product->getProduct->first()->img_url }}" alt class="img-fluid"/>
                    </td>
                    <td>
                        {{ $product->getProduct->products_name }}
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

    <tr>
        <td>Name:</td>
        <td>{{$client["first_name"]." ".$client["last_name"]}}</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>{{$client["email"]}}</td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td>{{$client["phone"]}}</td>
    </tr>
    <tr>
        <td>Country</td>
        <td>{{$client["country"]}}</td>
    </tr>
    <tr>
        <td>Message:</td>
        <td>{{$client["message"]}}</td>
    </tr>
</table>