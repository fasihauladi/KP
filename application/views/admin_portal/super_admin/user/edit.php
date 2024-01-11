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
            <li><a href="<?php echo base_url('superadmin/admin/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Admin
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditUser" enctype="multipart/form-data">
                    <!-- id -->
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
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
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- level -->
                    <div class="form-group col-12" id="inputan_level">
                        <label for="level" class="form-control-placeholder">Level</label>
                        <div>
                            <select id="level" name="level" class="form-control" onchange="changeLevel()">
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
                            <select id="kodeprodi" name="kodeprodi" class="form-control">
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
                    <!-- status -->
                    <div class="form-group col-12" id="inputan_status">
                        <label for="status" class="form-control-placeholder">Status</label>
                        <div>
                            <select id="status" name="status" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <small class="text-danger status-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editUserProcess()">Edit</button>
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
        $.ajax({
            type: 'GET',
            url: '<?= base_url('user/getuserbyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#nama').val(response.nama);
                $('#jk').val(response.jk);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/user/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#level').val(response.level);
                if (response.prodi) {
                    $('#inputan_kodeprodi').show();
                    $('#kodeprodi').val(response.prodi);
                } else {
                    $('#inputan_kodeprodi').hide();
                }
                $('#username').val(response.username);
                $('#status').val(response.status);
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

    function changeLevel() {
        if ($('#level').val() == 'AP') {
            $('#inputan_kodeprodi').show();
        } else {
            $('#inputan_kodeprodi').hide();
            $('#kodeprodi').val('');
            $('.kodeprodi-error').html('');
        }
    }

    function editUserProcess() {
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditUser').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>user/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/admin";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.nama-error').html(data.nama_error);
                    $('.jk-error').html(data.jk_error);
                    $('.level-error').html(data.level_error);
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.username-error').html(data.username_error);
                }
            }
        })
    }
</script>
</body>

</html>