<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2>KARYA PENELITIAN</h2>
			</div>
			<div id="exTab1" class="container">
				<div class="tab-content clearfix">
					<div class="row">
						<div class="col-md-8">
							<div class="text-center">
								<h2 style="margin-top:10px;margin-bottom:30px"><?= $dataKaryaPenelitian->judul ?></h2>
								<img src="<?= base_url(); ?>assets/gambarDB/karya/penelitian/<?= $dataKaryaPenelitian->foto ?>" alt="" width="500">
							</div>
							<br><br>
							<div>
								<p>Kategori : <?= $kategoriPenelitiannya->namakatpen ?></p>
								<p>Sub Kategori : <?= $kategoriPenelitiannya->namasubkatpen ?></p>
								<p>Sumber Dana : <?= $dataKaryaPenelitian->sumberdana ?></p>
								<p>Dosen : <?= $dosennya->nama ?> (<?= $dosennya->nip ?>)</p>
								<br>
								<?= $dataKaryaPenelitian->deskripsi ?>
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