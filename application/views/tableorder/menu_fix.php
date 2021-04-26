<section class="content">
    <?php
    foreach ($row->result() as $key => $data) {
    ?>
        <div class="data-menu">
            <div class="card menu" style="max-width: 600px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="card-body">
                            <img src="<?= base_url('uploads/product/' . $data->image) ?>" width="115" height="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $data->name; ?></h5>
                            <p class="card-text"><?php echo $data->price_new . 'K'; ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">


                            <button id="add_cart" class="btn btn-success" data-item_id="<?= $data->item_id ?>" data-stock="<?= $data->stock ?>" data-price="<?= $data->price ?>" class="btn btn-xs btn-primary">
                                <i class="fa fa-pencil"></i> Add Cart
                            </button>

                            <input type="number" id="qty" name="qty" value="1" min="1" class="quantity form-control" style="margin-top: 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    <?php } ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(document).on('click', '#add_cart', function() {
            var barcode = $(this).data('barcode')
            var item_id = $(this).data('item_id')
            var price = $(this).data('price')
            var stock = $(this).data('stock')
            var qty = $('#qty').val()
            $('#qty_item').val($(this).data('qty'))
            $.ajax({
                type: 'POST',
                url: '<?= site_url('keranjang/process') ?>',
                data: {
                    'add_cart': true,
                    'item_id': item_id,
                    'price': price,
                    'qty': qty
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('keranjang/cart_data') ?>', function() {
                            calculate()
                        })
                    } else {
                        alert('Gagal tambah item cart')
                    }
                }

            })

        })

        function calculate() {
            var subtotal = 0;
            $('#cart_table tr').each(function() {
                subtotal += parseInt($(this).find('#total').text())
            })
            isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)


            var grand_total = subtotal
            if (isNaN(grand_total)) {
                $('#grand_total').val(0)
                $('#grand_total2').text(0)
            } else {
                $('#grand_total').val(grand_total)
                $('#grand_total2').text(grand_total)
            }


        }
    </script>
</section>