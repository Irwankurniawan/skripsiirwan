<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />

    <title>Menu</title>
    <link href="<?php echo base_url() . 'assets/img/logo.png' ?>" rel="shortcut icon" type="image/x-icon">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'mobile/css/jquery.mmenu.all.css' ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'mobile/css/style.css' ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'mobile/css/jquery.mobile-1.0rc2.min.css' ?>" />

    <link rel="apple-touch-icon" href="<?php echo base_url() . 'mobile/img/apple-touch-icon.png' ?>">
    <link rel="apple-touch-startup-image" href="<?php echo base_url() . 'mobile/img/apple-touch-startup-image.png' ?>">

    <script type="text/javascript" src="<?php echo base_url() . 'mobile/js/jquery.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'mobile/js/jquery.mmenu.min.all.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'mobile/js/jquery.easy-pie-chart.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'mobile/js/o-script.js' ?>"></script>

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/lavaicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->



    <!--===============================================================================================-->

    <!-- my font -->
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
</head>


<body>


    <div>

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Fluid jumbotron</h1>
                <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            </div>
        </div>
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link active" href="#">Active</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="#">Link</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="#">Link</a>
            <a class="flex-sm-fill text-sm-center nav-link disabled" href="#">Disabled</a>
        </nav>
        <div class="container">
            <div id="content">
                <?php
                foreach ($row->result() as $key => $data) {

                ?>
                    <div class="data-menu">
                        <article>
                            <?php $data->barcode; ?>
                            <?php $data->stock; ?>

                            <div class="article-img-pane">
                                <img src="<?= base_url('uploads/product/' . $data->image) ?>" />
                            </div>
                            <h2><?php echo  $data->name; ?></h2>
                            <div class="prod-pricePane">
                                <span class="current-price pull-right"><?php echo $data->price_new . 'K'; ?></span>
                            </div>
                            <div class="pesan ml-auto">
                                <button class="add_cart btn btn-primary" data-produkid="<?php echo $data->item_id; ?>" data-produknama="<?php echo $data->name; ?>" data-produkharga="<?php echo $data->price; ?>"><i class="fa fa-plus"></i> Pesan</button>


                                <input type="number" name="quantity" id="<?php echo $data->item_id; ?>" value="1" class="quantity form-control">
                            </div>


                        </article>
                    </div>
                <?php } ?>
            </div>



            <div class="col-md-4 mr-auto">
                <h4>Pesanan Anda</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detail_cart">
                    </tbody>
                </table>
                <button class="add_cart btn btn-danger" data-produkid="<?php echo $data->item_id; ?>" data-produknama="<?php echo $data->name; ?>" data-produkharga="<?php echo $data->price; ?>">Bayar</button>
            </div>
        </div>




    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.add_cart').click(function() {
            var produk_id = $(this).data("produkid");
            var produk_nama = $(this).data("produknama");
            var produk_harga = $(this).data("produkharga");
            var quantity = $('#' + produk_id).val();
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/cart/add_to_cart",
                method: "POST",
                data: {
                    produk_id: produk_id,
                    produk_nama: produk_nama,
                    produk_harga: produk_harga,
                    quantity: quantity
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });



        //Hapus Item Cart
        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url: "<?php echo base_url(); ?>cart/hapus_cart",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>

<!-- Add Cart -->

</html>