<!-- form tambah -->
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







<!-- form edit -->
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



id
npm
kesan
telp
foto


<!-- npm -->
<div class="form-group col-12" id="inputan_npm">
    <label for="npm" class="form-control-placeholder">npm</label>
    <input type="number" class="form-control" id="npm" name="npm"">
    <small class=" text-danger npm-error"></small>
</div>

<!-- kesan -->
<div class="form-group col-12 mt-2" id="inputan_kesan">
    <label class="form-control-placeholder" for="kesan">kesan</label>
    <textarea class="form-control ckeditor" id="kesan" name="kesan" value=""></textarea>
    <small class="text-danger kesan-error"></small>
</div>