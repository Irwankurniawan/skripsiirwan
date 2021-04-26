<section class="content-header">
    <h1>Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= ucfirst($page) ?> User</h3>
            <div class="pull-right">
                <a href="<?= site_url('user') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php echo form_open_multipart('user/process') ?>
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                        <input type="text" name="name" value="<?= $row->name ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input type="text" name="username" id="username" value="<?= $row->username ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label> <small>(Biarkan kosong jika tidak diganti)</small>
                        <input type="password" name="password" id="password" value="<?= $this->input->post('password') ?>" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="address">Address *</label>
                        <textarea name="address" id="address" class="form-control" required><?= $row->address ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Level *</label>
                        <select name="level" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="1" <?= set_value('level', $row->level) == 1 ? "selected" : null ?>>Admin</option>
                            <option value="2" <?= set_value('level', $row->level) == 2 ? "selected" : null ?>>Kasir</option>
                            <option value="3" <?= set_value('level', $row->level) == 3 ? "selected" : null ?>>Meja</option>

                        </select>
                        <?= form_error('level') ?>
                    </div>


                    <div class="form-group">
                        <label>Image</label>
                        <?php if ($page == 'edit') {
                            if ($row->image != null) { ?>
                                <div style="margin-bottom:5px">
                                    <img src="<?= base_url('uploads/user/' . $row->image) ?>" style="width:80%">
                                </div>
                        <?php
                            }
                        } ?>
                        <input type="file" name="image" class="form-control">
                        <small>(Biarkan kosong jika tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?>)</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
                            <i class="fa fa-paper-plane"></i> Save
                        </button>
                        <button type="Reset" class="btn btn-flat">Reset</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>

</section>