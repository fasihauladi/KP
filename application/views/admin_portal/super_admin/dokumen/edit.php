<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/dokumen-mutu') ?>"> Dokumen Mutu</a></li>
            <li><a href="<?php echo base_url('superadmin/dokumen-mutu/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Dokumen Mutu/SOP
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditDokumenMutu" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= $id ?>">
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
                    <!-- mutuid -->
                    <div class="form-group col-12" id="inputan_mutuid">
                        <label for="mutuid" class="form-control-placeholder">Kategori</label>
                        <div>
                            <select id="mutuid" name="mutuid" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Kategori--- </option>
                                <?php foreach ($listKategori as $lk) : ?>
                                    <option value="<?= $lk->id; ?>"><?= $lk->deskripsi; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger mutuid-error"></small>
                    </div>
                    <!-- namadokumen -->
                    <div class="form-group col-12" id="inputan_namadokumen">
                        <label for="namadokumen" class="form-control-placeholder">Nama Dokumen</label>
                        <input type="text" class="form-control" id="namadokumen" name="namadokumen">
                        <small class="text-danger namadokumen-error"></small>
                    </div>
                    <!-- deskripsidokumen -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsidokumen">
                        <label class="form-control-placeholder" for="deskripsidokumen">Deskripsi Dokumen</label>
                        <textarea class="form-control" id="deskripsidokumen" name="deskripsidokumen" value=""></textarea>
                        <small class="text-danger deskripsidokumen-error"></small>
                    </div>
                    <!-- path_pdf -->
                    <div class="form-group col-12" id="inputan_path_pdf">
                        <label for="path_pdf" class="form-control-placeholder">File PDF</label>
                        <input type="file" class="form-control" id="path_pdf" name="path_pdf">
                        <small class="text-primary path_pdf-error">**Kosongkan jika tidak perlu dirubah</small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editDokumenMutuProcess()">Edit</button>
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
            url: '<?= base_url('dokumen/getdokumenbyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kodeprodi').val(response.kodeprodi);
                $('#mutuid').val(response.mutuid);
                $('#namadokumen').val(response.namadokumen);
                $('#deskripsidokumen').val(response.deskripsidokumen);
            }
        });
    });

    function editDokumenMutuProcess() {
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditDokumenMutu').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>dokumen/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/dokumen-mutu";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.mutuid-error').html(data.mutuid_error);
                    $('.namadokumen-error').html(data.namadokumen_error);
                    $('.deskripsidokumen-error').html(data.deskripsidokumen_error);
                    // $('.path_pdf-error').html(data.path_pdf_error);
                }
            }
        })
    }
</script>
</body>

</html>