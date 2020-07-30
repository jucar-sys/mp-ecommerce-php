<?php
    // ENCRIPTACION
    define("KEY", "JuCarExaMP2020");
    define("COD", "AES-128-ECB");
    
    // TEST USER VENDEDOR MP
    define("INTEGRATOR_ID", "dev_24c65fb163bf11ea96500242ac130004");
    define("COLL_ID", "617633181");
    define("PUB_KEY", "APP_USR-d81f7be9-ee11-4ff0-bf4e-20c36981d7bf");
    define("ACC_TOKEN", "TEST-7628777391240282-070503-e8033997cb47475f0977f4a89c3c4989-78480351");
    // define("ACC_TOKEN", "APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181");
    
    // TEST USER COMPRADOR
    define("COMP_ID", "535650015");
    
    // URL_REDIRECTS
    define("SUCCESS", "http://localhost/mp-ecommerce-php-master/verificador_pp.php?status=success");
    define("FAILURE", "http://localhost/mp-ecommerce-php-master/verificador_pp.php?status=failure");
    define("PENDING", "http://localhost/mp-ecommerce-php-master/verificador_pp.php?status=pending");
    
    // NOTIFICATION
    define("ENDPOINT", "http://localhost/mp-ecommerce-php-master/endpoint.php?source_news=webhooks");
    
?>