<?php

    function sessionDestroy() {
    //    session_unset();    // Destruimos las variables de sesion
    //    session_destroy();	// Destruimos finalmente la informacion de la sesion
        $_SESSION['carrito'] = [];
    }
?>