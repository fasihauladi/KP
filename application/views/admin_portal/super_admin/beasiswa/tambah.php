<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/jalur-beasiswa') ?>"> Jalur Beasiswa</a></li>
            <li><a href="<?php echo base_url('superadmin/jalur-beasiswa/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Jalur Beasiswa
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formBeasiswa" enctype="multipart/form-data">
                    <!-- namabeasiswa -->
                    <div class="form-group col-12" id="inputan_namabeasiswa">
                        <label for="namabeasiswa" class="form-control-placeholder">Beasiswwa</label>
                        <input type="text" class="form-control" id="namabeasiswa" name="namabeasiswa">
                        <small class="text-danger namabeasiswa-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahBeasiswaProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function tambahBeasiswaProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>beasiswa/tambahDataProcess",
            data: $("#formBeasiswa").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/jalur-beasiswa";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.namabeasiswa-error').html(data.namabeasiswa_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>