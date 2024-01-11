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
            <li><a href="<?php echo base_url('superadmin/dosen/edit/' . $nip) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Dosen
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditDosen" enctype="multipart/form-data">
                    <input type="hidden" name="nip_awal" id="nip_awal" value="<?= $nip; ?>">
                    <!-- nip -->
                    <div class="form-group col-12" id="inputan_nip">
                        <label for="nip" class="form-control-placeholder">NIP</label>
                        <input type="number" class="form-control" id="nip" name="nip" value="<?= $nip; ?>">
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
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
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
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editDosenProcess()">Edit</button>
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
        CKEDITOR.instances['penelitian'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('dosen/getdosenbynip/'); ?>' + $('#nip').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#nip').val(response.nip);
                $('#nama').val(response.nama);
                $('#email').val(response.email);
                $('#kodeprodi').val(response.kodeprodi);
                $('#bidminatid').val(response.bidminatid);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/dosen/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#penelitian').val(response.penelitian);
                CKEDITOR.replace('penelitian');
            }
        });

        $('#foto').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#lihatFoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

    function ckeditor() {
        var penelitian = CKEDITOR.instances['penelitian'].getData();
        $('#penelitian').val(penelitian);
    }

    function editDosenProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditDosen').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>dosen/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/dosen";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.nip-error').html(data.nip_error);
                    $('.nama-error').html(data.nama_error);
                    $('.email-error').html(data.email_error);
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.bidminatid-error').html(data.bidminatid_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.penelitian-error').html(data.penelitian_error);
                }
            }
        })
    }
</script>
</body>

</html>