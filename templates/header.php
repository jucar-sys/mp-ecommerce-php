<body class="as-theme-light-heroimage">

    <!-- ============= NAVBAR =================== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Exámen MP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>         
            </ul>

            <div class="iconosNav">
                <a data-scroll href="carrito.php" class="nav-link text-center carritoNav">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-pill badge-danger <?php echo (empty($_SESSION['carrito']) ? "d-none" : "d-block"); ?>">
                        <?php 
                            echo count($_SESSION['carrito']); 
                        ?>
                    </span> 
                </a>
            </div>

        </div>
    </nav>
    <!-- ========================================== -->

    <div class="stack">
        
        <div class="as-search-wrapper" role="main">
            <div class="as-navtuck-wrapper">
                <div class="as-l-fullwidth  as-navtuck" data-events="event52">
                    <div>
                        <div class="pd-billboard pd-category-header">
                            <div class="pd-l-plate-scale">
                                <div class="pd-billboard-background pt-5 mt-5">
                                    <img src="./assets/music-audio-alp-201709" alt="" width="1440" height="320" data-scale-params-2="wid=2880&amp;hei=640&amp;fmt=jpeg&amp;qlt=95&amp;op_usm=0.5,0.5&amp;.v=1503948581306" class="pd-billboard-hero ir">
                                </div>
                                <div class="pd-billboard-info">
                                    <a href="index.php">
                                        <h1 class="pd-billboard-header pd-util-compact-small-18">Tienda e-commerce</h1>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>