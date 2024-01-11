<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/peta-penelitian') ?>"> Peta Penelitian</a></li>
            <li><a href="<?php echo base_url('superadmin/peta-penelitian/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Peta Penelitian
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formPetaPenelitian" enctype="multipart/form-data">
                    <!-- kodeprodi -->
                    <div class="form-group col-12" id="inputan_kodeprodi">
                        <label for="kodeprodi" class="form-control-placeholder">Prodi</label>
                        <div>
                            <select id="kodeprodi" name="kodeprodi" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Prodi --- </option>
                                <?php foreach ($listProdi as $lp) : ?>
                                    <option value="<?= $lp->kodeprodi; ?>"><?= $lp->namaprodi; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger kodeprodi-error"></small>
                    </div>
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kateogri</label>
                        <div>
                            <select id="kategori" name="kategori" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Kateogri --- </option>
                                <option value="Dosen">Dosen</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                            </select>
                        </div>
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- namadok -->
                    <div class="form-group col-12" id="inputan_namadok">
                        <label for="namadok" class="form-control-placeholder">Nama Dokumen</label>
                        <input type="text" class="form-control" id="namadok" name="namadok">
                        <small class="text-danger namadok-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control ckeditor" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahPetaProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function ckeditor() {
        var deskripsi = CKEDITOR.instances['deskripsi'].getData();
        $('#deskripsi').val(deskripsi);
    }

    function tambahPetaProcess() {
        ckeditor();
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        let formData = new FormData($('#formPetaPenelitian').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>peta/tambahDataProcess",
            data: $("#formPetaPenelitian").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/peta-penelitian";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.kategori-error').html(data.kategori_error);
                    $('.namadok-error').html(data.namadok_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>