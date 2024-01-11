<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/dosen') ?>"> Dosen</a></li>
            <li><a href="<?php echo base_url('superadmin/dosen/tambah') ?>"> Tambah</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Tambah Dosen
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formDosen" enctype="multipart/form-data">
                    <!-- nip -->
                    <div class="form-group col-12" id="inputan_nip">
                        <label for="nip" class="form-control-placeholder">NIP</label>
                        <input type="number" class="form-control" id="nip" name="nip">
                        <small class="text-danger nip-error"></small>
                    </div>
                    <!-- nama -->
                    <div class="form-group col-12" id="inputan_nama">
                        <label for="nama" class="form-control-placeholder">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <small class="text-danger nama-error"></small>
                    </div>
                    <!-- email -->
                    <div class="form-group col-12" id="inputan_email">
                        <label for="email" class="form-control-placeholder">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <small class="text-danger email-error"></small>
                    </div>
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
                    <!-- bidminatid -->
                    <div class="form-group col-12" id="inputan_bidminatid">
                        <label for="bidminatid" class="form-control-placeholder">Bidang Minat</label>
                        <div>
                            <select id="bidminatid" name="bidminatid" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Bidang Minat --- </option>
                                <?php foreach ($listBidangMinat as $lbm) : ?>
                                    <option value="<?= $lbm->id; ?>"><?= $lbm->namabidminat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger bidminatid-error"></small>
                    </div>
                    <!-- foto -->
                    <div class="form-group col-12" id="inputan_foto">
                        <label for="foto" class="form-control-placeholder">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- penelitian -->
                    <div class="form-group col-12 mt-2" id="inputan_penelitian">
                        <label class="form-control-placeholder" for="penelitian">Penelitian</label>
                        <textarea class="form-control ckeditor" id="penelitian" name="penelitian" value=""></textarea>
                        <small class="text-danger penelitian-error"></small>
                    </div>
                </form>
                <div id="btnTambah">
                    <button type="button" class="btn btn-primary" name="tombolTambah" onclick="tambahDosenProcess()">Tambah</button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view("admin_portal/template/footer"); ?>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function ckeditor() {
        var penelitian = CKEDITOR.instances['penelitian'].getData();
        $('#penelitian').val(penelitian);
    }

    function tambahDosenProcess() {
        ckeditor();
        $('[name="tombolTambah"]').attr("disabled", true);
        $('[name="tombolTambah"]').text("loading..");
        let formData = new FormData($('#formDosen').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>dosen/tambahDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Ditambahkan', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/dosen";
                    });;
                } else if (data.message == "gagal") {
                    $('[name="tombolTambah"]').attr("disabled", false);
                    $('[name="tombolTambah"]').text("Tambah");
                    // pengaturan error
                    $('.nip-error').html(data.nip_error);
                    $('.nama-error').html(data.nama_error);
                    $('.email-error').html(data.email_error);
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.bidminatid-error').html(data.bidminatid_error);
                    $('.foto-error').html(data.foto_error);
                    $('.penelitian-error').html(data.penelitian_error);
                }
            }
        })
    }
</script>
</body>

</html>