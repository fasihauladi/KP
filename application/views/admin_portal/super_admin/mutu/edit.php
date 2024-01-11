<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/standar-operasional-prosedur') ?>"> SOP</a></li>
            <li><a href="<?php echo base_url('superadmin/standar-operasional-prosedur/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit SOP/Kategori Mutu
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditSOP" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kategori</label>
                        <div>
                            <select id="kategori" name="kategori" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Kategori --- </option>
                                <option value="SOP">SOP</option>
                                <option value="Mutu">Mutu</option>
                            </select>
                        </div>
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editSOP()">Edit</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('mutu/getmutubyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kategori').val(response.kategori);
                $('#deskripsi').val(response.deskripsi);
            }
        });
    });

    function editSOP() {
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>mutu/editDataProcess",
            data: $("#formEditSOP").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/standar-operasional-prosedur";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kategori-error').html(data.kategori_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>