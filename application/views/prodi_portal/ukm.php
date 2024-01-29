<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2>UNIT KEGIATAN MAHASISWA</h2>
			</div>
			<div id="exTab1" class="container">
				<div class="tab-content clearfix">
					<div class="row">
						<div class="col-md-8">
							<div class="text-center">
								<h2 style="margin-top:10px;margin-bottom:30px"><?= $dataUKM->nama; ?></h2>
								<img src="<?= base_url(); ?>assets/gambarDB/ukm/<?= $dataUKM->foto ?>" alt="" width="500">
							</div>
							<br><br>
							<div>
								<?= $dataUKM->deskripsi ?>
							</div>
						</div>
						<!-- berita samping -->
						<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
							<?= $beritaProdiTerbaru; ?>
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