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
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data Prodi
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/visi-misi-prodi/tambah"><i class="fa fa-plus"></i> Tambah Prodi</a>
                </div>
            </div>

            <div class="box-body">
                <!-- tabel -->
                <table id="tabelProdi" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">Kode Prodi</th>
                            <th class="text-capitalize">Nama Prodi</th>
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

<!-- modal profile -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="profileModalLabel">Profil</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px;">
                    <div class="col-12">
                        <div id="detailProfile"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <!--<button type="button" class="btn btn-primary">Simpan</button>-->
            </div>
        </div>
    </div>
</div>

<!-- modal Visi Misi -->
<div class="modal fade" id="visiMisiModal" tabindex="-1" role="dialog" aria-labelledby="visiMisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="visiMisiModalLabel">Visi Misi</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px;">
                    <div class="col-12">
                        <div id="detailVisiMisi"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <!--<button type="button" class="btn btn-primary">Simpan</button>-->
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
                <h4 class="modal-title" id="hapusModalLabel">Hapus Prodi</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusProdi" enctype="multipart/form-data">
                    <!-- kodeprodi -->
                    <div class="form-group col-12" id="inputan_kodeprodi">
                        <label for="kodeprodi" class="form-control-placeholder">Kode Prodi</label>
                        <input type="text" class="form-control" id="kodeprodi" name="kodeprodi" readonly>
                        <small class="text-danger kodeprodi-error"></small>
                    </div>
                    <!-- namaprodi -->
                    <div class="form-group col-12" id="inputan_namaprodi">
                        <label for="namaprodi" class="form-control-placeholder">Nama Prodi</label>
                        <input type="text" class="form-control" id="namaprodi" name="namaprodi" disabled>
                        <small class="text-danger namaprodi-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusProdiProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelProdi = $('#tabelProdi');
    $(document).ready(function() {
        var fixedTable = tabelProdi.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('prodi/readAjaxProdi'); ?>",
                "type": "POST",
                "data": function(data) {
                    // data.prodi_filter = $('#prodi_filter').val();
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
                "targets": [0, -1],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelProdi.DataTable().ajax.reload(null, false);
    }

    function bukaModalProfile(kode) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('prodi/getprodibykode/'); ?>' + kode,
            dataType: 'JSON',
            success: function(response) {
                $('#detailProfile').html(response.profile)
                $('#profileModal').modal('show');
            }
        })
    }

    function bukaModalVisiMisi(kode) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('prodi/getprodibykode/'); ?>' + kode,
            dataType: 'JSON',
            success: function(response) {
                $('#detailVisiMisi').html(response.visimisi)
                $('#visiMisiModal').modal('show');
            }
        })
    }

    function bukaModalHapus(kode) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('prodi/getprodibykode/'); ?>' + kode,
            dataType: 'JSON',
            success: function(response) {
                $('#kodeprodi').val(response.kodeprodi);
                $('#namaprodi').val(response.namaprodi);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusProdiProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>prodi/hapusDataProcess",
            data: $("#formHapusProdi").serialize() + "&csrf_test_name=" + csrfHash,
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