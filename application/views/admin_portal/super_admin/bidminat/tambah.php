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
            <li><a href="<?php echo base_url('superadmin/bidang-minat/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Bidang Minat
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formBidangMinat" enctype="multipart/form-data">
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
                    <div class="form-group col-12" id="inputan_foto">
                        <label for="foto" class="form-control-placeholder">Ikon</label>
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
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahBidangMinatProcess()">Tambah</button>
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
        var profile = CKEDITOR.instances['profile'].getData();
        $('#profile').val(profile);

        var petapenelitian = CKEDITOR.instances['petapenelitian'].getData();
        $('#petapenelitian').val(petapenelitian);
    }

    function tambahBidangMinatProcess() {
        ckeditor();
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        let formData = new FormData($('#formBidangMinat').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>bidminat/tambahDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/bidang-minat";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.namabidminat-error').html(data.namabidminat_error);
                    $('.foto-error').html(data.foto_error);
                    $('.profile-error').html(data.profile_error);
                    $('.petapenelitian-error').html(data.petapenelitian_error);
                }
            }
        })
    }
</script>
</body>

</html>