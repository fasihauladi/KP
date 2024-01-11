<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/visi-misi-prodi') ?>"> Visi Misi Prodi</a></li>
            <li><a href="<?php echo base_url('superadmin/visi-misi-prodi/edit/' . $kode) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Mahasiswa
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditMahasiswa" enctype="multipart/form-data">
                    <input type="hidden" name="kodeprodi_awal" id="kodeprodi_awal" value="<?= $kode; ?>">
                    <!-- kodeprodi -->
                    <div class="form-group col-12" id="inputan_kodeprodi">
                        <label for="kodeprodi" class="form-control-placeholder">Kode Prodi</label>
                        <input type="text" class="form-control" id="kodeprodi" name="kodeprodi" value="<?= $kode; ?>">
                        <small class="text-danger kodeprodi-error"></small>
                    </div>
                    <!-- namaprodi -->
                    <div class="form-group col-12" id="inputan_namaprodi">
                        <label for="namaprodi" class="form-control-placeholder">Nama Prodi</label>
                        <input type="text" class="form-control" id="namaprodi" name="namaprodi">
                        <small class="text-danger namaprodi-error"></small>
                    </div>
                    <!-- profile -->
                    <div class="form-group col-12 mt-2" id="inputan_profile">
                        <label class="form-control-placeholder" for="profile">Profil</label>
                        <textarea class="form-control ckeditor" id="profile" name="profile" value=""></textarea>
                        <small class="text-danger profile-error"></small>
                    </div>
                    <!-- visimisi -->
                    <div class="form-group col-12 mt-2" id="inputan_visimisi">
                        <label class="form-control-placeholder" for="visimisi">Visi Misi</label>
                        <textarea class="form-control ckeditor" id="visimisi" name="visimisi" value=""></textarea>
                        <small class="text-danger visimisi-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editProdiProcess()">Edit</button>
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
        CKEDITOR.instances['visimisi'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('prodi/getprodibykode/'); ?>' + $('#kodeprodi').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#kodeprodi').val(response.kodeprodi);
                $('#namaprodi').val(response.namaprodi);
                $('#profile').val(response.profile);
                CKEDITOR.replace('profile');
                $('#visimisi').val(response.visimisi);
                CKEDITOR.replace('visimisi');
            }
        });
    });

    function ckeditor() {
        var profile = CKEDITOR.instances['profile'].getData();
        $('#profile').val(profile);

        var visimisi = CKEDITOR.instances['visimisi'].getData();
        $('#visimisi').val(visimisi);
    }

    function editProdiProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditMahasiswa').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>prodi/editDataProcess",
            data: $("#formEditMahasiswa").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/visi-misi-prodi";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.namaprodi-error').html(data.namaprodi_error);
                    $('.profile-error').html(data.profile_error);
                    $('.visimisi-error').html(data.visimisi_error);
                }
            }
        })
    }
</script>
</body>

</html>