<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/kategori-jabatan') ?>"> Kategori Jabatan</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data Kategori Jabatan
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/kategori-jabatan/tambah"><i class="fa fa-plus"></i> Tambah Kategori Jabatan</a>
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
                </form>
                <!-- tabel -->
                <table id="tabelKategoriJabatan" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">Kode Jabatan</th>
                            <th class="text-capitalize">Jabatan</th>
                            <th class="text-capitalize">Deskripsi</th>
                            <th class="text-capitalize">Prodi</th>
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
                <h4 class="modal-title" id="hapusModalLabel">Hapus Kategori Jabatan</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusKategoriJabatan" enctype="multipart/form-data">
                    <!-- kodejabatan -->
                    <div class="form-group col-12" id="inputan_kodejabatan">
                        <label for="kodejabatan" class="form-control-placeholder">Kode Jabatan</label>
                        <input type="text" class="form-control" id="kodejabatan" name="kodejabatan" readonly>
                        <small class="text-danger kodejabatan-error"></small>
                    </div>
                    <!-- jabatan -->
                    <div class="form-group col-12" id="inputan_jabatan">
                        <label for="jabatan" class="form-control-placeholder">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" disabled>
                        <small class="text-danger jabatan-error"></small>
                    </div>
                    <!-- kodeprodi -->
                    <div class="form-group col-12" id="inputan_kodeprodi">
                        <label for="kodeprodi" class="form-control-placeholder">Prodi</label>
                        <div>
                            <select id="kodeprodi" name="kodeprodi" class="form-control bg-info text-light" disabled>
                                <option value="null">-</option>
                                <?php foreach ($listProdi as $lp) : ?>
                                    <option value="<?= $lp->kodeprodi; ?>"><?= $lp->namaprodi; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <small class="text-primary kodeprodi-error">*Jika jabatan pada jurusan, maka boleh dikosongkan</small> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusKategoriJabatanProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelKategoriJabatan = $('#tabelKategoriJabatan');
    $(document).ready(function() {
        var fixedTable = tabelKategoriJabatan.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('katjabatan/readAjaxKategoriJabatan'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.prodi_filter = $('#prodi_filter').val();
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
                "targets": [0, 3, 4, 5],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelKategoriJabatan.DataTable().ajax.reload(null, false);
    }

    function bukaModalHapus(kode) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('katjabatan/getkatjabatanbykode/'); ?>' + kode,
            dataType: 'JSON',
            success: function(response) {
                $('#kodejabatan').val(response.kodejabatan);
                $('#jabatan').val(response.jabatan);
                $('#kodeprodi').val(response.kodeprodi);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusKategoriJabatanProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>katjabatan/hapusDataProcess",
            data: $("#formHapusKategoriJabatan").serialize() + "&csrf_test_name=" + csrfHash,
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