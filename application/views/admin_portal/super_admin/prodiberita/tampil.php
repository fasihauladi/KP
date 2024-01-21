<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/seputar-prodi') ?>"> Seputar Prodi</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Data Seputar Prodi
                </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-flat" role="button" href="<?= base_url(); ?>superadmin/seputar-prodi/tambah"><i class="fa fa-plus"></i> Tambah Seputar Prodi</a>
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
                <table id="tabelProdiBerita" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-capitalize">No.</th>
                            <th class="text-capitalize">Tanggal</th>
                            <th class="text-capitalize">Judul</th>
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

<!-- modal detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="detailModalLabel">Detail Tambahan</h4>
            </div>
            <div class="modal-body">
                <h5><b>Thumbnail</b></h5>
                <div class="row" style="margin: 5px;">
                    <div class="col-12">
                        <div id="detailThumbnail" class="text-center"></div>
                    </div>
                </div>
                <h5><b>Foto</b></h5>
                <div class="row" style="margin: 5px;">
                    <div class="col-12">
                        <div id="detailFoto" class="text-center"></div>
                    </div>
                </div>
                <h5><b>Konten</b></h5>
                <div id="detailContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title" id="hapusModalLabel">Hapus Berita</h4>
            </div>
            <div class="modal-body">
                <form class="form-row" id="formHapusProdiBerita" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <!-- judul -->
                    <div class="form-group col-12" id="inputan_judul">
                        <label for="judul" class="form-control-placeholder">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" readonly>
                        <small class="text-danger judul-error"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" name="tombolHapus" onclick="hapusProdiBeritaProcess()">Hapus</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    //variabel datatable
    var tabelProdiBerita = $('#tabelProdiBerita');
    $(document).ready(function() {
        var fixedTable = tabelProdiBerita.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('prodiberita/readAjaxProdiBerita'); ?>",
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
                "targets": [0, -1, -2],
                "orderable": false,
            }],
        });
    });

    function changeFilter() {
        tabelProdiBerita.DataTable().ajax.reload(null, false);
    }

    function bukaModalDetail(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('prodiberita/getprodiberitabyid/'); ?>' + id,
            dataType: 'JSON',
            success: function(response) {
                if (response.thumbnail == null || response.thumbnail == "") {
                    $("#detailThumbnail").html("<img src='<?= base_url(); ?>assets/images/avatar.png' class='w-25'>");
                } else {
                    $("#detailThumbnail").html("<a class='example-image-link' target='_blank' href='<?= base_url(); ?>assets/gambarDB/berita/prodi/" + response.thumbnail + "' data-lightbox='example-1'><img src='<?= base_url(); ?>assets/gambarDB/berita/prodi/" + response.thumbnail + "' class='w-25' style='width:600px'></a>");
                }
                if (response.foto == null || response.foto == "") {
                    $("#detailFoto").html("<img src='<?= base_url(); ?>assets/images/avatar.png' class='w-25'>");
                } else {
                    $("#detailFoto").html("<a class='example-image-link' target='_blank' href='<?= base_url(); ?>assets/gambarDB/berita/prodi/" + response.foto + "' data-lightbox='example-1'><img src='<?= base_url(); ?>assets/gambarDB/berita/prodi/" + response.foto + "' class='w-25' style='width:600px'></a>");
                }
                $('#detailContent').html(response.content);
                $('#detailModal').modal('show');
            }
        })
    }

    function bukaModalHapus(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('prodiberita/getprodiberitabyid/'); ?>' + id,
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#judul').val(response.judul);

                $('[name="tombolHapus"]').attr("disabled", false);
                $('[name="tombolHapus"]').text("Hapus");
                $('#hapusModal').modal('show');
            }
        })
    }

    function hapusProdiBeritaProcess() {
        $('[name="tombolHapus"]').attr("disabled", true);
        $('[name="tombolHapus"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>prodiberita/hapusDataProcess",
            data: $("#formHapusProdiBerita").serialize() + "&csrf_test_name=" + csrfHash,
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