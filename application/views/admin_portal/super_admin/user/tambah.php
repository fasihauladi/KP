<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/admin') ?>"> Admin</a></li>
            <li><a href="<?php echo base_url('superadmin/admin/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Admin
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formUser" enctype="multipart/form-data">
                    <!-- id -->
                    <input type="hidden" name="id" id="id">
                    <!-- nama -->
                    <div class="form-group col-12" id="inputan_nama">
                        <label for="nama" class="form-control-placeholder">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <small class="text-danger nama-error"></small>
                    </div>
                    <!-- jk -->
                    <div class="form-group col-12" id="inputan_jk">
                        <label for="jk" class="form-control-placeholder">Jenis Kelamin</label>
                        <div>
                            <select id="jk" name="jk" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Jenis kelamin --- </option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <small class="text-danger jk-error"></small>
                    </div>
                    <!-- foto -->
                    <div class="form-group col-12" id="inputan_foto">
                        <label for="foto" class="form-control-placeholder">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- level -->
                    <div class="form-group col-12" id="inputan_level">
                        <label for="level" class="form-control-placeholder">Level</label>
                        <div>
                            <select id="level" name="level" class="form-control bg-info text-light" onchange="changeLevel()">
                                <option value=""> --- Pilih Level --- </option>
                                <option value="SA">Super Admin</option>
                                <option value="AP">Admin Prodi</option>
                            </select>
                        </div>
                        <small class="text-danger level-error"></small>
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
                    <!-- username -->
                    <div class="form-group col-12" id="inputan_username">
                        <label for="username" class="form-control-placeholder">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <small class="text-danger username-error"></small>
                    </div>
                    <!-- password -->
                    <div class="form-group col-12" id="inputan_password">
                        <label for="password" class="form-control-placeholder">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-danger password-error"></small>
                    </div>
                    <!-- konfirmasi_password -->
                    <div class="form-group col-12" id="inputan_konfirmasi_password">
                        <label for="konfirmasi_password" class="form-control-placeholder">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                        <small class="text-danger konfirmasi_password-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahUserProcess()">Tambah</button>
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
        $('#inputan_kodeprodi').hide();
    });

    function changeLevel() {
        if ($('#level').val() == 'AP') {
            $('#inputan_kodeprodi').show();
        } else {
            $('#inputan_kodeprodi').hide();
            $('#kodeprodi').val('');
            $('.kodeprodi-error').html('');
        }
    }

    function tambahUserProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        let formData = new FormData($('#formUser').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>user/tambahDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/admin";
                    });;
                } else if (data.message == "gagal") {
                    // awalan
                    $('#konfirmasi_password').val('');
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.nama-error').html(data.nama_error);
                    $('.jk-error').html(data.jk_error);
                    $('.level-error').html(data.level_error);
                    $('.username-error').html(data.username_error);
                    $('.password-error').html(data.password_error);
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.konfirmasi_password-error').html(data.konfirmasi_password_error);
                    $('.foto-error').html(data.foto_error);
                }
            }
        })
    }
</script>
</body>

</html>