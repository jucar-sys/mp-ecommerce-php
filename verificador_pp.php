<?php
    include_once 'templates/head.php';
    include_once 'templates/header.php';
    include_once 'includes/funciones_carrito.php';
    include_once 'modelo_carrito.php';
?>
<!-- -------------------------------------------------------- -->

    <!-- -------------------- CONTENIDO ---------------------- -->
    <?php
        if(isset($_GET)){
            $idPago = $_GET['collection_id'];
            $referenciaExterna = $_GET['external_reference'];
            $metodoPago = $_GET['payment_type'];

            /* ================================== MERCADO PAGO ================================== */
                if($_GET['status'] == 'success'){
                    // Destruimos la sesion actual para borrar los elementos del carrito de compras
                    sessionDestroy();
            ?>
                    <!-- ----------------------------------------------------- -->
                    <div class="container my-5">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">¡Listo!</h1>
                            <hr class="my-4">
                                <h4>PAGO APROBADO</h4>
                                <p>Tu pago ha sido aprobado. Tu compra será enviada lo antes posible</p></br>
                                <ul>
                                    <li><b>ID del Pago: </b><?php echo $idPago; ?></li>
                                    <li><b>Referencia Externa: </b><?php echo $referenciaExterna; ?></li>
                                    <li><b>Método de pago: </b><?php echo $metodoPago; ?></li>
                                </ul>
                                <p>Dudas: <strong><b>contacto@mail.mx</b></strong></p>
                        </div><!-- .jumbotron -->
                    </div><!-- .container -->
                    <!-- ----------------------------------------------------- -->
            <?php
                }
                if($_GET['status'] == 'failure'){               
                ?>
                    <!-- ----------------------------------------------------- -->
                    <div class="container my-5">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">¡Rechazado!</h1>
                            <hr class="my-4">
                                <h4>PAGO RECHAZADO</h4>
                                <p>Tu pago fue rechazado. Intentalo de nuevo y si continuas con el problema ponte en contacto con Mercado Pago</br>
                                 Dudas: <strong><b>contacto@mail.mx</b></strong>
                            </p>
                        </div><!-- .jumbotron -->
                    </div><!-- .container -->
                    <!-- ----------------------------------------------------- -->
            <?php
    
                }
                if($_GET['status'] == 'pending'){
    
                    // Destruimos la sesion actual para borrar los elementos del carrito de compras
                    sessionDestroy();
                ?>
                    <!-- ----------------------------------------------------- -->
                    <div class="container my-5">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">¡Pendiente!</h1>
                            <hr class="my-4">
                                <h4>PAGO PENDIENTE</h4>
                                <p>Tu pago está pendiente, una vez lo recibamos te enviaremos tus productos.</br>
                                 Dudas: <strong><b>contacto@mail.mx</b></strong>
                            </p>
                        </div><!-- .jumbotron -->
                    </div><!-- .container -->
                    <!-- ----------------------------------------------------- -->
            <?php
                }
            /* ================================================================================== */
        }
        
    ?>
    

    <!-------------------------- Fotter --------------------------->
    <!-- Security de Mercado Pago -->
    <script src="https://www.mercadopago.com/v2/security.js" view=""></script>
    <!-- -------------------------- -->
    <?php
        include_once 'templates/footer.php';
    ?>
    <!-- -------------------------------------------------------- -->