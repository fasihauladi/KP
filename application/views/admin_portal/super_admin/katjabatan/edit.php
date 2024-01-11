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
            <li><a href="<?php echo base_url('superadmin/kategori-jabatan/edit/' . $kode) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Kategori jabatan
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditKategoriJabatan" enctype="multipart/form-data">
                    <input type="hidden" name="kodejabatan_awal" id="kodejabatan_awal" value="<?= $kode; ?>">
                    <!-- kodejabatan -->
                    <div class="form-group col-12" id="inputan_kodejabatan">
                        <label for="kodejabatan" class="form-control-placeholder">Kode Jabatan</label>
                        <input type="text" class="form-control" id="kodejabatan" name="kodejabatan" value="<?= $kode; ?>">
                        <small class="text-danger kodejabatan-error"></small>
                    </div>
                    <!-- kodeprodi -->
                    <div class="form-group col-12" id="inputan_kodeprodi">
                        <label for="kodeprodi" class="form-control-placeholder">Prodi</label>
                        <div>
                            <select id="kodeprodi" name="kodeprodi" class="form-control bg-info text-light">
                                <option value="null"> --- Pilih Prodi --- </option>
                                <?php foreach ($listProdi as $lp) : ?>
                                    <option value="<?= $lp->kodeprodi; ?>"><?= $lp->namaprodi; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-primary kodeprodi-error">*Jika jabatan pada jurusan, maka boleh dikosongkan</small>
                    </div>
                    <!-- jabatan -->
                    <div class="form-group col-12" id="inputan_jabatan">
                        <label for="jabatan" class="form-control-placeholder">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                        <small class="text-danger jabatan-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editKategoriJabatanProcess()">Edit</button>
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
            url: '<?= base_url('katjabatan/getkatjabatanbykode/'); ?>' + $('#kodejabatan').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#kodejabatan').val(response.kodejabatan);
                $('#kodeprodi').val(response.kodeprodi);
                $('#jabatan').val(response.jabatan);
                $('#deskripsi').val(response.deskripsi);
            }
        });
    });

    function editKategoriJabatanProcess() {
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>katjabatan/editDataProcess",
            data: $("#formEditKategoriJabatan").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/kategori-jabatan";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodejabatan-error').html(data.kodejabatan_error);
                    $('.jabatan-error').html(data.jabatan_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>