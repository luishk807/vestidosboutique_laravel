@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
                <div class="container-in-space white-md-bg-in terms-container">
                <h2>{{$page_title}}</h2>
                <br/>
                <p>Términos y Condiciones Generales A continuación, nuestros Términos y condiciones generales, los cuales se aplican a la prestación de todos los servicios en <b>{{ $configData['url'] }}</b> le ofrecemos una experiencia de compras personalizada y servicios a la medida de sus intereses y necesidades. En <b>{{ $configData['url'] }}</b> vendemos vestidos de fiestas, quinceañeras y artículos en STOCK y por pedido especiales de nuestro selecto proveedores.</p>
                <ol>
                    <li><b>Para pedido</b>
                        <ol>
                            <li>Para los pedidos online realizados en <b>{{ $configData['url'] }}</b>  debe registrarse en nuestra página. </li>
                            <li>Al &#34;Proceder a Pago&#34;, está realizando un pedido de los artículos que aparecen en el CARRITO. Una vez procesado el pedido, recibirá la notificación vía email o&#47;y whatsaap con la confirmación con detalle de la orden, la disponibilidad del artículo, detalle de forma de pago y la fecha estimada de entrega del producto.</li>
                            <li>El contrato se formaliza en el momento en que reciba la confirmación de pedido por nuestra parte y una vez realizado el pago del abono del 50&#37; del precio total del pedido y gasto adicional de envió en caso necesario.</li>
                            <li>El saldo restante del 50&#37; se debe cancelar en la entrega del producto o artículo.</li>
                        </ol>
                    </li>
                    <li><b>Forma de Pago</b>
                        <ol>
                            <li>Aceptamos las siguientes formas de pago para su pedido en línea en <b>{{ $configData['url'] }}</b>:
                                <ul>
                                    <li>ACH Transferencia Bancaria o depósito bancario
                                        <ul>
                                            <li>Una vez procesado el pedido, el email de confirmación recibirá los datos para la transferencia bancaria, la cual debe realizarse en el plazo de 3 días laborales desde la fecha de confirmación del pedido, de lo contrario la orden será cancelada.</li>
                                            <li>Para ampliar y extender el plazo solicitar a través  del <b>{{ $configData['sales_email'] }}</b></li>
                                            <li>Una vez realizado el pago debe enviar el comprobante a nuestro correo <b>{{ $configData['sales_email'] }}</b> para agilizar el proceso.</li>
                                        </ul>
                                    <li>Tarjeta de crédito y débito
                                        <ul>
                                            <li>Para pagos en tarjetas VISA, Master Card, American Express o Clave debe pasar a nuestra tienda ubicada en El Cangrejo, Calle Eusebio A. Morales planta baja del Hotel Milán</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ol>
                    </li>
                    <li><b>Plazo de Entrega</b>
                        <ol>
                            <li>Los artículos categorizado como &#42;en STOCK&#42; esta disponible para entrega inmediata y los artículos categorizado como &#42;Pedido Especial&#42; tiene una fecha estimada de entrega entre 4 a 14 semanas dependiendo de nuestros proveedores.</li>
                        </ol>
                    </li>
                    <li><b>Devolución y Cambios</b>
                        <ol>
                            <li>La solicitud de devolución debe hacer dentro de los 10 días posteriores a la entrega y recepción del pedido. Si pasan 10 días, no podemos aceptar su solicitud.</li>
                            <li>Los artículos devueltos deber estar sin usar, sin lavar, sin modificaciones, con etiquetas y embalajes. Accesorios deben devolverse juntos.</li>
                            <li>Se le aplicará una tasa de reposición del 20&#37; sobre el valor del producto de las ordenes procesado como &#42;PEDIDO ESPECIAL&#42; y para las ordenes procesada con productos &#42;EN STOCK&#42; se le aplicará una tasa de reposición del 20&#37; sobre el valor del producto para los casos con envíos hacia el interior del país.</li>
                        </ol>
                    </li>
                    <li><b>Cancelación</b>
                        <ol>
                            <li>Si no se ha efectuado un pago a su pedido, puede cancelarla fácilmente enviando los datos a nuestro email <b>{{ $configData['sales_email'] }}</b> </li>
                            <li>Si su pedido ha sido pagado y aún está en status &#34;en proceso&#34;, puede solicitar la cancelación a través de nuestro email <b>{{ $configData['sales_email'] }}</b>. Por favor contáctenos si desea cancelar algunos artículos en el pedido. Si se comunica con nosotros para cancelar dentro de las 24 horas posteriores al pago, le daremos un reembolso completo. Si han transcurrido más de 24 horas, le cobraremos un cargo por cancelación de 25&#37; del valor pagado.</li>
                            <li>Una vez que su pedido ha sido &#34;procesado&#34;, no se podrá cancelar. Aplica la política de &#42;Devolución y Cambios&#42;</li>
                        </ol>
                    </li>
                    <li><b>Reembolsos</b>
                        <ol>
                            <li>El reembolso se efectuará a la misma forma de pago utilizado. Para pagos realizado a través de transferencia bancaria, el reembolso será enviado a la cuenta desde la que se realizó el pago.</li>
                        </ol>
                    </li>
                    <li><b>Responsabilidad</b>
                        <ol>
                            <li>Hay casos en los cuales una orden de compra puede no ser procesada por circunstancias ajenas a nosotros, <b>{{ $configData['url'] }}</b>, informará al cliente de inmediato el motivo por el cual no fue posible procesar una orden, reembolsando cualquier cantidad cobrada al suscriptor, dejando claro que en este proceso se puede pedir información adicional para completar el proceso de reembolso.</li>
                            <li>Todos los productos en el sitio <b>{{ $configData['url'] }}</b>, están sujetos a disponibilidad, por lo que puede darse el caso que un mismo producto pueda ser adquirido por varios clientes a la vez y al final del proceso de venta resulte que el producto ya no se encuentre disponible por haberse agotado, aun y cuando aparezca en el sitio web <b>{{ $configData['url'] }}</b>, en cuyo caso se le informara al cliente de tal situación procediendo al reembolso de cualquier cantidad pagada por el producto adquirido si es el caso o bien se le notificara de la imposibilidad de procesar la orden de compra.</li>
                            <li>{{ $configData['url'] }} limita su responsabilidad en cuanto a los siguientes casos:
                                <ul>
                                    <li>Como un manual de medición, la talla física puede ser ligeramente diferente de la tabla de talla.</li>
                                    <li>Debido a la luz de fotografía y la configuración de pantalla, color físico puede ser poco diferente que la foto de la página.</li>
                                    <li>Tener en cuenta de que debido a la característica de material, algunos artículos pueden tener olor, pérdida de color, hilado y arrugas, eso no se calculan como problema de calidad.</li>
                                </ul>
                            </li>
                        </ol>
                    </li>
                </ol>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection