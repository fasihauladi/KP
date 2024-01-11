<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/karya-laboratorium') ?>"> Karya Laboratorium</a></li>
            <li><a href="<?php echo base_url('superadmin/karya-laboratorium/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Karya Laboratorium
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditKaryaLaboratorium" enctype="multipart/form-data">
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
                    <!-- kodelab -->
                    <div class="form-group col-12" id="inputan_kodelab">
                        <label for="kodelab" class="form-control-placeholder">Laboratorium</label>
                        <div>
                            <select id="kodelab" name="kodelab" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Laboratorium --- </option>
                                <?php foreach ($listLaboratorium as $ll) : ?>
                                    <option value="<?= $ll->kodelab; ?>"><?= $ll->namalab; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger kodelab-error"></small>
                    </div>
                    <!-- namakarya -->
                    <div class="form-group col-12" id="inputan_namakarya">
                        <label for="namakarya" class="form-control-placeholder">Nama Karya</label>
                        <input type="text" class="form-control" id="namakarya" name="namakarya">
                        <small class="text-danger namakarya-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- deskripsikarya -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsikarya">
                        <label class="form-control-placeholder" for="deskripsikarya">Deskripsi</label>
                        <textarea class="form-control ckeditor" id="deskripsikarya" name="deskripsikarya" value=""></textarea>
                        <small class="text-danger deskripsikarya-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editKaryaLaboratoriumProcess()">Edit</button>
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
        CKEDITOR.instances['deskripsikarya'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('karyalab/getkaryalabbyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kodeprodi').val(response.kodeprodi);
                $('#kodelab').val(response.kodelab);
                $('#namakarya').val(response.namakarya);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/karya/lab/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#deskripsikarya').val(response.deskripsikarya);
                CKEDITOR.replace('deskripsikarya');
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
        var deskripsikarya = CKEDITOR.instances['deskripsikarya'].getData();
        $('#deskripsikarya').val(deskripsikarya);
    }

    function editKaryaLaboratoriumProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditKaryaLaboratorium').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>karyalab/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/karya-laboratorium";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.kodelab-error').html(data.kodelab_error);
                    $('.namakarya-error').html(data.namakarya_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.deskripsikarya-error').html(data.deskripsikarya_error);
                }
            }
        })
    }
</script>
</body>

</html>