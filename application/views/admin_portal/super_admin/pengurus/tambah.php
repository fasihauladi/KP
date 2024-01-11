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
            <li><a href="<?php echo base_url('superadmin/pengurus/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Pengurus
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formPengurus" enctype="multipart/form-data">
                    <!-- nip -->
                    <div class="form-group col-12" id="inputan_nip">
                        <label for="nip" class="form-control-placeholder">Dosen</label>
                        <div>
                            <select id="nip" name="nip" class="form-control bg-info text-light">
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
                            <select id="kodejabatan" name="kodejabatan" class="form-control bg-info text-light">
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
                            <select id="kodeprodi" name="kodeprodi" class="form-control bg-info text-light">
                                <option value="null"> --- Pilih Prodi --- </option>
                                <?php foreach ($listProdi as $lp) : ?>
                                    <option value="<?= $lp->kodeprodi; ?>"><?= $lp->namaprodi; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-primary kodeprodi-error">*Jika jabatan pada jurusan, maka boleh dikosongkan</small>
                    </div>
                    <!-- tahun -->
                    <div class="form-group col-12" id="inputan_tahun">
                        <label for="tahun" class="form-control-placeholder">Tahun</label>
                        <input type="number" min='2000' max='9999' class="form-control" id="tahun" name="tahun">
                        <small class="text-danger tahun-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahPengurusProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function tambahPengurusProcess() {
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>pengurus/tambahDataProcess",
            data: $("#formPengurus").serialize() + "&csrf_test_name=" + csrfHash,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/pengurus";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.nip-error').html(data.nip_error);
                    $('.kodejabatan-error').html(data.kodejabatan_error);
                    $('.tahun-error').html(data.tahun_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>