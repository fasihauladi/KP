<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2><?= strtoupper($mutunya->deskripsi) ?></h2>
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
											<th class="text-center">Deskripsi</th>
											<th class="text-center">Download</th>
										</tr>
									</thead>
									<tbody>
										<?php $nomorUrut = 1; ?>
										<?php foreach ($dokumenMutunya as $dm) : ?>
											<tr>
												<td class="text-center"><?= $nomorUrut; ?></td>
												<td><?= $dm->namadokumen; ?></td>
												<td><?= $dm->deskripsidokumen; ?></td>
												<td class="text-center"><a href="<?= base_url() . 'download-dokumen-mutu/' . $dm->id ?>"><button class="btn btn-xs btn-info btn-flat"><i class="fa fa-download"></i></button></a></td>
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

<?php $this->load->view("prodi_portal/template/footer"); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#namaTitleHeader').html('Prodi Teknik Informatika');
	});
</script>
</body>

</html>