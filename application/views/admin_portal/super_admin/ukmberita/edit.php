<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/seputar-ukm') ?>"> Seputar UKM</a></li>
            <li><a href="<?php echo base_url('superadmin/seputar-ukm/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Seputar UKM
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditUKMBerita" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
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
                    <!-- ukmid -->
                    <div class="form-group col-12" id="inputan_ukmid">
                        <label for="ukmid" class="form-control-placeholder">UKM</label>
                        <div>
                            <select id="ukmid" name="ukmid" class="form-control bg-info text-light">
                                <option value=""> --- Pilih UKM --- </option>
                                <?php foreach ($listUKM as $lu) : ?>
                                    <option value="<?= $lu->id; ?>"><?= $lu->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger ukmid-error"></small>
                    </div>
                    <!-- judul -->
                    <div class="form-group col-12" id="inputan_judul">
                        <label for="judul" class="form-control-placeholder">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <small class="text-danger judul-error"></small>
                    </div>
                    <!-- tanggal -->
                    <div class="form-group col-12" id="inputan_tanggal">
                        <label for="tanggal" class="form-control-placeholder">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <small class="text-danger tanggal-error"></small>
                    </div>
                    <!-- thumbnail -->
                    <label for="thumbnail" class="form-control-placeholder">Thumbnail</label>
                    <div id="tempatThumbnail"></div>
                    <div class="form-group col-12" id="inputan_thumbnail">
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        <small class="text-danger thumbnail-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
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
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editUKMBeritaProcess()">Edit</button>
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
        CKEDITOR.instances['content'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('ukmberita/getukmberitabyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kodeprodi').val(response.kodeprodi);
                $('#ukmid').val(response.ukmid);
                $('#judul').val(response.judul);
                $('#tanggal').val(response.tanggal);
                if (response.thumbnail) {
                    $('#tempatThumbnail').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/berita/ukm/' + response.thumbnail + '" alt="Thumbnail" id="lihatThumbnail" name="lihatThumbnail">');
                }
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/berita/ukm/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#content').val(response.content);
                CKEDITOR.replace('content');
            }
        });

        $('#foto').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#lihatFoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#thumbnail').change(function() {
            let reader2 = new FileReader();
            reader2.onload = (e) => {
                $('#lihatThumbnail').attr('src', e.target.result);
            }
            reader2.readAsDataURL(this.files[0]);
        });
    });

    function ckeditor() {
        var content = CKEDITOR.instances['content'].getData();
        $('#content').val(content);
    }

    function editUKMBeritaProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditUKMBerita').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>ukmberita/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/seputar-ukm";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.ukmid-error').html(data.ukmid_error);
                    $('.judul-error').html(data.judul_error);
                    $('.tanggal-error').html(data.tanggal_error);
                    // $('.thumbnail-error').html(data.thumbnail_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.content-error').html(data.content_error);
                }
            }
        })
    }
</script>
</body>

</html>