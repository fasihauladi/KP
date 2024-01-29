<?php
$ci = &get_instance();
$ci->load->model('M_karyapengabdian', 'karyapengabdian');
?>
<section id="event">
	<div class="container ">
		<div>
			<div class="event_header text-center">
				<h2><?= ucwords($kategoriPengabdiannya->kategori); ?></h2>
			</div>
			<div id="exTab1" class="container">
				<ul class="nav nav-pills">
					<?php
					$aktifnya = 'active';
					$ahrefnya = '#1a';
					?>
					<?php foreach ($subKategori as $sk) : ?>
						<li class="<?= $aktifnya ?>">
							<a href="<?= $ahrefnya; ?>" data-toggle="tab" style="text-transform:capitalize"><?= $sk->subkategori; ?></a>
						</li>
						<?php
						$aktifnya = '';
						$ahrefnya = $ahrefnya . 'a';
						?>
					<?php endforeach; ?>
				</ul>
				<div class="tab-content clearfix">
					<?php
					$aktifnya = 'active';
					$ahrefnya = '1a';
					$tabelnya = 'tabel';
					?>
					<?php foreach ($subKategori as $sk) : ?>
						<div class="tab-pane <?= $aktifnya; ?>" id="<?= $ahrefnya; ?>">
							<div class="row">
								<div class="col-md-8">
									<div class="row" style="margin:7px">
										<table id="<?= $tabelnya ?>" class="table table-striped table-bordered" style="width:100%;">
											<thead>
												<tr>
													<th class="text-center">No</th>
													<th class="text-center">Nama Karya</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$nomorUrut = 1;
												$dataKaryaPengabdian = $ci->karyapengabdian->getAllDataByKategoriPengabdianId($sk->id);
												?>
												<?php foreach ($dataKaryaPengabdian as $dkp) : ?>
													<tr>
														<td class="text-center"><?= $nomorUrut; ?></td>
														<td><a href="<?= base_url(); ?>karya-pengabdian/<?= $dkp->id; ?>"><?= $dkp->judul; ?></a></td>
													</tr>
													<?php $nomorUrut += 1; ?>
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
						<?php
						$aktifnya = '';
						$ahrefnya = $ahrefnya . 'a';
						$tabelnya = $tabelnya . 'a';
						?>
					<?php endforeach; ?>
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
	var csrfName = '<?= $this->security->get_csrf_token_name(); ?>',
		csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

	$(document).ready(function() {
		$('#namaTitleHeader').html('Prodi Teknik Informatika');
	});
</script>
</body>

</html>