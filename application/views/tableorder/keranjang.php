<section>

    <h2>Daftar Pesanan</h2>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <div class="row">
        <div class="col-lg-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th width="15%">Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody id="cart_table">

                            <?php $this->view('tableorder/keranjang_data') ?>

                        </tbody>

                    </table>
                    <label for="grand_total">Grand Total</label>
                    <input type="text" id="invoice_no" value="<?= $invoice ?>">

                    <input type="number" id="grand_total" class="form-control" readonly>

                    <div class="form-group ">
                        <label for="note">Type Pesanan</label>
                        <select name="type" id="type" class="form-control">
                            <option value="1" <?= set_value('type') == 1 ? "selected" : null ?>>Dine In</option>
                            <option value="2" <?= set_value('type') == 2 ? "selected" : null ?>>Take Away</option>
                        </select>
                    </div>
                    <div><label for="note">Catatan Khusus (Opsional)</label>
                        <textarea name="note" id="note" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="date" value="<?= date('Y-m-d') ?>" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <input type="hidden" id="customer_id" value="0" class="form-control">
                    </div> -->
                </div>
            </div>
        </div>

    </div>



    <button id="add-cart" class="btn btn-flat btn-md btn-success" style="margin-bottom: 10px; ">
        <i class="fa fa-money"></i> Cash
    </button>
    <button id="pay-button" class="btn btn-flat btn-md btn-warning" style="margin-bottom: 10px; ">
        <i class="fa fa-cc-visa"></i> E-Payment
    </button>

    <!-- Modal Edit Cart Item -->
    <div class="modal fade" id="modal-item-edit">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Update Product Item</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cartid_item">
                    <div class="form-group">
                        <label for="product_item">Product Item</label>
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" id="product_item" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price_item">Price</label>
                        <input type="number" id="price_item" min="0" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7">
                                <label for="qty_item">Qty</label>
                                <input type="number" id="qty_item" min="1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_item">Total</label>
                        <input type="number" id="total_item" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" id="edit_cart" class="btn btn-flat btn-success">
                            <i class="fa fa-paper-plane"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Cfe_M9QNjuebsx3I"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        // Hapus cart
        $(document).on('click', '#del_cart', function() {
            if (confirm('Apakah Anda yakin?')) {
                var cart_id = $(this).data('cartid')
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('keranjang/cart_del') ?>',
                    dataType: 'json',
                    data: {
                        'cart_id': cart_id
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_table').load('<?= site_url('keranjang/cart_data') ?>', function() {
                                calculate()
                            })
                        } else {
                            alert('Gagal hapus item cart');
                        }
                    }
                })
            }
        })
        // Update cart
        $(document).on('click', '#update_cart', function() {
            $('#cartid_item').val($(this).data('cartid'))
            $('#product_item').val($(this).data('product'))
            $('#price_item').val($(this).data('price'))
            $('#qty_item').val($(this).data('qty'))
            $('#total_item').val($(this).data('total'))
        })

        function count_edit_modal() {
            var price = $('#price_item').val()
            var qty = $('#qty_item').val()

            total = price * qty
            $('#total_item').val(total)
        }
        $(document).on('keyup mouseup', '#price_item, #qty_item', function() {
            count_edit_modal()
        })

        $(document).on('click', '#edit_cart', function() {
            var cart_id = $('#cartid_item').val()
            var price = $('#price_item').val()
            var qty = $('#qty_item').val()
            var total = $('#total_item').val()
            $.ajax({
                type: 'POST',
                url: '<?= site_url('keranjang/process') ?>',
                data: {
                    'edit_cart': true,
                    'cart_id': cart_id,
                    'price': price,
                    'qty': qty,
                    'total': total
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('keranjang/cart_data') ?>', function() {
                            calculate()
                        })
                        alert('Item cart berhasil ter-update')
                        $('#modal-item-edit').modal('hide')
                    } else {
                        alert('Data item cart tidak ter-update')
                        $('#modal-item-edit').modal('hide')
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

        $(document).ready(function() {
            calculate()
        })

        $(document).on('click', '#add_cart', function() {
            var item_id = $('#item_id').val()
            var price = $('#price').val()
            var stock = $('#stock').val()
            var qty = $('#qty').val()
            var qty_cart = $('#qty_cart').val()
            if (item_id == '') {
                alert('Product belum dipilih')
                $('#barcode').focus()
            } else if (stock < 1 || parseInt(stock) < (parseInt(qty_cart) + parseInt(qty))) {
                alert('Stock tidak mencukupi')
                $('#qty').focus()
            } else {
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
                            $('#item_id').val('')
                            $('#barcode').val('')
                            $('#qty').val(1)
                            $('#barcode').focus()
                        } else {
                            alert('Gagal tambah item cart')
                        }
                    }
                })
            }
        })
    </script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Cfe_M9QNjuebsx3I"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <form id="payment-form" method="post" action="<?= site_url() ?>snap/finish">
        <input type="hidden" name="result_type" id="result-type" value=""></div>
        <input type="hidden" name="result_data" id="result-data" value=""></div>
        <input type="hidden" name="invoice_no" id="invoice_no" value="<?= $invoice ?>"></div>
        <input type="hidden" name="type1" id="type1" value="<?= set_value('note') ?>"></div>
        <input type="hidden" name="note1" id="note1" value="<?= set_value('type') ?>"></div>
        <input type="hidden" name="customer_id" id="customer_id" value="<?= $this->fungsi->user_login()->user_id ?>"></div>
    </form>
    <script type="text/javascript">
        $(document).on('click', '#pay-button', function() {

            var grandtotal = $('#grand_total').val()
            var invoice_no = $('#invoice_no').val()

            var type = $('#type').val()
            var subtotal = $('#sub_total').val()
            var note = $('#note').val()
            var date = $('#date').val()

            var customer_id = $('#customer_id').val()
            if (grandtotal < 1) {
                alert('Belum ada product item yang dipilih')
                $('#barcode').focus()
            } else {

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('snap/token') ?>',
                    data: {
                        'grandtotal': grandtotal,
                        'invoice_no': invoice_no,
                        'type': type,
                        'subtotal': subtotal,
                        'note': note,
                        'date': date,

                        'customer_id': customer_id,
                    },
                    cache: false,

                    success: function(data) {
                        //location = data;

                        console.log('token = ' + data);

                        var resultType = document.getElementById('result-type');
                        var resultData = document.getElementById('result-data');

                        function changeResult(type, data) {
                            $("#result-type").val(type);
                            $("#result-data").val(JSON.stringify(data));




                        }


                        snap.pay(data, {

                            onSuccess: function(result) {
                                changeResult('success', result);
                                $('#note1').val(note);
                                $('#type1').val(type);
                                console.log(result.status_message);
                                console.log(result);
                                $("#payment-form").submit();
                            },
                            onPending: function(result) {
                                changeResult('pending', result);
                                $('#note1').val(note);
                                $('#type1').val(type);
                                console.log(result.status_message);
                                $("#payment-form").submit();
                            },
                            onError: function(result) {
                                changeResult('error', result);
                                $('#note1').val(note);
                                $('#type1').val(type);
                                console.log(result.status_message);
                                $("#payment-form").submit();
                            }
                        });
                    }
                });
            }

        });
    </script>
</section>