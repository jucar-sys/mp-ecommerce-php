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

                <form action="pagar.php" method="post" class="my-5">
                    <div class="text-center my-5">
                        <button class="btn btn-primary btn-lg my-4" type="submit" name="btnAccion" value="mp">Continuar</button></br>
                    </div><!-- .text-center -->
                </form><!-- /form pagar -->

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