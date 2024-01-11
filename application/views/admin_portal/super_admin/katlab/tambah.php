<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/kategori-laboratorium') ?>"> Kategori Laboratorium</a></li>
            <li><a href="<?php echo base_url('superadmin/kategori-laboratorium/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Kategori Laboratorium
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formKategoriLaboratorium" enctype="multipart/form-data">
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori">
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- keterangan -->
                    <div class="form-group col-12 mt-2" id="inputan_keterangan">
                        <label class="form-control-placeholder" for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" value=""></textarea>
                        <small class="text-danger keterangan-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahKategoriLaboratoriumProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function tambahKategoriLaboratoriumProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>katlab/tambahDataProcess",
            data: $("#formKategoriLaboratorium").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/kategori-laboratorium";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.kategori-error').html(data.kategori_error);
                    $('.keterangan-error').html(data.keterangan_error);
                }
            }
        })
    }
</script>
</body>

</html>