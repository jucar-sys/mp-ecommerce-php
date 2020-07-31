<?php
    include_once 'includes/config.php';

    // if($_GET){
    //     file_put_contents(
    //         'registro.log',
    //         json_encode($_GET) . PHP_EOL,
    //         FILE_APPEND
    //     );
    // }

    $body = @file_get_contents('php://input');
    $data = json_decode($body);
        
    file_put_contents(
        'registro.log',
        json_encode($data) . PHP_EOL,
        FILE_APPEND
    );

    // SDK de Mercado Pago
    require __DIR__ .  '/vendor/autoload.php';
    MercadoPago\SDK::setAccessToken(ACC_TOKEN);

    switch($_POST["type"]) {
        case "payment":
            $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        break;
        case "plan":
            $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
        break;
        case "subscription":
            $subscription = MercadoPago\Subscription.find_by_id($_POST["id"]);
        break;
        case "invoice":
            $invoice = MercadoPago\Invoice.find_by_id($_POST["id"]);
            break;
        default:
        break;
    }
    
?>  