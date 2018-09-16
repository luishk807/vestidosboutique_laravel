<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Basic General Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used general text
    |
    */

    //FORMS
    'form'=>[
        'name' => 'Nombre',
        'nickname'=> 'SobreNombre',
        'first_name'=>"Nombre",
        'middle_name'=>"Segundo Nombre",
        'last_name'=>"Apellido",
        'email'=>"Email",
        'telephone'=>"Teléfono",
        'address'=>"Dirección | Direcciones",
        'city'=>"Ciudad",
        'state'=>"Estado",
        'country'=>"País",
        'zip'=>"Codigo Postal",
        'password'=>"Contraseña",
        'question'=>"Pregunta",
        'retype_password'=>"Re-escriba Tu Contraseña",
        'gender'=>"Genero",
        'dob'=>"Fecha de Nacimiento",
        'language'=>"Idioma | Idiomas",
        'select_country'=>"Escoga su País",
        'select_language'=>"Escoga tu idioma | Escoga tu idiomas",
    ],
    'payment_info'=>[
        'card'=>'Numero',
        'type'=>'Tarjeta',
        'status'=>"Estatus",
        'date'=>"Fecha"
    ],
    //PAGE HEADER
    'page_header'=>[
        'address_type'=>"Tipo de Dirección",
        'select_address_type'=>"Elija el tipo de dirección",
        'shipping_address'=>"Dirección de Envio",
        'billing_address'=>"Dirección de Facturación",
        'choose_delivery'=>'Elija el Metodo de Envio',
        'optimized_search'=>"Optimizar Busqueda",
        'payment_method'=>"Metodo de Pago",
        'order_summary'=>"Resumen de Orden",
        'opening_hours'=>"Horario de Apertura",
        'choose_billing_payment'=>"Escoga Facturación y Metodo de Pago",
        'provice_billing_payment'=>'Llene la Facturación y Metodo de Pago',
        'select_shipping'=>'Escoga Dirección de Envio',
        'provide_shipping'=>'Llene la Dirección de Envio',
        'edit_account'=>"Editar Cuenta",
        'new_account'=>"Nueva Cuenta",
        'review_name'=>'Comentario para :name',
        'welcome' => 'Bienvenido, :name',
        'welcome_page'=>"Pagina de bienvenida",
        'delete_order'=>"Borrar Orden",
        'cancel_order'=>"Cancelar Orden",
        'order_detail'=>"Detalle del Orden",
        'top_dresses'=>"Mejores Vestidos",
        'top_quince'=>"Mejores Vestidos de Quinceañera",
        'payment'=>"Pago",
        'confirmation'=>"Confirmación",
        'account_created'=>'Cuenta Creada',
        'account_not_created'=>"Ops! Su Cuenta No Pudo Ser Creada",
        'ops'=>"Ops!",
        'logout'=>"Cierre de Sesión",
        'order_received'=>"Orden Recibida",
        'error_page'=>"Página de Error",
    ],
    'order_section' =>[
        'order_updated'=>'Orden actualizado',
        'payment_success'=>'El pago fue procesado con éxito!',
        'order_received'=>'Orden Recibida',
        'order_completed'=>'Orden ha Sido Completada',
        'order_success_created'=>'Éxito: su orden ha sido creada',
        'order_success_created_none'=>'Orden de creada con éxito',
        'order_success_received'=>'Éxito: Su pedido ha sido recibido',
        'order_success_deleted'=>'Orden eliminada con éxito',
        'received_to_process'=>"Gracias por su orden! estamos procesando su pedido; una vez que se actualice su orden, se lo notificaremos de inmediato!.",
        'unable_delete'=>'Lo sentimos, su orden no se pudo cancelar',
        'cancel_request'=>'Solicitud de cancelación de pedido enviada',
        'new_order'=>'Nueva Orden',
        'edit_order'=>"Editar Orden",
        'new_order_address'=>'Nueva Orden | Dirección',
        'new_order_checkout'=>"Nueva Orden | Pago",
        'new_order_products'=>"Nueva Orden | Agregar Productos",
        'edit_order_address'=>"Editar Dirección de :name de Orden",
        'address_saved'=>'Dirección guardada con éxito',
        'confirm_cancellation'=>'Confirmar la cancelación de la orden',
        'process_order'=>"Proceso de Pago de Orden",
        'cancel_success'=>"Orden cancelada con éxito",
        'delete_name'=>'Eliminar :name de las órdenes',
        'order_address'=>"Dirección del pedido",
        'to_user'=>[
            'received'=>'Hola :name, gracias por tu pedido',
            'cancel_confirmation'=>'Hola :name, tu confirmación de cancelación',
            'updated'=>'Hola :name, tu pedido ha sido actualizado',
            'cancel'=>'Hola :name, su orden es cancelada',
        ],
        'to_admin'=>[
            'received'=>"Hola Administrador, nueva orden recibida de :name",
            'cancel_confirmation'=>'Hola administrador, nueva cancelación de orden de :name',
        ],
    ],
    'user_section'=>[
        'registration_complete'=>'Hola, :name, El registro de su cuenta ha sido completado.',
        'create_address'=>'Crear Dirección',
        'edit_address'=>"Editar dirección :name",
        'delete_address'=>'Eliminar dirección',
        'account_created'=>"Su cuenta fue creada con éxito",
        'account_not_created'=>'Se produjo un problema inesperado, intente de nuevo más tarde',
        'to_user'=>[
            'thank_you'=>'Hello :name, thank you for your email',
        ],
        'to_admin'=>[
            'thank_you'=>'New Email From :name Received',
        ],
    ],
    'address_section'=>[
        'invalid'=>"Invalid Address",
    ],
    'rate_title'=>[
        'your_rate'=>"Tu Puntaje",
        'headline'=>"Titulo",
        'edit_rate'=>"Editar Comentario",
        'delete_rate'=>"Borrar Puntaje",
        'remove_rate'=>"Remover Puntaje",
        'comment'=>"Tu Opinion",
        'product_review_title'=>"Comentario para Producto: :name",
    ],
    'access_section'=>[
        'denied'=>"Acceso Denegado.",
        'invalid_access'=>"Acceso invalido",
    ],
    //CART TITLES
    'cart_title'=>[
        'shipping'=>"Envío",
        'billing'=>"Facturación",
        'confirmation'=>"Confirmación",
        'qty'=>"Cant",
        'sell_by'=>"Por",
        'item'=>"Articulo | Articulos",
        'product'=>"Producto | Productos",
        'ship_to'=>"Enviado A",
        'bill_to'=>"Facturado A",
        'order'=>"Pedido | Pedidos",
        'quantity'=>"Cantidad | Cantidades",
        'shipping_handling'=>"Costo de Envio",
        'estimated_tax'=>"Estimado de Impuesto",
        'total_price'=>"Precio Total",
        'order_total'=>"Total",
        'grand_total'=>"Gran Total",
        'subtotal'=>"Subtotal",
        'total'=>"Total | Totales",
        'item_removed'=>":name Removido",
        'item_updated'=>"Articulo Actualizado",
        'item_added'=>"Articulo Agregado",
        'cart_updated'=>"Carrito Actualizado",
        'cart_error'=>"Ops!, Error Sucedido!",
    ],

    //DATES
    'dates_title'=>[
        'date_ordered'=>"Fecha de Orden",
        'delivered_date'=>'Fecha Recibido',
        'cancelled_date'=>"Fecha Cancelado",
        'shipped_date'=>"Fecha Enviado",
        'returned_date'=>'Fecha Retornado',
    ],

    //PRODUCT TITLE
    'product_title'=>[
        'new'=>"Nuevo",
        'price'=>"Precio | Precios",
        'unit_price'=>"Precio | Precios",
        'in_stock'=>"Disponible",
        'out_stock'=>"No Disponible",
        'model_id'=>"No. de Modelo",
        'tax'=>"Impuesto",
        'size'=>"Tamaño",
        'color'=>"Color | Colores",
        'select_color'=>"Escoga el Color",
        'select_size'=>"Escoga el Tamaño",
        'detail'=>"Detalle",
        'description'=>"Descripcion",
        'missing_size_color'=>"Missing Size or Colors definition for :name",
        'select_product'=>'Debes seleccionar un producto',
        'product_name'=>"Producto: :name",
    ],


    //MENSAJES
    'empty_msg'=>[
        'wishlist'=>"Tu Lista esta vacio",
        'cart'=>"Tu Carrito esta vacio",
        'order'=>"No Hay Pedidos Encontrados",
    ],

     //Weekdates
     'weekdays'=>[
        'monday'=>"Lunes",
        'tuesday'=>"Martes",
        'wednesday'=>"Miercoles",
        'thursday'=>"Jueves",
        'friday'=>"Viernes",
        'saturday'=>"Sabado",
        'sunday'=>"Domingo",
     ],
     'also_loved'=>"La Gente Tambien Gustaron",
     'got_question'=>"Tiene Preguntas? Llamenos",
     'payment_final_step_msg'=>"Aqui es la etapa final para tu orden",
     'optimized_search'=>"Mejorar Busqueda",
     'vendor'=>'Vendedor',
     'removed'=>"Removido",
     'unable_save'=>"No se puede guardar",
     'thank_you'=>"Gracias",

];