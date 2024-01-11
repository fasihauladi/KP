<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/kategori-penelitian') ?>"> Kategori Penelitian</a></li>
            <li><a href="<?php echo base_url('superadmin/kategori-penelitian/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Kategori Penelitian
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formKategoriPenelitian" enctype="multipart/form-data">
                    <!-- namakatpen -->
                    <div class="form-group col-12" id="inputan_namakatpen">
                        <label for="namakatpen" class="form-control-placeholder">Kategori</label>
                        <input type="text" class="form-control" id="namakatpen" name="namakatpen">
                        <small class="text-danger namakatpen-error"></small>
                    </div>
                    <!-- namasubkatpen -->
                    <div class="form-group col-12" id="inputan_namasubkatpen">
                        <label for="namasubkatpen" class="form-control-placeholder">Sub Kategori</label>
                        <input type="text" class="form-control" id="namasubkatpen" name="namasubkatpen">
                        <small class="text-danger namasubkatpen-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahKategoriPenelitianProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function tambahKategoriPenelitianProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>katpenelitian/tambahDataProcess",
            data: $("#formKategoriPenelitian").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/kategori-penelitian";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.namakatpen-error').html(data.namakatpen_error);
                    $('.namasubkatpen-error').html(data.namasubkatpen_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>