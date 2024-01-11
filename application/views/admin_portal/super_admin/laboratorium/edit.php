<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/profil-laboratorium') ?>"> Profil Laboratorium</a></li>
            <li><a href="<?php echo base_url('superadmin/profil-laboratorium/edit/' . $kode) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Laboratorium
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditLaboratorium" enctype="multipart/form-data">
                    <input type="hidden" name="kodelab_awal" id="kodelab_awal" value="<?= $kode; ?>">
                    <!-- kodelab -->
                    <div class="form-group col-12" id="inputan_kodelab">
                        <label for="kodelab" class="form-control-placeholder">Kode Lab.</label>
                        <input type="text" class="form-control" id="kodelab" name="kodelab" value="<?= $kode; ?>">
                        <small class="text-danger kodelab-error"></small>
                    </div>
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
                    <!-- katlabid -->
                    <div class="form-group col-12" id="inputan_katlabid">
                        <label for="katlabid" class="form-control-placeholder">Kategori Lab.</label>
                        <div>
                            <select id="katlabid" name="katlabid" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Kategori Lab. --- </option>
                                <?php foreach ($listKategoriLaboratorium as $lkl) : ?>
                                    <option value="<?= $lkl->id; ?>"><?= $lkl->kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger katlabid-error"></small>
                    </div>
                    <!-- nip -->
                    <div class="form-group col-12" id="inputan_nip">
                        <label for="nip" class="form-control-placeholder">Dosen Penanggung Jawab</label>
                        <div>
                            <select id="nip" name="nip" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Dosen --- </option>
                                <?php foreach ($listDosen as $ld) : ?>
                                    <option value="<?= $ld->nip; ?>"><?= $ld->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger nip-error"></small>
                    </div>
                    <!-- namalab -->
                    <div class="form-group col-12" id="inputan_namalab">
                        <label for="namalab" class="form-control-placeholder">Nama Lab.</label>
                        <input type="text" class="form-control" id="namalab" name="namalab">
                        <small class="text-danger namalab-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- profile -->
                    <div class="form-group col-12 mt-2" id="inputan_profile">
                        <label class="form-control-placeholder" for="profile">Profil Lab.</label>
                        <textarea class="form-control ckeditor" id="profile" name="profile" value=""></textarea>
                        <small class="text-danger profile-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editLaboratoriumProcess()">Edit</button>
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
        CKEDITOR.instances['profile'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('laboratorium/getlaboratoriumbykode/'); ?>' + $('#kodelab').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#kodelab').val(response.kodelab);
                $('#kodeprodi').val(response.kodeprodi);
                $('#katlabid').val(response.katlabid);
                $('#nip').val(response.nip);
                $('#namalab').val(response.namalab);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/laboratorium/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#profile').val(response.profile);
                CKEDITOR.replace('profile');
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
        var profile = CKEDITOR.instances['profile'].getData();
        $('#profile').val(profile);
    }

    function editLaboratoriumProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditLaboratorium').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>laboratorium/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/profil-laboratorium";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodelab-error').html(data.kodelab_error);
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.katlabid-error').html(data.katlabid_error);
                    $('.nip-error').html(data.nip_error);
                    $('.namalab-error').html(data.namalab_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.profile-error').html(data.profile_error);
                }
            }
        })
    }
</script>
</body>

</html>