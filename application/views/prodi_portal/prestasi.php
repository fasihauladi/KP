<?php
$ci = &get_instance();
$ci->load->model('M_prestasi', 'prestasi');
?>
<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2>PRESTASI MAHASISWA</h2>
			</div>
			<div id="exTab1" class="container">
				<ul class="nav nav-pills">
					<li class="<?= $tabRegional ?>">
						<a href="#1a" data-toggle="tab">Regional</a>
					</li>
					<li class="<?= $tabNasional ?>">
						<a href="#2a" data-toggle="tab">Nasional</a>
					</li>
					<li class="<?= $tabInternasional ?>">
						<a href="#3a" data-toggle="tab">Internasional</a>
					</li>
				</ul>
				<div class="tab-content clearfix">
					<div class="tab-pane <?= $tabRegional ?>" id="1a">
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="margin:7px">
									<table id="example" class="table table-striped table-bordered" style="width:100%;">
										<thead>
											<tr>
												<th class="text-center">Waktu</th>
												<th class="text-center">Prestasi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($prestasiRegional as $pr) : ?>
												<tr>
													<td><?= $ci->prestasi->cekWaktuIndonesia($pr->waktu); ?></td>
													<td><?= $pr->namaprestasi; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- berita samping -->
							<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
								<?= $beritaProdiTerbaru; ?>
							</div>
						</div>
					</div>
					<div class="tab-pane <?= $tabNasional ?>" id="2a">
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="margin:7px">
									<table id="example" class="table table-striped table-bordered" style="width:100%;">
										<thead>
											<tr>
												<th class="text-center">Waktu</th>
												<th class="text-center">Prestasi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($prestasiNasional as $pn) : ?>
												<tr>
													<td><?= $ci->prestasi->cekWaktuIndonesia($pn->waktu); ?></td>
													<td><?= $pn->namaprestasi; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- berita samping -->
							<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
								<?= $beritaProdiTerbaru; ?>
							</div>
						</div>
					</div>
					<div class="tab-pane <?= $tabInternasional ?>" id="3a">
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="margin:7px">
									<table id="example" class="table table-striped table-bordered" style="width:100%;">
										<thead>
											<tr>
												<th class="text-center">Waktu</th>
												<th class="text-center">Prestasi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($prestasiInternasional as $pi) : ?>
												<tr>
													<td><?= $ci->prestasi->cekWaktuIndonesia($pi->waktu); ?></td>
													<td><?= $pi->namaprestasi; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- berita samping -->
							<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
								<?= $beritaProdiTerbaru; ?>
							</div>
						</div>
					</div>
				</div>
			</div>


			<hr>
			</hr>
			<hr>
			</hr>



		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			</div>
		</div>
		<!--End of row-->

		<!--End of row-->
	</div>
	<!--End of container-->
</section>






<!-- modal detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="detailModalLabel">Informasi Dosen</h4>
			</div>
			<div class="modal-body">
				<form class="form-row" id="formDetail" enctype="multipart/form-data">
					<!-- nama_dosen -->
					<div class="form-group col-12 mt-2" id="inputan_nama_dosen">
						<label class="form-control-placeholder" for="nama_dosen">Nama</label>
						<input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="" disabled>
					</div>
					<!-- nip_dosen -->
					<div class="form-group col-12 mt-2" id="inputan_nip_dosen">
						<label class="form-control-placeholder" for="nip_dosen">NIP</label>
						<input type="text" class="form-control" id="nip_dosen" name="nip_dosen" value="" disabled>
					</div>
					<!-- email_dosen -->
					<div class="form-group col-12 mt-2" id="inputan_email_dosen">
						<label class="form-control-placeholder" for="email_dosen">E-mail</label>
						<input type="text" class="form-control" id="email_dosen" name="email_dosen" value="" disabled>
					</div>
					<!-- bidang_minat_dosen -->
					<div class="form-group col-12 mt-2" id="inputan_bidang_minat_dosen">
						<label class="form-control-placeholder" for="bidang_minat_dosen">Bidang Minat</label>
						<input type="text" class="form-control" id="bidang_minat_dosen" name="bidang_minat_dosen" value="" disabled>
					</div>
					<style>
						.textAreaUntukKasusCKEditor {
							cursor: not-allowed;
							background-color: #eee;
							opacity: 1;
							height: auto;
							display: block;
							width: 100%;
							padding: 6px 12px;
							font-size: 14px;
							line-height: 1.42857143;
							color: #555;
							background-image: none;
							border: 1px solid #ccc;
							border-radius: 4px;
							box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
							transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
							/* Deklarasi CSS */
						}
					</style>
					<!-- penelitian_dosen -->
					<div class="form-group col-12 mt-2" id="inputan_penelitian_dosen">
						<label class="form-control-placeholder" for="penelitian_dosen">Penelitian</label>
						<div id="penelitian_dosen" class="textAreaUntukKasusCKEditor"></div>
					</div>
					<!-- foto_dosen -->
					<div class="form-group" id="tempat_foto_dosen">
						<label>Foto</label>
						<div id="foto_dosen"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-primary">Simpan</button>-->
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("prodi_portal/template/footer"); ?>
<script type="text/javascript">
	var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
		csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

	$(document).ready(function() {
		$('#namaTitleHeader').html('Prodi Teknik Informatika');
	});


	function bukaModalDetail(nip) {
		$.ajax({
			type: 'GET',
			url: '<?= base_url('prodiPortal/getdosenbynip/'); ?>' + nip,
			dataType: 'JSON',
			success: function(response) {
				$('#nama_dosen').val(response.nama);
				$('#nip_dosen').val(response.nip);
				$('#email_dosen').val(response.email);
				$('#bidang_minat_dosen').val(response.bidang_minat);
				$('#penelitian_dosen').html(response.penelitian);
				if (response.foto == null || response.foto == "") {
					$("#foto_dosen").html("<img src='<?= base_url(); ?>assets/images/avatar.png' class='w-25'>");
				} else {
					$("#foto_dosen").html("<a class='example-image-link' target='_blank' href='<?= base_url(); ?>assets/gambarDB/dosen/" + response.foto + "' data-lightbox='example-1'><img src='<?= base_url(); ?>assets/gambarDB/dosen/" + response.foto + "' class='w-25'></a>");
				}
				$('#detailModal').modal('show');
			}
		})
	}
</script>
</body>

</html>