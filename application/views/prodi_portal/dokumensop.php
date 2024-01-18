<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2><?= strtoupper($sopnya->deskripsi) ?></h2>
			</div>
			<div id="exTab1" class="container">
				<div class="tab-content clearfix">
					<div class="row">
						<div class="col-md-8">
							<div class="row" style="margin:7px">
								<table id="example" class="table table-striped table-bordered" style="width:100%;">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Dokumen</th>
											<th class="text-center">Download</th>
										</tr>
									</thead>
									<tbody>
										<?php $nomorUrut = 1; ?>
										<?php foreach ($dokumenSOPnya as $ds) : ?>
											<tr>
												<td class="text-center"><?= $nomorUrut; ?></td>
												<td><?= $ds->namadokumen; ?></td>
												<td class="text-center">
													<button class="btn btn-xs btn-success btn-flat" onclick="bukaModalDetail(<?= $ds->id; ?>)"><i class="fa fa-info-circle"></i></button>
													<a href="<?= base_url() . 'download-dokumen-mutu/' . $ds->id ?>"><button class="btn btn-xs btn-info btn-flat"><i class="fa fa-download"></i></button></a>
												</td>
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
				<h4 class="modal-title" id="detailModalLabel">Deskripsi</h4>
			</div>
			<div class="modal-body">
				<div id="detailDeskripsi"></div>
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
	$(document).ready(function() {
		$('#namaTitleHeader').html('Prodi Teknik Informatika');
	});

	function bukaModalDetail(id) {
		$.ajax({
			type: 'GET',
			url: '<?= base_url('prodiPortal/getdokumenbyid/'); ?>' + id,
			dataType: 'JSON',
			success: function(response) {
				$('#detailDeskripsi').html(response.deskripsidokumen);
				$('#detailModal').modal('show');
			}
		})
	}
</script>
</body>

</html>