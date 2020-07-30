<?php
    $mensaje = "";

    // Boton de accion del o los formularios
    if(isset($_POST['btnAccion'])){

        // Evaluamos que accion tiene el botón
        switch ($_POST['btnAccion']) {
            /* -------- BOTON AGREGAR A CARRITO --------- */
            case 'agregar':
                // IF ID
                if(is_string(openssl_decrypt($_POST['id_prod'], COD, KEY))){
                    $id = openssl_decrypt($_POST['id_prod'], COD, KEY);
                    // $mensaje = 'ID Correcto: '.$id.'</br>';
                }else {
                    $mensaje = 'ID Incorrecto </br>';
                    break;
                }
                // /IF ID

                // IF NOMBRE
                if(is_string(openssl_decrypt($_POST['title'], COD, KEY))){
                    $nombre = openssl_decrypt($_POST['title'], COD, KEY);
                    // $mensaje .= 'Nombre Correcto: '.$nombre.'</br>';
                }else {
                    $mensaje .= 'Nombre Incorrecto </br>';
                    break;
                }
                // /IF NOMBRE

                // IF DESCRIPCION
                if(is_string(openssl_decrypt($_POST['descripcion'], COD, KEY))){
                    $descripcion = openssl_decrypt($_POST['descripcion'], COD, KEY);
                    // $mensaje .= 'descripcion Correcto: '.$descripcion.'</br>';
                }else {
                    $mensaje .= 'Descripcion Incorrecta </br>';
                    break;
                }
                // /IF DESCRIPCION

                // IF imagen DE ARTICULO MP
                if(is_string(openssl_decrypt($_POST['img'], COD, KEY))){
                    $url_img = openssl_decrypt($_POST['img'], COD, KEY);
                    // $mensaje .= 'url_img Correcto: '.$url_img.'</br>';
                }else {
                    $mensaje .= 'Imagen Incorrecta </br>';
                    break;
                }
                // /IF imagen DE ARTICULO MP
                
                
                // IF CANTIDAD
                if(is_numeric(openssl_decrypt($_POST['unit'], COD, KEY))){
                    $cantidad = openssl_decrypt($_POST['unit'], COD, KEY);
                    $mensaje .= 'Cantidad Correcto: '.$cantidad.'</br>';
                     // IF PRECIO
                    if(is_string(openssl_decrypt($_POST['price'], COD, KEY))){
                        $precio = openssl_decrypt($_POST['price'], COD, KEY);
                        // $mensaje .= 'Precio Correcto: '.$precio.'</br>';
                        $total = $precio * $cantidad;
                        // $mensaje .= 'Precio Total Correcto: '.$total.'</br>';
                    }else {
                        $mensaje .= 'Precio Incorrecto </br>';
                        break;
                    }
                    // /IF PRECIO
                }else {
                    $mensaje .= 'Cantidad Incorrecto </br>';
                    break;
                }
                // /IF CANTIDAD


                // IF orden_ped
                if(is_string(openssl_decrypt($_POST['orden_ped'], COD, KEY))){
                    $orden_ped = openssl_decrypt($_POST['orden_ped'], COD, KEY);
                    // $mensaje .= 'orden_ped Correcto: '.$orden_ped.'</br>';
                }else {
                    $mensaje .= 'Orden Incorrecta </br>';
                    break;
                }
                // /IF orden_ped


                // AGREGAR PRODUCTO AL CARRITO
                // Si no existe la variable de $_SESSION carrito
                if(!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])){
                    // Almacenamos la info del producto en un array
                    $producto = array(
                        'id' => $id,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'url_img' => $url_img,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precio,
                        'total' => $total,
                        'orden_ped' => $orden_ped
                    );
                    // Inicializamos la variable de carrito
                    $_SESSION['carrito'][0] = $producto;
                    $mensaje = "Producto agregado al carrito ";
                } else {
                    // Variable para guardar los ids de todos los productos que están actualmente en el carrito
                    $idProds = array_column($_SESSION['carrito'], 'id');

                    // Validar que el producto no esté en le carrito
                    if(in_array($id, $idProds)){
                         // Actualizamos la cantidad en el carrito
                         foreach ($_SESSION['carrito'] as $index => $producto) {
                            if ($producto['id'] == $id) {
                                $_SESSION['carrito'][$index]['cantidad'] = $_SESSION['carrito'][$index]['cantidad'] + $cantidad;
                            }
                        }
                        $mensaje = "Producto agregado al carrito ";
                        // echo "<script>alert('Elemento ya en carrito');</script>";
                    }else{
                        // Si la variable ya fue inicializada, contamos los productos para saber donde insertar el siguiente
                        $numProds = count($_SESSION['carrito']);
                        // Almacenamos la info del producto en un array
                        $producto = array(
                            'id' => $id,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,
                            'url_img' => $url_img,
                            'cantidad' => $cantidad,
                            'precio_unitario' => $precio,
                            'total' => $total,
                            'orden_ped' => $orden_ped
                        );
                        // Insertamos en la variable de carrito en la posicion siguiente
                        $_SESSION['carrito'][$numProds] = $producto;
                        $mensaje = "Producto agregado al carrito ";
                    }
                }
                // /AGREGAR PRODUCTO AL CARRITO

                break;
                /* ------------------------------------------ */
                

            /* -------- BOTON ELIMINAR DE CARRITO --------- */
            case 'eliminar':
                // IF ID
                if(is_string(openssl_decrypt($_POST['id'], COD, KEY))){
                    $id = openssl_decrypt($_POST['id'], COD, KEY);

                    // Eliminamos el registro de la variable de sesion
                    foreach ($_SESSION['carrito'] as $index => $producto) {
                        if ($producto['id'] == $id) {
                            unset($_SESSION['carrito'][$index]);
                            // echo ("Eliminado");
                        }
                    }

                    // $mensaje = 'ID Correcto: '.$id.'</br>';
                }else {
                    $mensaje = 'ID Incorrecto </br>';
                    break;
                }
                // /IF ID
                break;
            /* ------------------------------------------ */
            
            default:
                # code...
                break;
        }

    }
?>