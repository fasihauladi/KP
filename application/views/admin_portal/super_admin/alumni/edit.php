<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/data-alumni') ?>"> Data Alumni</a></li>
            <li><a href="<?php echo base_url('superadmin/data-alumni/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Alumni
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditAlumni" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                    <!-- npm -->
                    <div class="form-group col-12" id="inputan_npm">
                        <label for="npm" class="form-control-placeholder">NIM</label>
                        <input type="number" class="form-control" id="npm" name="npm">
                        <small class="text-danger npm-error"></small>
                    </div>
                    <!-- telp -->
                    <div class="form-group col-12" id="inputan_telp">
                        <label for="telp" class="form-control-placeholder">WhatsApp</label>
                        <input type="number" class="form-control" id="telp" name="telp" placeholder="62">
                        <small class="text-danger telp-error"></small>
                    </div>
                    <!-- kesan -->
                    <div class="form-group col-12 mt-2" id="inputan_kesan">
                        <label class="form-control-placeholder" for="kesan">Kesan</label>
                        <textarea class="form-control" id="kesan" name="kesan" value=""></textarea>
                        <small class="text-danger kesan-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editAlumniProcess()">Edit</button>
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
            url: '<?= base_url('alumni/getalumnibyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#npm').val(response.npm);
                $('#telp').val(response.telp);
                $('#kesan').val(response.kesan);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/alumni/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
            }
        });

        $('#foto').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#lihatFoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

    function editAlumniProcess() {
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditAlumni').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>alumni/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/data-alumni";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.npm-error').html(data.npm_error);
                    $('.telp-error').html(data.telp_error);
                    $('.kesan-error').html(data.kesan_error);
                    // $('.foto-error').html(data.foto_error);
                }
            }
        })
    }
</script>
</body>

</html>