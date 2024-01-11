<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/mahasiswa') ?>"> Mahasiswa</a></li>
            <li><a href="<?php echo base_url('superadmin/mahasiswa/edit/' . $npm) ?>"> Edit</a></li>
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
                    <input type="hidden" name="npm_awal" id="npm_awal" value="<?= $npm; ?>">
                    <!-- npm -->
                    <div class="form-group col-12" id="inputan_npm">
                        <label for="npm" class="form-control-placeholder">NPM</label>
                        <input type="text" class="form-control" id="npm" name="npm" value="<?= $npm; ?>">
                        <small class="text-danger npm-error"></small>
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
                    <!-- nama -->
                    <div class="form-group col-12" id="inputan_nama">
                        <label for="nama" class="form-control-placeholder">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <small class="text-danger nama-error"></small>
                    </div>
                    <!-- angkatan -->
                    <div class="form-group col-12" id="inputan_angkatan">
                        <label for="angkatan" class="form-control-placeholder">Angkatan</label>
                        <input type="number" class="form-control" id="angkatan" name="angkatan">
                        <small class="text-danger angkatan-error"></small>
                    </div>
                    <!-- alamat -->
                    <div class="form-group col-12 mt-2" id="inputan_alamat">
                        <label class="form-control-placeholder" for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" value=""></textarea>
                        <small class="text-danger alamat-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editMahasiswaProcess()">Edit</button>
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
            url: '<?= base_url('mahasiswa/getmahasiswabynpm/'); ?>' + $('#npm').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#npm').val(response.npm);
                $('#kodeprodi').val(response.kodeprodi);
                $('#nama').val(response.nama);
                $('#angkatan').val(response.angkatan);
                $('#alamat').val(response.alamat);
            }
        });
    });

    function editMahasiswaProcess() {
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditMahasiswa').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>mahasiswa/editDataProcess",
            data: $("#formEditMahasiswa").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/mahasiswa";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.npm-error').html(data.npm_error);
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.nama-error').html(data.nama_error);
                    $('.angkatan-error').html(data.angkatan_error);
                    $('.alamat-error').html(data.alamat_error);
                }
            }
        })
    }
</script>
</body>

</html>