<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/macam-pengabdian') ?>"> Macam Pengabdian</a></li>
            <li><a href="<?php echo base_url('superadmin/macam-pengabdian/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Macam Pengabdian
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formKategoriPengabdian" enctype="multipart/form-data">
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori">
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- subkategori -->
                    <div class="form-group col-12" id="inputan_subkategori">
                        <label for="subkategori" class="form-control-placeholder">Sub Kategori</label>
                        <input type="text" class="form-control" id="subkategori" name="subkategori">
                        <small class="text-danger subkategori-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahKategoriPengabdianProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function tambahKategoriPengabdianProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>katpengabdian/tambahDataProcess",
            data: $("#formKategoriPengabdian").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/macam-pengabdian";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.kategori-error').html(data.kategori_error);
                    $('.subkategori-error').html(data.subkategori_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>