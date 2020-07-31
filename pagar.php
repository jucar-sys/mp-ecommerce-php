<?php
    include_once 'templates/head.php';
    include_once 'templates/header.php';
    include_once 'modelo_carrito.php';
?>
<!-- -------------------------------------------------------- -->

    <!-- -------------------- CONTENIDO ---------------------- -->
    <?php
        if($_POST){

            // DATOS
            date_default_timezone_set("America/Mexico_City");
            $fecha = date("Y-m-d H:i:s");

            // Inicializamos las variables
            $items = array ();
            $total = 0;

            // Recorremos nuestro carrito y vamos sumando los totales
            foreach ($_SESSION['carrito'] as $index => $producto) {
                // Obtenemos el total del carrito
                $total = $total + ($producto['precio_unitario'] * $producto['cantidad']);
            }

            // ------------------- INTEGRACION DE MERCADO PAGO -------------------- //
            // SDK de Mercado Pago
            require __DIR__ .  '/vendor/autoload.php';
            
            // Agrega credenciales
            MercadoPago\SDK::setAccessToken(ACC_TOKEN);
            // Integrator ID
            MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);
            // Crea un objeto de preferencia
            $preference = new MercadoPago\Preference();

            $preference->external_reference = "jucar.sys@gmail.com";
            $preference->notification_url = ENDPOINT;
            
            // Datos del comprador
            $payer = new MercadoPago\Payer();
            $payer->name = "Lalo Landa";
            $payer->surname = "";
            $payer->email = "test_user_58295862@testuser.com";
            $payer->date_created = $fecha;
            $payer->phone = array(
                "area_code" => "52",
                "number" => "5549737300"
            );
            $payer->address = array(
                "street_name" => "Insurgentes Sur",
                "street_number" => "1602",
                "zip_code" => "03940"
            );
            // ......................... //

            // Crea un ítem en la preferencia
            // Recorremos nuestro carrito y vamos agregando los productos
            foreach ($_SESSION['carrito'] as $index => $producto) {
                $item = new MercadoPago\Item();
                $item->id = $producto['id'];
                $item->title = $producto['nombre'];
                $item->picture_url = URLIMG.$producto['url_img'];
                $item->description = $producto['descripcion'];
                $item->category_id = 'phones';
                $item->quantity = $producto['cantidad'];
                $item->currency_id = "MXN";
                $item->unit_price = $producto['precio_unitario'];

                array_push($items, $item);
            }

            // Integramos el item a la lista de items
            $preference->items = $items;
            //.........................//
            
            // Links de retorno despues del pago según el resultado
            $preference->back_urls = array(
                "success" => SUCCESS,
                "failure" => FAILURE,
                "pending" => PENDING
            );
            $preference->auto_return = "approved";

            /* Definicon de medios de pago */
            $preference->payment_methods = array(
                "excluded_payment_methods" => array(
                    array("id" => "amex")
                ),
                "excluded_payment_types" => array(
                    array("id" => "atm")
                ),
                "installments" => 6
            );
            // ...============================

            $preference->save();
            // .........................................
            /* ------------------------------------------------------------------------------------- */
        }

    ?>  
    
    <!-- ----------------------------------------------------- -->
    <div class="container my-5">
        <div class="jumbotron text-center">
            <h1 class="display-4">¡Paso Final!</h1>
            <hr class="my-4">
            <p class="lead">Estás a punto de pagar la cantidad de: 
                <h4>$<?php echo number_format($total, 2) ?></h4>
            </p>

            <!--------------- Mercado Pago INTEGRATION ------------>
            <form action="verificador_pp.php" method="POST" class="my-5">
                <!-- FORM MODAL -->
                <!-- <script
                src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php // echo $preference->id; ?>"
                data-button-label="Pagar la compra">
                </script> -->
                <!-- -------- -->
                <!-- REDIRECT -->
                <div><a href="<?= $preference->init_point ?>" class="mercadopago-button p-3" >Pagar la compra</a></div>
            </form>
            <!-- ----------------------------------------- -->        
            
            <p>Tus productos se enviarán una vez se procese el pago. </br>
                Dudas: <strong><b>contacto@mail.mx</b></strong>
            </p>
        </div><!-- .jumbotron -->
    </div><!-- .container -->
    <!-- ----------------------------------------------------- -->


    <!-------------------- Fotter --------------------->
    <!-- Security de Mercado Pago -->
    <script src="https://www.mercadopago.com/v2/security.js" view=""></script>
    <!-- -------------------------- -->

    <?php
        include_once 'templates/footer.php';
    ?>
    <!-- -------------------------------------------------------- -->