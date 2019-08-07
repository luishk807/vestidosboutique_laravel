<?php

return [

 /*
    |--------------------------------------------------------------------------
    | Email template Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for email templates
    |
    */
    'orders'=>[
      'date_ordered'=>"Pedido recibido",
      'delivered_date'=>'Fecha de entrega',
      'cancelled_date'=>"Fecha de cancelación",
      'shipped_date'=>"Fecha de envío",
      'returned_date'=>'Fecha de devolución',
  ],

  'password_reset'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>'Ha solicitado un correo electrónico de solicitud de cambio de contraseña.',
      'line_2'=>"Haga click en el siguiente enlace para comenzar:",
      'line_3'=>"Cambiar la contraseña",
      'line_4'=>'Fecha de devolución',
  ],

  'user_registry'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>"Bienvenido a Vestidos Boutique.",
      'line_2'=>"Su registro de cuenta ha sido enviado!",
      'line_3'=>"Para activar su cuenta, haga click en el enlace a continuación para verificar",
      'line_4'=>"Activar la cuenta",
      'line_5'=>"Para iniciar sesión cuando visite nuestro pagina simplemente haga click en:",
      'line_6'=>"Email",
  ],
  'user_registry_resend'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>"Bievenido a Vestidos Boutique.",
      'line_2'=>"To active your account, please click the link below for verification!",
      'line_3'=>"Active Account",
      'line_4'=>"To log in when visiting our site just click on:",
      'line_7'=>"Email",
  ],

  'order_admin'=>[
      'line_hello'=>"Hola Admin",
      'line_1'=>'A new order placed :date by :name and has been received.',
      'line_2'=>"Número de Orden:",
      'line_3'=>"Dirección de Facturación",
      'line_4'=>'Dirección de Envío',
      'line_5'=>'Articulo comprado',
      'line_6'=>'Articulo',
      'line_7'=>'Cant',
      'line_8'=>'Total',
      'line_9'=>'Tamaño',
      'line_10'=>'Color',
      'line_11'=>'Subtotal',
      'line_12'=>'Impuesto',
      'line_13'=>'Envío',
      'line_14'=>'Gran total',
  ],

  'order_user_cancel'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>'Este correo electrónico es para confirmar que su pedido ha sido cancelado con éxito. La cantidad de :total',
      'line_2'=>"Número de Orden:",
      'line_3'=>'Dirección de Envío',
      'line_4'=>"Dirección de Facturación",
      'line_5'=>'Articulo comprado',
      'line_6'=>'Articulo',
      'line_7'=>'Cant',
      'line_8'=>'Total',
      'line_9'=>'Tamaño',
      'line_10'=>'Color',
      'line_11'=>'Subtotal',
      'line_12'=>'Impuesto',
      'line_13'=>'Envío',
      'line_14'=>'Gran total',
  ],

  'order_user_received'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>'Gracias por comprar con nosotros. Su pedido realizado :date ha sido recibido. Le enviaremos una confirmación cuando se envíe su artículo.',
      'line_2'=>"Número de Orden:",
      'line_3'=>'Dirección de Envío',
      'line_4'=>"Dirección de Facturación",
      'line_5'=>'Articulo comprado',
      'line_6'=>'Articulo',
      'line_7'=>'Cant',
      'line_8'=>'Total',
      'line_9'=>'Tamaño',
      'line_10'=>'Color',
      'line_11'=>'Subtotal',
      'line_12'=>'Impuesto',
      'line_13'=>'Envío',
      'line_14'=>'Gran total',
  ],

  'order_user_update'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>'Este correo electrónico es para notificarle sobre una actualización de su pedido.',
      'line_2'=>"Número de Orden:",
      'line_3'=>'Dirección de Envío',
      'line_4'=>"Dirección de Facturación",
      'line_5'=>'Articulo comprado',
      'line_6'=>'Articulo',
      'line_7'=>'Cant',
      'line_8'=>'Total',
      'line_9'=>'Tamaño',
      'line_10'=>'Color',
      'line_11'=>'Subtotal',
      'line_12'=>'Impuesto',
      'line_13'=>'Envío',
      'line_14'=>'Gran total',
  ],

  'order_cancel_request'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>'Su solicitud de cancelación de pedido ha sido enviado. Por favor espere 48 horas para completar el proceso.',
      'line_2'=>"Determinaremos si se permite la cancelación. Le enviaremos otro correo electrónico para su confirmación.",
      'line_3'=>"Número de Orden:",
      'line_4'=>'Dirección de Envío',
      'line_5'=>'Dirección de Facturación',
      'line_6'=>'Articulo comprado',
      'line_7'=>'Articulo',
      'line_8'=>'Cant',
      'line_9'=>'Total',
      'line_10'=>'Tamaño',
      'line_11'=>'Color',
      'line_12'=>'Subtotal',
      'line_13'=>'Impuesto',
      'line_14'=>'Envío',
      'line_15'=>'Gran total',
  ],

  'order_cancel_admin'=>[
      'line_1'=>'Hola Admin',
      'line_2'=>"Una nueva solicitud de cancelación de pedido has sido recibida.",
      'line_3'=>"Número de Orden:",
      'line_4'=>'Dirección de Envío',
      'line_5'=>'Dirección de Facturación',
      'line_6'=>'Articulo comprado',
      'line_7'=>'Articulo',
      'line_8'=>'Cant',
      'line_9'=>'Total',
      'line_10'=>'Tamaño',
      'line_11'=>'Color',
      'line_12'=>'Subtotal',
      'line_13'=>'Impuesto',
      'line_14'=>'Envío',
      'line_15'=>'Gran total',
  ],
  
  'new_email_admin'=>[
      'line_1'=>'Nuevo correo electrónico recibido',
      'line_2'=>"Nombre:",
      'line_3'=>"Email:",
      'line_4'=>'Teléfono:',
      'line_5'=>'País:',
      'line_6'=>'Mensaje:',
  ],

  'admin_user_update'=>[
      'line_hello'=>'Hola :name',
      'line_1'=>"Para iniciar sesión cuando visite nuestro sitio, simplemente haga click en:",
  ],

  'order_admin_received'=>[
      'line_hello'=>"Hola :name",
      'line_1'=>'Bievenido a Vestidos Boutique.',
      'line_2'=>"Se ha creado el registro de su cuenta :type!",
      'line_3'=>"Para iniciar sesión cuando visite nuestro sitio, simplemente haga click en:",
      'line_4'=>'Email',
  ],

      
];
