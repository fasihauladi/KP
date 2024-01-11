<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/macam-pengabdian') ?>"> Macam Pengabdian</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data Macam Pengabdian
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/macam-pengabdian/tambah"><i class="fa fa-plus"></i> Tambah Macam Pengabdian</a>
                </div>
            </div>
            <div class="box-body">
                <!-- tabel -->
                <table id="tabelMacamPengabdian" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">Kategori</th>
                            <th class="text-capitalize">Sub Kategori</th>
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
                <h4 class="modal-title" id="hapusModalLabel">Hapus Macam Pengabdian</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusMacamPengabdian" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" disabled>
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- subkategori -->
                    <div class="form-group col-12" id="inputan_subkategori">
                        <label for="subkategori" class="form-control-placeholder">Sub Kategori</label>
                        <input type="text" class="form-control" id="subkategori" name="subkategori" disabled>
                        <small class="text-danger subkategori-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusMacamPengabdianProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelMacamPengabdian = $('#tabelMacamPengabdian');
    $(document).ready(function() {
        var fixedTable = tabelMacamPengabdian.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('katpengabdian/readAjaxMacamPengabdian'); ?>",
                "type": "POST",
                "data": function(data) {
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
                "targets": [0, 3, 4],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelMacamPengabdian.DataTable().ajax.reload(null, false);
    }

    function bukaModalHapus(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('katpengabdian/getkatpengabdianbyid/'); ?>' + id,
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kategori').val(response.kategori);
                $('#subkategori').val(response.subkategori);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusMacamPengabdianProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>katpengabdian/hapusDataProcess",
            data: $("#formHapusMacamPengabdian").serialize() + "&csrf_test_name=" + csrfHash,
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