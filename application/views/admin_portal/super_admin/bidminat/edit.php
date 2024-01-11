<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/bidang-minat') ?>"> Bidang Minat</a></li>
            <li><a href="<?php echo base_url('superadmin/bidang-minat/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Bidang Minat
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditBidangMinat" enctype="multipart/form-data">
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
                    <!-- namabidminat -->
                    <div class="form-group col-12" id="inputan_namabidminat">
                        <label for="namabidminat" class="form-control-placeholder">Nama Bidang Minat</label>
                        <input type="text" class="form-control" id="namabidminat" name="namabidminat">
                        <small class="text-danger namabidminat-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Ikon</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- profile -->
                    <div class="form-group col-12 mt-2" id="inputan_profile">
                        <label class="form-control-placeholder" for="profile">Profil</label>
                        <textarea class="form-control ckeditor" id="profile" name="profile" value=""></textarea>
                        <small class="text-danger profile-error"></small>
                    </div>
                    <!-- petapenelitian -->
                    <div class="form-group col-12 mt-2" id="inputan_petapenelitian">
                        <label class="form-control-placeholder" for="petapenelitian">Peta Penelitian</label>
                        <textarea class="form-control ckeditor" id="petapenelitian" name="petapenelitian" value=""></textarea>
                        <small class="text-danger petapenelitian-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editBidangMinatProcess()">Edit</button>
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
        CKEDITOR.instances['petapenelitian'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('bidminat/getbidminatbyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kodeprodi').val(response.kodeprodi);
                $('#namabidminat').val(response.namabidminat);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/bidminat/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#profile').val(response.profile);
                CKEDITOR.replace('profile');
                $('#petapenelitian').val(response.petapenelitian);
                CKEDITOR.replace('petapenelitian');
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

        var petapenelitian = CKEDITOR.instances['petapenelitian'].getData();
        $('#petapenelitian').val(petapenelitian);
    }

    function editBidangMinatProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditBidangMinat').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>bidminat/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/bidang-minat";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.namabidminat-error').html(data.namabidminat_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.profile-error').html(data.profile_error);
                    $('.petapenelitian-error').html(data.petapenelitian_error);
                }
            }
        })
    }
</script>
</body>

</html>