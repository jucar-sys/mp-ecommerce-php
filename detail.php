<?php
    include 'templates/head.php';
    include 'templates/header.php';
    include 'modelo_carrito.php';
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
                        
                        <!-- ----------------- Mensaje --------------------- -->
                        <div class="container">
                            <br>
                            <?php if($mensaje != '') { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo ($mensaje); ?>
                                </div><!-- .alert -->
                            <?php } ?>
                        </div><!-- .container -->
                        <!-- ---------------------------------------------- -->

                        <!-- ==================== Accesorio mostrado ======================= -->
                        <div class="as-accessories-results as-search-desktop">

                            <?php
                                $id = openssl_decrypt($_POST['id_prod'], COD, KEY);
                                $nombre = openssl_decrypt($_POST['title'], COD, KEY);
                                $img = openssl_decrypt($_POST['img'], COD, KEY);
                                $precio = openssl_decrypt($_POST['price'], COD, KEY);
                                $cantidad = openssl_decrypt($_POST['unit'], COD, KEY);
                            ?>

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

                                    <!-- Form para enviar los datos del prod al carrito -->
                                    <form action="detail.php" method="post">
                                        <input type="hidden" name="id_prod" id="id_prod" value="<?php echo openssl_encrypt($id, COD, KEY); ?>">
                                        <input type="hidden" name="title" id="nombre_prod" value="<?php echo openssl_encrypt($nombre, COD, KEY); ?>">
                                        <input type="hidden" name="descripcion" id="descripcion_prod" value="<?php echo openssl_encrypt('Dispositivo móvil de Tienda e-commerce', COD, KEY); ?>">
                                        <input type="hidden" name="img" id="img_prod" value="<?php echo openssl_encrypt($img, COD, KEY); ?>">
                                        <input type="hidden" name="unit" id="cantidad_prod" value="<?php echo openssl_encrypt($cantidad, COD, KEY); ?>">
                                        <input type="hidden" name="price" id="precio_prod" value="<?php echo openssl_encrypt($precio, COD, KEY); ?>">
                                        <input type="hidden" name="orden_ped" id="orden_pedido" value="<?php echo openssl_encrypt('jucar.sys@gmail.com', COD, KEY); ?>">

                                        <button href="#" class="btn btn-primary" name="btnAccion" type="submit" value="agregar"><i class="fas fa-shopping-cart"></i> Agregar</button>

                                    </form><!-- /form -->
                                    <!-- ---------------------------------------------- -->

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