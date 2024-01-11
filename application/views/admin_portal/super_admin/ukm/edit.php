<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/unit-kegiatan-mahasiswa') ?>"> UKM</a></li>
            <li><a href="<?php echo base_url('superadmin/unit-kegiatan-mahasiswa/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit UKM
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditUKM" enctype="multipart/form-data">
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
                    <!-- nama -->
                    <div class="form-group col-12" id="inputan_nama">
                        <label for="nama" class="form-control-placeholder">Nama UKM</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <small class="text-danger nama-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control ckeditor" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editUKMProcess()">Edit</button>
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
        CKEDITOR.instances['deskripsi'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('ukm/getukmbyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kodeprodi').val(response.kodeprodi);
                $('#nama').val(response.nama);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/ukm/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#deskripsi').val(response.deskripsi);
                CKEDITOR.replace('deskripsi');
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

    function ckeditor() {
        var deskripsi = CKEDITOR.instances['deskripsi'].getData();
        $('#deskripsi').val(deskripsi);
    }

    function editUKMProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditUKM').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>ukm/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/unit-kegiatan-mahasiswa";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.nama-error').html(data.nama_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>