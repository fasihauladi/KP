<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/seputar-pengabdian') ?>"> Seputar Pengabdian</a></li>
            <li><a href="<?php echo base_url('superadmin/seputar-pengabdian/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Seputar Pengabdian
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formPengabdianBerita" enctype="multipart/form-data">
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
                    <!-- judul -->
                    <div class="form-group col-12" id="inputan_judul">
                        <label for="judul" class="form-control-placeholder">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <small class="text-danger judul-error"></small>
                    </div>
                    <!-- thumbnail -->
                    <div class="form-group col-12" id="inputan_thumbnail">
                        <label for="thumbnail" class="form-control-placeholder">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        <small class="text-danger thumbnail-error"></small>
                    </div>
                    <!-- foto -->
                    <div class="form-group col-12" id="inputan_foto">
                        <label for="foto" class="form-control-placeholder">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- content -->
                    <div class="form-group col-12 mt-2" id="inputan_content">
                        <label class="form-control-placeholder" for="content">Konten</label>
                        <textarea class="form-control ckeditor" id="content" name="content" value=""></textarea>
                        <small class="text-danger content-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahPengabdianBeritaProcess()">Tambah</button>
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
        var content = CKEDITOR.instances['content'].getData();
        $('#content').val(content);
    }

    function tambahPengabdianBeritaProcess() {
        ckeditor();
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        let formData = new FormData($('#formPengabdianBerita').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>pengabdianberita/tambahDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/seputar-pengabdian";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.judul-error').html(data.judul_error);
                    $('.thumbnail-error').html(data.thumbnail_error);
                    $('.foto-error').html(data.foto_error);
                    $('.content-error').html(data.content_error);
                }
            }
        })
    }
</script>
</body>

</html>