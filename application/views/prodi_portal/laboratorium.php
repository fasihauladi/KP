<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2><?= ucwords($profileLab->namalab); ?></h2>
			</div>
			<div id="exTab1" class="container">
				<ul class="nav nav-pills">
					<li class="active">
						<a href="#1a" data-toggle="tab">Profil</a>
					</li>
					<li class="">
						<a href="#2a" data-toggle="tab">Karya</a>
					</li>
				</ul>
				<div class="tab-content clearfix">
					<div class="tab-pane active" id="1a">
						<div class="row">
							<div class="col-md-8">
								<div class="text-center">
									<h2 style="margin-top:10px;margin-bottom:30px"><?= $profileLab->namalab ?></h2>
									<img src="<?= base_url(); ?>assets/gambarDB/laboratorium/<?= $profileLab->foto ?>" alt="" width="400">
								</div>
								<br>
								<div>
									<p>Kategori : <?= $kategoriLabnya->kategori ?></p>
									<p>Dosen : <?= $dosennya->nama ?> (<?= $dosennya->nip ?>)</p>
									<br>
									<?= $profileLab->profile ?>
								</div>
							</div>
							<!--End of col-md-8-->
							<!-- berita samping -->
							<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
								<h3 class="judul"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Seputar Teknik Informatika</h3>
								<?php foreach ($beritaProdiTerbaru as $bpt) : ?>
									<div class="event_news">
										<div class="event_single_item fix">
											<div class="event_news_img floatleft">
												<img src="<?= base_url(); ?>assets/gambarDB/berita/prodi/<?= $bpt->thumbnail ?>" alt="">
											</div>
											<div class="event_news_text">
												<a href="<?= base_url(); ?>berita-prodi/<?= $bpt->id; ?>">
													<h4><?= $bpt->judul ?></h4>
												</a>
												<?= substr($bpt->content, 0, 200); ?> ...
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<!--End of col-md-4-->
						</div>
					</div>
					<div class="tab-pane" id="2a">
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="margin:7px">
									<table id="example" class="table table-striped table-bordered" style="width:100%;">
										<thead>
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Nama Karya</th>
												<th class="text-center">Detail</th>
											</tr>
										</thead>
										<tbody>
											<?php $nomorUrut = 1; ?>
											<?php foreach ($dataKaryaLab as $dkl) : ?>
												<tr>
													<td class="text-center"><?= $nomorUrut; ?></td>
													<td><?= $dkl->namakarya; ?></td>
													<td class="text-center"><button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail('<?= $dkl->id ?>')"><i class="fa fa-info-circle"></i></button></td>
												</tr>
												<?php $nomorUrut += 1; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- berita samping -->
							<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
								<h3 class="judul"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Seputar Teknik Informatika</h3>
								<?php foreach ($beritaProdiTerbaru as $bpt) : ?>
									<div class="event_news">
										<div class="event_single_item fix">
											<div class="event_news_img floatleft">
												<img src="<?= base_url(); ?>assets/gambarDB/berita/prodi/<?= $bpt->thumbnail ?>" alt="">
											</div>
											<div class="event_news_text">
												<a href="<?= base_url(); ?>berita-prodi/<?= $bpt->id; ?>">
													<h4><?= $bpt->judul ?></h4>
												</a>
												<?= substr($bpt->content, 0, 200); ?> ...
											</div>
										</div>
									</div>
								<?php endforeach; ?>
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
				<h4 class="modal-title" id="detailModalLabel">Informasi Karya</h4>
			</div>
			<div class="modal-body">
				<form class="form-row" id="formDetail" enctype="multipart/form-data">
					<!-- nama_karya -->
					<div class="form-group col-12 mt-2" id="inputan_nama_karya">
						<label class="form-control-placeholder" for="nama_karya">Nama Karya</label>
						<input type="text" class="form-control" id="nama_karya" name="nama_karya" value="" disabled>
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
					<!-- deskripsi_karya -->
					<div class="form-group col-12 mt-2" id="inputan_deskripsi_karya">
						<label class="form-control-placeholder" for="deskripsi_karya">Deskripsi</label>
						<div id="deskripsi_karya" class="textAreaUntukKasusCKEditor"></div>
					</div>
					<!-- foto_karya -->
					<div class="form-group" id="tempat_foto_karya">
						<label>Foto</label>
						<div id="foto_karya"></div>
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


	function bukaModalDetail(id) {
		$.ajax({
			type: 'GET',
			url: '<?= base_url('prodiPortal/getkaryalabbyid/'); ?>' + id,
			dataType: 'JSON',
			success: function(response) {
				$('#nama_karya').val(response.namakarya);
				$('#deskripsi_karya').html(response.deskripsikarya);
				if (response.foto == null || response.foto == "") {
					$("#foto_karya").html("<img src='<?= base_url(); ?>assets/images/avatar.png' class='w-25'>");
				} else {
					$("#foto_karya").html("<a class='example-image-link' target='_blank' href='<?= base_url(); ?>assets/gambarDB/karya/lab/" + response.foto + "' data-lightbox='example-1'><img src='<?= base_url(); ?>assets/gambarDB/karya/lab/" + response.foto + "' class='w-25'></a>");
				}
				$('#detailModal').modal('show');
			}
		})
	}
</script>
</body>

</html>