<!-- content -->
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
        <h1 class="text-capitalize">
            Super Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('superadmin') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="<?php echo base_url('superadmin/karya-pengabdian') ?>"> Karya Pengabdian</a></li>
            <li><a href="<?php echo base_url('superadmin/karya-pengabdian/edit/' . $id) ?>"> Edit</a></li>
        </ol>
    </section>
    <!-- main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Edit Karya Pengabidan
                </h3>
            </div>
            <div class="box-body">
                <form class="form-row" id="formEditKaryaPengabdian" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
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
                    <!-- katpengabdianid -->
                    <div class="form-group col-12" id="inputan_katpengabdianid">
                        <label for="katpengabdianid" class="form-control-placeholder">Kategori Pengabdian</label>
                        <div>
                            <select id="katpengabdianid" name="katpengabdianid" class="form-control bg-info text-light">
                                <option value=""> --- Pilih Kategori Pengabdian --- </option>
                                <?php foreach ($listKategoriPengabdian as $lkp) : ?>
                                    <option value="<?= $lkp->id; ?>">(<?= $lkp->kategori; ?>) <?= $lkp->subkategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-danger katpengabdianid-error"></small>
                    </div>
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
                    <!-- judul -->
                    <div class="form-group col-12" id="inputan_judul">
                        <label for="judul" class="form-control-placeholder">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <small class="text-danger judul-error"></small>
                    </div>
                    <!-- sumberdana -->
                    <div class="form-group col-12" id="inputan_sumberdana">
                        <label for="sumberdana" class="form-control-placeholder">Sumber Dana</label>
                        <input type="text" class="form-control" id="sumberdana" name="sumberdana">
                        <small class="text-danger sumberdana-error"></small>
                    </div>
                    <!-- foto -->
                    <label for="foto" class="form-control-placeholder">Foto</label>
                    <div id="tempatFoto"></div>
                    <div class="form-group col-12" id="inputan_foto">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small class="text-danger foto-error"></small>
                    </div>
                    <!-- deskripsi -->
                    <div class="form-group col-12 mt-2" id="inputan_deskripsi">
                        <label class="form-control-placeholder" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control ckeditor" id="deskripsi" name="deskripsi" value=""></textarea>
                        <small class="text-danger deskripsi-error"></small>
                    </div>
                </form>
                <div id="btnEdit">
                    <button type="button" class="btn btn-primary" name="tombolEdit" onclick="editKaryaPengabdianProcess()">Edit</button>
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
        CKEDITOR.instances['deskripsi'].destroy();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('karyapengabdian/getkaryapengabdianbyid/'); ?>' + $('#id').val(),
            dataType: 'JSON',
            success: function(response) {
                $('#id').val(response.id);
                $('#kodeprodi').val(response.kodeprodi);
                $('#katpengabdianid').val(response.katpengabdianid);
                $('#nip').val(response.nip);
                $('#judul').val(response.judul);
                $('#sumberdana').val(response.sumberdana);
                if (response.foto) {
                    $('#tempatFoto').html('<img height="200" width="200" class="rounded-circle" src="<?= base_url(); ?>assets/gambarDB/karya/pengabdian/' + response.foto + '" alt="Foto" id="lihatFoto" name="lihatFoto">');
                }
                $('#deskripsi').val(response.deskripsi);
                CKEDITOR.replace('deskripsi');
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
        var deskripsi = CKEDITOR.instances['deskripsi'].getData();
        $('#deskripsi').val(deskripsi);
    }

    function editKaryaPengabdianProcess() {
        ckeditor();
        $('[name="tombolEdit"]').attr("disabled", true);
        $('[name="tombolEdit"]').text("loading..");
        let formData = new FormData($('#formEditKaryaPengabdian').get(0));
        formData.append("csrf_test_name", csrfHash);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>karyapengabdian/editDataProcess",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                csrfHash = data.token;
                if (data.message == 'sukses') {
                    Swal.fire('Data Berhasil Diedit', '', 'success').then(function() {
                        window.location = "<?= base_url(); ?>superadmin/karya-pengabdian";
                    });
                } else if (data.message == "gagal") {
                    $('[name="tombolEdit"]').attr("disabled", false);
                    $('[name="tombolEdit"]').text("Edit");
                    // pengaturan error
                    $('.kodeprodi-error').html(data.kodeprodi_error);
                    $('.katpengabdianid-error').html(data.katpengabdianid_error);
                    $('.nip-error').html(data.nip_error);
                    $('.judul-error').html(data.judul_error);
                    $('.sumberdana-error').html(data.sumberdana_error);
                    // $('.foto-error').html(data.foto_error);
                    $('.deskripsi-error').html(data.deskripsi_error);
                }
            }
        })
    }
</script>
</body>

</html>