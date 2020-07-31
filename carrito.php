<?php
    include_once 'templates/head.php';
    include_once 'templates/header.php';
    include_once 'modelo_carrito.php';
?>
<!-- -------------------------------------------------------- -->

    <!-- ----------------- Seccion --------------------- -->
    <div class="container">
        <div class="tablaCarrito mt-5">
            <h2></h2>
            <?php 
                // session_start();
                if(!empty($_SESSION['carrito'])) { 
            ?>
            <table class="table table-responsive table-light table-striped">
                <tbody>
                    <!-- head -->
                    <tr>
                        <th width='40%'>Producto</th>
                        <th width='15%' class="text-center">cantidad</th>
                        <th width='20%' class="text-center">Precio/u</th>
                        <th width='20%' class="text-center">Total</th>
                        <th width='5%' class="text-center">--</th>
                    </tr>
                    <!-- /head -->
                    <!-- contenido -->
                    <?php 
                        $total = 0;
                    ?>
                    <!-- RECORREMOS la variable carrito para dibujar todos los porductos que tenemos en el carrito -->
                    <?php foreach($_SESSION['carrito'] as $index=>$producto) { ?>
                    <tr>
                        <td width='40%'><?php echo $producto['nombre']?></td>
                        <td width='15%' class="text-center"><?php echo $producto['cantidad']?></td>
                        <td width='20%' class="text-center">$<?php echo number_format($producto['precio_unitario'], 2)?></td>
                        <td width='20%' class="text-center">$<?php echo number_format($producto['precio_unitario'] * $producto['cantidad'], 2)?></td>
                        <td width='5%' class="text-center">
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                <button
                                    class="btn bg-danger"
                                    type="submit"
                                    name="btnAccion"
                                    value="eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form><!-- /form -->
                        </td>
                    </tr>
                    <?php 
                        $total = $total + ($producto['precio_unitario'] * $producto['cantidad']);
                        } ?>
                    <!-- /contenido -->
                    <!-- footer -->
                    <tr>
                        <td colspan="3" align="right"><h4>Total</h4></td>
                        <td align="right"><h5>$<?php echo number_format($total,2) ?></h5></td>
                    </tr>
                    <!-- /footer -->
                </tbody>
            </table><!-- .table -->
                            <!-- Formulario de datos cliente -->
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Formulario de datos cliente-->
                    
                    <!-- Formulario de datos -->
                    <form action="pagar.php" method="post" class="my-5">
                        <h3>Datos de contacto:</h3>
                        <div class="form-group">
                            <label for="nombre_carrito">Nombre Completo</label>
                            <input id="nombre_carrito" class="form-control" type="text" name="nombre" placeholder="Escribe tu nombre completo" value="Lalo Landa" required>
                        </div><!-- .from-group -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_carrito">Correo de contacto</label>
                                    <input id="email_carrito" class="form-control" type="email" name="email" placeholder="Escribe tu correo electrónico" value="test_user_58295862@testuser.com" required>
                                </div><!-- .from-group -->
                            </div><!-- .col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono_carrito">Teléfono de contacto</label>
                                    <input id="telefono_carrito" class="form-control" type="text" name="telefono" placeholder="Escribe tu teléfono de contacto" maxlength="10" value="5549737300" required>
                                </div><!-- .from-group -->
                            </div><!-- .col-md-6 -->
                        </div><!-- .row -->

                        <!-- DIRECCION -->
                        <hr class="my-5">
                        <h3>Datos de envío:</h3>
 
                            <div class="form-group">
                                <label for="calle_carrito">Calle</label>
                                <input id="calle_carrito" class="form-control" type="text" name="calle" placeholder="Calle" value="Insurgentes Sur" required>
                            </div><!-- .from-group -->

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ext_carrito"># Ext</label>
                                        <input id="ext_carrito" class="form-control" type="text" name="ext" placeholder="# Exterior" maxlength="10" value="1602" required>
                                    </div><!-- .from-group -->
                                </div><!-- .col-6 -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cp_carrito">C.P.</label>
                                        <input id="cp_carrito" class="form-control" type="text" name="cp" placeholder="C.P." maxlength="5" value="03940" required>
                                    </div><!-- .from-group -->
                                </div><!-- .col-6 -->
                            </div><!-- .row -->

                        <div class="text-center my-5">
                            <button class="btn btn-primary btn-lg my-4" type="submit" name="btnAccion" value="mp">Continuar</button></br>
                        </div><!-- .text-center -->
                    </form><!-- /form pagar -->
                    <!-- ........................................ -->

                    <!-- /Formulario de datos cliente -->
                    <!-- ........................................ -->
                    </div><!-- .col-md-8 -->
                </div><!-- .row -->
        <!-- /Formulario de datos cliente -->

            <?php }else { ?>
                <div class="alert alert-info" role="alert">
                    No hay productos en el carrito. Vé a la tienda y agrega algunos...
                </div>

                <div class="carritoVacio text-center my-4">
                    <a href="index.php">
                        <i class="fas fa-cart-arrow-down"></i>
                    </a>
                </div><!-- .carritoVacio -->
            <?php }?>
        </div><!-- .tablaCarrito -->
    </div><!-- .container -->
    <!-- ---------------------------------------------- -->

    

    <!-------------------- Fotter --------------------->
    <!-- Security de Mercado Pago -->
    <script src="https://www.mercadopago.com/v2/security.js" view=""></script>
    <!-- -------------------------- -->
    <?php
        include_once 'templates/footer.php';
    ?>
    <!-- -------------------------------------------------------- -->