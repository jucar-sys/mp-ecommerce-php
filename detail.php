<?php
    include 'templates/head.php';
    include 'templates/header.php';
    include 'modelo_carrito.php';
?>

            <!-- -------------------- CONTENIDO ---------------------- -->
    <?php
        if($_POST){
            $id = $_POST['id_prod'];
            $nombre = $_POST['title'];
            $img = $_POST['img'];
            $precio = $_POST['price'];
            $cantidad = $_POST['unit'];

            // DATOS
            date_default_timezone_set("America/Mexico_City");
            $fecha = date("Y-m-d H:i:s");


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
            $payer->email = "test_user_58295862@testuser.com";
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
            $item = new MercadoPago\Item();
            $item->id = $id;
            $item->title = $nombre;
            $item->description = "Dispositivo móvil de Tienda e-commerce";
            $item->picture_url = URLIMG.$img;
            $item->quantity = 1;
            $item->unit_price = $precio;
            // $item->currency_id = "MXN";


            // Integramos el item a la lista de items
            $preference->items = array($item);
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

            <div class="as-search-results as-filter-open as-category-landing as-desktop" id="as-search-results">

                <div id="accessories-tab" class="as-accessories-details">
                    <div class="as-accessories" id="as-accessories">
                        <div class="as-accessories-header">
                            <div class="as-search-results-count">
                                <span class="as-search-results-value"></span>
                            </div>
                        </div>
                        <div class="as-searchnav-placeholder" style="height: 77px;">
                            <div class="row as-search-navbar" id="as-search-navbar" style="width: auto;">
                                <div class="as-accessories-filter-tile column large-6 small-3">

                                    <button class="as-filter-button" aria-expanded="true" aria-controls="as-search-filters" type="button">
                                        <h2 class=" as-filter-button-text">
                                            Smartphones
                                        </h2>
                                    </button>


                                </div>

                            </div>
                        </div>
                        

                            <div class="width:60%">
                                <div class="as-producttile-tilehero with-paddlenav " style="float:left;">
                                    <div class="as-dummy-container as-dummy-img">

                                        <img src="./assets/wireless-headphones" class="ir ir item-image as-producttile-image  " style="max-width: 70%;max-height: 70%;"alt="" width="445" height="445">
                                    </div>
                                    <div class="images mini-gallery gal5 ">
                                    

                                        <div class="as-isdesktop with-paddlenav with-paddlenav-onhover">
                                            <div class="clearfix image-list xs-no-js as-util-relatedlink relatedlink" data-relatedlink="6|Powerbeats3 Wireless Earphones - Neighborhood Collection - Brick Red|MPXP2">
                                                <div class="as-tilegallery-element as-image-selected" style="max-width: 550px; padding: 25px!important">
                                                    <div class=""></div>
                                                    <img src="<?php echo $img; ?>" class="ir ir item-image as-producttile-image" alt="" width="445" height="445" style="content:-webkit-image-set(url(<?php echo $img; ?>) 2x);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="as-producttile-info" style="float:left;min-height: 168px;">
                                    <div class="as-producttile-titlepricewraper" style="min-height: 128px;">
                                        <div class="as-producttile-title">
                                            <h3 class="as-producttile-name">
                                                <p class="as-producttile-tilelink" style="margin-bottom: 10px">
                                                    <span data-ase-truncate="2"><?php echo $nombre; ?></span>
                                                </p>

                                            </h3>
                                        </div>
                                        <h3 style="margin-bottom: 10px">
                                            <?php echo '$'. number_format($precio, 2);  ?>
                                        </h3>
                                        <h3 style="margin-bottom: 10px">
                                            <?php echo $cantidad . ' Pzas' ?>
                                        </h3>
                                    </div>

                                    <!-- ----------------------------------------------------- -->
                                    <div class="container my-5">
                                        <!--------------- Mercado Pago INTEGRATION ------------>
                                        <form action="verificador_pp.php" method="POST" class="my-5">
                                            <div><a href="<?= $preference->init_point ?>" class="mercadopago-button p-3" >Pagar la compra</a></div>
                                        </form>
                                        <!-- ----------------------------------------- -->        
                                    </div><!-- .container -->
                                    <!-- ----------------------------------------------------- -->

                                </div>
                            </div>
                        </div><!-- .as-accessories-results  as-search-desktop -->
                        <!-- ------------------------------------------------------- -->

                    </div><!-- .as-accessories -->
                </div><!-- .accessories-tab -->
            </div><!-- .as-search-results as-filter-open as-category-landing as-desktop -->
        </div><!-- .as-search-wrapper -->

    <!-- Security de Mercado Pago -->
    <script src="https://www.mercadopago.com/v2/security.js" view="item"></script>
    <!-- -------------------------- -->
    <?php
        include 'templates/footer.php';
    ?>