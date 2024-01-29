<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2><?= ucwords($bidangMinatnya->namabidminat); ?></h2>
			</div>
			<div id="exTab1" class="container">
				<ul class="nav nav-pills">
					<li class="active">
						<a href="#1a" data-toggle="tab">Profil</a>
					</li>
					<li><a href="#2a" data-toggle="tab">Peta Penelitian</a>
					</li>
					</li>
				</ul>
				<div class="tab-content clearfix">
					<div class="tab-pane active" id="1a">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<?= $bidangMinatnya->profile; ?>
								</div>
							</div>
							<!-- berita samping -->
							<div class="col-md-4" style="border-left: 0.2px solid lightgray;border-bottom: 0.2px solid lightgray">
								<?= $beritaProdiTerbaru; ?>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="2a">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<?= $bidangMinatnya->petapenelitian; ?>
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

<?php $this->load->view("prodi_portal/template/footer"); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#namaTitleHeader').html('Prodi Teknik Informatika');
	});
</script>
</body>

</html>