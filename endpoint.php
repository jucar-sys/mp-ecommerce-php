<?php
    include_once 'templates/head.php';
    include_once 'templates/header.php';
    include_once 'modelo_carrito.php';
?>
<!-- -------------------------------------------------------- -->

    <!-- -------------------- CONTENIDO ---------------------- -->
    <?php
        $resp = 'NO entró al post';
        if($_POST){

            MercadoPago\SDK::setAccessToken(ACC_TOKEN);
            $resp = 'entró al post';

            switch($_POST["type"]) {
                case "payment":
                    $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
                    $_SESSION['notify'] = 'Entro a payments';
                break;
                case "plan":
                    $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
                    $_SESSION['notify'] = 'Entro a plan';
                break;
                case "subscription":
                    $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
                    $_SESSION['notify'] = 'Entro a subscription';
                break;
                case "invoice":
                    $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
                    $_SESSION['notify'] = 'Entro a invoice';
                    break;
            }

        }

    ?>  
    
    <!-- ----------------------------------------------------- -->
    <div class="container my-5">
        <div class="jumbotron text-center">
            <h1 class="display-4">Obteniendo notificaciones de Mercado Pago...</h1>
            <?php echo $_SESSION['notify']; ?>
            <?php echo $resp; ?>
            <?php
                echo '<pre>';
                var_dump($_SESSION['notify']);
                echo $resp;
                echo '</pre>';
                ?>
            <?php print ($_SESSION['notify']); ?>
            <?php echo $resp; ?>
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