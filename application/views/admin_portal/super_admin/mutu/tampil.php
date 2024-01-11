<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/standar-operasional-prosedur') ?>"> SOP</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data SOP/Kategori Mutu
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/standar-operasional-prosedur/tambah"><i class="fa fa-plus"></i> Tambah SOP/Kategori Mutu</a>
                </div>
            </div>
            <div class="box-body">
                <!-- filter tabel -->
                <form class="form-row mt-3" id="formFilter">
                    <div class="form-group col-12">
                        <label class="font-weight-bold text-info">Filter Sesuai</label>
                        <select class="form-control bg-primary text-light" name="kategori_filter" id="kategori_filter" onchange="changeFilter()">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="SOP">SOP</option>
                            <option value="Mutu">Mutu</option>
                        </select>
                    </div>
                </form>
                <!-- tabel -->
                <table id="tabelSOP" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">Kategori</th>
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
                <h4 class="modal-title" id="hapusModalLabel">Hapus SOP/Kategori Mutu</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusSOP" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <!-- kategori -->
                    <div class="form-group col-12" id="inputan_kategori">
                        <label for="kategori" class="form-control-placeholder">Kategori</label>
                        <div>
                            <select id="kategori" name="kategori" class="form-control bg-info text-light" disabled>
                                <option value="">-</option>
                                <option value="SOP">SOP</option>
                                <option value="Mutu">Mutu</option>
                            </select>
                        </div>
                        <small class="text-danger kategori-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value="" disabled></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusSOPProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelSOP = $('#tabelSOP');
    $(document).ready(function() {
        var fixedTable = tabelSOP.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('mutu/readAjaxSOP'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.kategori_filter = $('#kategori_filter').val();
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
                "targets": [0, 3],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelSOP.DataTable().ajax.reload(null, false);
    }

    function bukaModalHapus(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('mutu/getmutubyid/'); ?>' + id,
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kategori').val(response.kategori);
                $('#deskripsi').val(response.deskripsi);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusSOPProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>mutu/hapusDataProcess",
            data: $("#formHapusSOP").serialize() + "&csrf_test_name=" + csrfHash,
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