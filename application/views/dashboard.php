<section class="content-header">
  <h1>Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<link rel="icon" type="image/png" href="images/icons/lavaicon.png" />
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Items</span>
          <span class="info-box-number"><?= $this->fungsi->count_item() ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>


    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Customers</span>
          <span class="info-box-number"><?= $this->fungsi->count_customer() ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number"><?= $this->fungsi->count_user() ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="box box-solid">
    <div class="box-header">
      <i class="fa fa-th"></i>
      <h3 class="box-tittle">Produk Terlaris Bulan Ini</h3>
      <div class="box-tools ">
        <button type="button" class="btn btn-sm" data-widget="collaps">
          <i class="fa fa-minus">

          </i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div id="sales-bar" class="graph"></div>
    </div>
  </div>
</section>
<!-- Morris charts -->
<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/morris.js/morris.css">

<!-- Morris.js charts -->
<script src="<?= base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
<script>
  //BAR CHART
  var bar = new Morris.Bar({
    element: 'sales-bar',
    resize: true,
    data: [<?php foreach ($row as $key => $data) {
              echo "{ item: '" . $data->name . "', sold: '" . $data->sold . "'},";
            } ?>],
    // barColors: ['#00a65a', '#f56954'],
    xkey: 'item',
    ykeys: ['sold'],
    labels: ['sold'],
    hideHover: 'auto'
  });
</script>