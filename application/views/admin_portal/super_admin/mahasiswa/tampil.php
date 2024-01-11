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
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data Mahasiswa
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/mahasiswa/tambah"><i class="fa fa-plus"></i> Tambah Mahasiswa</a>
                </div>
            </div>

            <div class="box-body">
                <!-- filter tabel -->
                <form class="form-row mt-3" id="formFilter">
                    <div class="form-group col-12">
                        <label class="font-weight-bold text-info">Filter Sesuai</label>
                        <select class="form-control bg-primary text-light" name="prodi_filter" id="prodi_filter" onchange="changeFilter()">
                            <option value="">-- Pilih Prodi --</option>
                            <?php foreach ($listProdi as $lp) : ?>
                                <option value="<?= $lp->kodeprodi; ?>"><?= $lp->namaprodi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <select class="form-control bg-primary text-light" name="angkatan_filter" id="angkatan_filter" onchange="changeFilter()">
                            <option value="">-- Pilih Angkatan --</option>
                            <?php foreach ($listAngkatan as $la) : ?>
                                <option value="<?= $la->angkatan; ?>"><?= $la->angkatan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
                <!-- tabel -->
                <table id="tabelMahasiswa" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">NPM</th>
                            <th class="text-capitalize">Nama</th>
                            <th class="text-capitalize">Prodi</th>
                            <th class="text-capitalize">Angkatan</th>
                            <th class="text-capitalize">Alamat</th>
                            <th class="text-capitalize">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal Password -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="passwordModalLabel">Ubah Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formPassword" enctype="multipart/form-data">
                    <!-- npm_pass -->
                    <div class="form-group col-12" id="inputan_npm_pass">
                        <label for="npm_pass" class="form-control-placeholder">NPM</label>
                        <input type="text" class="form-control" id="npm_pass" name="npm_pass" readonly>
                        <small class="text-danger npm_pass-error"></small>
                    </div>
                    <!-- password_pass -->
                    <div class="form-group col-12" id="inputan_password_pass">
                        <label for="password_pass" class="form-control-placeholder">Password Baru</label>
                        <input type="password" class="form-control" id="password_pass" name="password_pass">
                        <small class="text-danger password_pass-error"></small>
                    </div>
                    <!-- konfirmasi_password_pass -->
                    <div class="form-group col-12" id="inputan_konfirmasi_password_pass">
                        <label for="konfirmasi_password_pass" class="form-control-placeholder">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="konfirmasi_password_pass" name="konfirmasi_password_pass">
                        <small class="text-danger konfirmasi_password_pass-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolPassword" onclick="gantiPasswordProcess()">Ubah</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="hapusModalLabel">Hapus Mahasiswa</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusMahasiswa" enctype="multipart/form-data">
                    <!-- npm -->
                    <div class="form-group col-12" id="inputan_npm">
                        <label for="npm" class="form-control-placeholder">Npm</label>
                        <input type="text" class="form-control" id="npm" name="npm" readonly>
                        <small class="text-danger npm-error"></small>
                    </div>
                    <!-- nama -->
                    <div class="form-group col-12" id="inputan_nama">
                        <label for="nama" class="form-control-placeholder">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" disabled>
                        <small class="text-danger nama-error"></small>
                    </div>
                    <!-- kodeprodi -->
                    <div class="form-group col-12" id="inputan_kodeprodi">
                        <label for="kodeprodi" class="form-control-placeholder">Prodi</label>
                        <div>
                            <select id="kodeprodi" name="kodeprodi" class="form-control bg-info text-light" disabled>
                                <option value="">-</option>
                                <?php foreach ($listProdi as $lp) : ?>
                                    <option value="<?= $lp->kodeprodi; ?>"><?= $lp->namaprodi; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger kodeprodi-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusMahasiswaProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelMahasiswa = $('#tabelMahasiswa');
    $(document).ready(function() {
        var fixedTable = tabelMahasiswa.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('mahasiswa/readAjaxMahasiswa'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.prodi_filter = $('#prodi_filter').val();
                    data.angkatan_filter = $('#angkatan_filter').val();
                    data.csrf_test_name = csrfHash;
                },
                "dataSrc": function(response) {
                    csrfHash = response.token;
                    return response.data;
                }
            },
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "columnDefs": [{
                "targets": [0, -1, -2],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelMahasiswa.DataTable().ajax.reload(null, false);
    }

    function bukaModalHapus(npm) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('mahasiswa/getmahasiswabynpm/'); ?>' + npm,
            dataType: 'JSON',
            success: function(response) {
                $('#npm').val(response.npm);
                $('#nama').val(response.nama);
                $('#kodeprodi').val(response.kodeprodi);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusMahasiswaProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>mahasiswa/hapusDataProcess",
            data: $("#formHapusMahasiswa").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    changeFilter();
                    $('#hapusModal').modal('hide');
                    Swal.fire('Data Berhasil Dihapus', '', 'success')
                } else {
                    $('[name="tombolHapus"]').attr("disabled", false);
                    $('[name="tombolHapus"]').text("Hapus");
                }
            }
        });
    }

    function bukaModalPassword(npm) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('mahasiswa/getmahasiswabynpm/'); ?>' + npm,
            dataType: 'JSON',
            success: function(response) {
                $('#formPassword')[0].reset();
                $('#npm_pass').val(response.npm);

                $('.password_pass-error').html('');
                $('.konfirmasi_password_pass-error').html('');

                $('[name="tombolPassword"]').attr("disabled", false);
                $('[name="tombolPassword"]').text("Ubah");
                $('#passwordModal').modal('show');
            }
        })
    }

    function gantiPasswordProcess() {
        $('[name="tombolPassword"]').attr("disabled", true);
        $('[name="tombolPassword"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>mahasiswa/gantiPasswordProcess",
            data: $("#formPassword").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    changeFilter();
                    $('#passwordModal').modal('hide');
                    Swal.fire('Password Berhasil Dirubah', '', 'success')
                } else {
                    $('.password_pass-error').html(data.password_pass_error);
                    $('.konfirmasi_password_pass-error').html(data.konfirmasi_password_pass_error);
                    $('[name="tombolPassword"]').attr("disabled", false);
                    $('[name="tombolPassword"]').text("Ubah");
                }
            }
        });
    }
</script>
</body>

</html>