<section>

    <h2>Pesann Anda</h2>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <?php
    foreach ($row->result() as $key => $data) {
    ?>
        <div class="data-menu">
            <div class="card menu" style="max-width: 400px;">
                <div class="row ">
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title" style="margin-left: 20px;">Status Pembayaran :
                                <?php
                                if ($data->status_code == "200") { ?>
                                    <span class="badge bg-green"><?php echo $data->transaction_status; ?></span>
                                <?php } else {
                                ?><span class="badge bg-yellow"><?php echo $data->transaction_status; ?></span>
                                <?php
                                }
                                ?>
                            </h5>
                            <h5 class="card-title" style="margin-left: 20px;">No Invoice : <?php echo  $data->order_id; ?></h5>
                            <h5 class="card-title" style="margin-left: 20px;">Metode Bayar : <?php echo  $data->payment_type; ?></h5>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-body">


                            <button id="detail" data-target="#modal-detail" data-toggle="modal" style=" margin-left: 20px; margin-top:10px; margin-bottom:10px" class="btn btn-xs btn-primary" data-grandtotal="<?= indo_currency($data->gross_amount) ?>" data-note="<?= $data->note ?>" data-type="<?= $data->type == 1 ? "Dine In" : "Take Away" ?>" data-time="<?= ($data->date_created) ?>" data-invoice="<?= $data->order_id ?>">
                                <i class="fa fa-eye"></i> Detail
                            </button>





                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    <?php } ?>






    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Detail Pemesanan</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered no-margin">
                        <tbody>
                            <tr>
                                <th style="width:20%">Invoice</th>
                                <td style="width:30%"><span id="invoice"></span></td>
                            </tr>
                            <tr>
                                <th>Date Time</th>
                                <td><span id="datetime"></span></td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td><span id="grandtotal"></span></td>

                            </tr>
                            <tr>
                                <th>Note</th>
                                <td><span id="note"></span></td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td><span id="type"></span></td>
                            </tr>
                            <tr>
                                <th>Product</th>
                                <td colspan="3"><span id="product"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $(document).on('click', '#detail', function() {
            $('#invoice').text($(this).data('invoice'))
            $('#type').text($(this).data('type'))
            $('#datetime').text($(this).data('time'))
            $('#total').text($(this).data('total'))
            $('#grandtotal').text($(this).data('grandtotal'))
            $('#note').text($(this).data('note'))

            var product = '<table class="table no-margin">'
            product += '<tr><th>Item</th><th>Price</th><th>Qty</th><th>Disc</th><th>Total</th></tr>'
            $.getJSON('<?= site_url('invoice/sale_product/') ?>' + $(this).data('invoice'), function(data) {
                $.each(data, function(key, val) {
                    product += '<tr><td>' + val.name + '</td><td>' + val.price + '</td><td>' + val.qty + '</td><td>' + val.total + '</td></tr>'
                })
                product += '</table>'
                $('#product').html(product)
            })
        })
    </script>

</section>