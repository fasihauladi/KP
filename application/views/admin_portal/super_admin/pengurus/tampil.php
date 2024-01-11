<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/pengurus') ?>"> Pengurus</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data Pengurus
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/pengurus/tambah"><i class="fa fa-plus"></i> Tambah Pengurus</a>
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
                        <select class="form-control bg-primary text-light" name="kategorijabatan_filter" id="kategorijabatan_filter" onchange="changeFilter()">
                            <option value="">-- Pilih Jabatan--</option>
                            <?php foreach ($listKategoriJabatan as $lkj) : ?>
                                <option value="<?= $lkj->kodejabatan; ?>"><?= $lkj->jabatan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <select class="form-control bg-primary text-light" name="tahun_filter" id="tahun_filter" onchange="changeFilter()">
                            <option value="">-- Pilih Tahun--</option>
                            <?php foreach ($listTahun as $lt) : ?>
                                <option value="<?= $lt->tahun; ?>"><?= $lt->tahun; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
                <!-- tabel -->
                <table id="tabelPengurus" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">Dosen</th>
                            <th class="text-capitalize">Jabatan</th>
                            <th class="text-capitalize">Tahun</th>
                            <th class="text-capitalize">Prodi</th>
                            <th class="text-capitalize">Deskripsi</th>
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



<!-- Modal hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="hapusModalLabel">Hapus Pengurus</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusPengurus" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id">
                    <!-- nip -->
                    <div class="form-group col-12" id="inputan_nip">
                        <label for="nip" class="form-control-placeholder">Dosen</label>
                        <div>
                            <select id="nip" name="nip" class="form-control bg-info text-light" disabled>
                                <option value=""> --- Pilih Dosen --- </option>
                                <?php foreach ($listDosen as $ld) : ?>
                                    <option value="<?= $ld->nip; ?>"><?= $ld->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger nip-error"></small>
                    </div>
                    <!-- kodejabatan -->
                    <div class="form-group col-12" id="inputan_kodejabatan">
                        <label for="kodejabatan" class="form-control-placeholder">Jabatan</label>
                        <div>
                            <select id="kodejabatan" name="kodejabatan" class="form-control bg-info text-light" disabled>
                                <option value=""> --- Pilih Jabatan --- </option>
                                <?php foreach ($listKategoriJabatan as $lkj) : ?>
                                    <option value="<?= $lkj->kodejabatan; ?>"><?= $lkj->jabatan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger kodejabatan-error"></small>
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
                    <!-- tahun -->
                    <div class="form-group col-12" id="inputan_tahun">
                        <label for="tahun" class="form-control-placeholder">Tahun</label>
                        <input type="number" min='2000' max='9999' class="form-control" id="tahun" name="tahun" disabled>
                        <small class="text-danger tahun-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusPengurusProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelPengurus = $('#tabelPengurus');
    $(document).ready(function() {
        var fixedTable = tabelPengurus.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('pengurus/readAjaxPengurus'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.prodi_filter = $('#prodi_filter').val();
                    data.kategorijabatan_filter = $('#kategorijabatan_filter').val();
                    data.tahun_filter = $('#tahun_filter').val();
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
                "targets": [0, 1, 2, 4, 5, 6],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelPengurus.DataTable().ajax.reload(null, false);
    }

    function bukaModalHapus(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('pengurus/getpengurusbyid/'); ?>' + id,
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#nip').val(response.nip);
                $('#kodejabatan').val(response.kodejabatan);
                $('#kodeprodi').val(response.kodeprodi);
                $('#tahun').val(response.tahun);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusPengurusProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>pengurus/hapusDataProcess",
            data: $("#formHapusPengurus").serialize() + "&csrf_test_name=" + csrfHash,
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
</script>
</body>

</html>