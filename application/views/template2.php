<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Lava Resto Menu</title>

    <!-- Bootstrap CSS CDN -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <!-- Our Custom CSS -->
    <link href="./menu.css" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'mobile/css/side.css' ?>" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="icon" type="image/png" href="images/icons/lavaicon.png" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">

</head>

<body>



    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Lava Resto</h3>
                <h5>Selamat datang meja (<?= $this->fungsi->user_login()->name ?>)</h5>
            </div>

            <ul class="list-unstyled components">

                <li <?= $this->uri->segment(1) == 'Food' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url() . 'Food' ?>">Food</a>
                </li>
                <li <?= $this->uri->segment(1) == 'Dessert' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url() . 'Dessert' ?>">Dessert</a>
                </li>
                <li <?= $this->uri->segment(1) == 'Drink' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url() . 'Drink' ?>">Drink</a>
                </li>
                <br>
                <li <?= $this->uri->segment(1) == 'Keranjang' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url() . 'Keranjang' ?>">Keranjang</a>
                </li>
                <li <?= $this->uri->segment(1) == 'Invoice' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                    <a href="<?php echo base_url() . 'Invoice' ?>">Invoice</a>
                </li>


            </ul>


        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="menu" class="btn btn-primary navbar-btn ">
                            <span>Menu</span>
                        </button>
                    </div>
                </div>
            </nav>

            <?php echo $contents ?>

        </div>


        <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>






        <script>
            $(document).ready(function() {


                $('#menu').on('click', function() {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
</body>

</html>