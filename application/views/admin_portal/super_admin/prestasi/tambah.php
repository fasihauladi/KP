<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/prestasi-mahasiswa') ?>"> Prestasi Mahasiswa</a></li>
            <li><a href="<?php echo base_url('superadmin/prestasi-mahasiswa/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Prestasi Mahasiswa
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formPrestasi" enctype="multipart/form-data">
                    <!-- npm -->
                    <div class="form-group col-12" id="inputan_npm">
                        <label for="npm" class="form-control-placeholder">NIM</label>
                        <input type="number" class="form-control" id="npm" name="npm">
                        <small class="text-danger npm-error"></small>
                    </div>
                    <!-- waktu -->
                    <div class="form-group col-12" id="inputan_waktu">
                        <label for="waktu" class="form-control-placeholder">Waktu</label>
                        <input type="date" class="form-control" id="waktu" name="waktu">
                        <small class="text-danger waktu-error"></small>
                    </div>
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kategori</label>
                        <div>
                            <select id="kategori" name="kategori" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Kategori --- </option>
                                <option value="Regional">Regional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- namaprestasi -->
                    <div class="form-group col-12" id="inputan_namaprestasi">
                        <label for="namaprestasi" class="form-control-placeholder">Prestasi</label>
                        <input type="text" class="form-control" id="namaprestasi" name="namaprestasi">
                        <small class="text-danger namaprestasi-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                    <!-- foto -->
                    <div class="form-group col-12" id="inputan_foto">
                        <label for="foto" class="form-control-placeholder">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahPrestasiProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function tambahPrestasiProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        let formData = new FormData($('#formPrestasi').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>prestasi/tambahDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/prestasi-mahasiswa";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.npm-error').html(data.npm_error);
                    $('.waktu-error').html(data.waktu_error);
                    $('.kategori-error').html(data.kategori_error);
                    $('.namaprestasi-error').html(data.namaprestasi_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                    $('.foto-error').html(data.foto_error);
                }
            }
        })
    }
</script>
</body>

</html>