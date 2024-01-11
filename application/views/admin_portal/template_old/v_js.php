<!-- bootstrap -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- dataTable  urutasn harus jquery 3.5. dulut-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<!-- datetimepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- slimscroll -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- fastclick -->
<script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- js custom adminLTE -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
<!-- icheck radio dan checkbox -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- js tambahan -->




<!-- js custom CKeditor -->


	<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
    <script type="text/javascript">
        $(function () {
                CKEDITOR.replace('ckeditor',{
                    filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
                    height: '400px'             
                });
            });
    </script>
	
	<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
    <script type="text/javascript">
        $(function () {
                CKEDITOR.replace('ckeditor1',{
                    filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
                    height: '400px'             
                });
            });
    </script>
	



<script>
	$(document).ready(function(){
		$("body").tooltip({selector:'[data-show=tip]'});
		$('.select2').select2({
			placeholder: 'Pilih'
		});
		$('.kelas').select2({
			placeholder: 'Pilih Kelas'
		});

		$("#dataTable").DataTable(
		{
			"language": {
				"search" : "Cari",
				"paginate":{
					"next":"selanjutnya",
					"previous":"sebelumnya"
				},
				"lengthMenu": "Tampil _MENU_ data",
				"info": "Menampilkan _START_ ke _END_ dari _TOTAL_ data",
				"emptyTable": "Tidak ada data",
				"infoEmpty": "Tidak ada data yang ditampilkan",
			},
		});

		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass   : 'iradio_flat-green'
		});
	});
</script>
<!-- crud -->



<script>
	$(function(){
		// tambah data
		$("#form-tambah").on("submit", function(event){
			event.preventDefault();
			console.log($(this).serialize());

			$.ajax({
				url: '<?php echo base_url($this->uri->segment(1).'/prosesTambah') ?>',
				type: 'post',
				data: $(this).serialize(),
				success: function(e){
					alert(e);
					window.location.href="<?php echo base_url($this->uri->segment(1)) ?>";
				}
			});
		});
		// ubah data
		$("#form-ubah").on("submit", function(event){
			event.preventDefault();
			console.log($(this).serialize());

			$.ajax({
				url: '<?php echo base_url($this->uri->segment(1).'/prosesUbah') ?>',
				type: 'post',
				data: $(this).serialize(),
				success: function(e){
					alert(e);
					window.location.href="<?php echo base_url($this->uri->segment(1)) ?>";
				}
			});
		});
		// hapus data
		$('body').on('click', '.hapus', function(){
			let konfirmasi = confirm('Data akan dihapuskah!');
			if (konfirmasi) {
				let id = $(this).attr('id');
				$.ajax({
					url: "<?php echo base_url($this->uri->segment(1).'/hapus') ?>",
					type: 'POST',
					data: {id: id},
					success: function(res){
						//alert(res)
						window.location.href = '<?php echo base_url($this->uri->segment(1)) ?>'
					}
				});
			}
		});
		// hapus semua
		$('#check-all').change(function () {
			if ($(this).is(':checked')) {
				$('.check-item').prop('checked',true);
			}else{
				$('.check-item').prop('checked',false);
			}
		});
		$(".check-item").click(function(){

			if($(".check-item").length == $(".check-item:checked").length) {
				$("#check-all").prop("checked", true);
			} else {
				$("#check-all").prop("checked",false);
			}

		});
		$('#btn-hapus').click(function(){
			var ids = [];
			$('.check-item:checked').each(function(){
				var id = $(this).val();
				ids.push(id);
			});
			var length = ids.length;
			if (length>0) {
				var konfirmasi = window.confirm('Hapus data yang terpilih?');
				if (konfirmasi) {
					$.ajax({
						url: '<?= base_url($this->uri->segment(1)) ?>/hapusSemua',
						type: 'post',
						data: {id: id},
						success: function(response){
							$(".check-item:checked").each(function(){
								var id = $(this).val();
								$('#tr_'+id).remove();
							});
						}
					});
				}
			}else{
				window.alert('Pilih data dulu!')
			}

		});

		// tambahkan santri ke dalam kelas
		$("#btn-simpan-kelas").click(function(){
			var ids = [];
			var kelas = $("#kelas").val();
			$('.check-item:checked').each(function(){
				var id = $(this).val();
				ids.push(id);
			});

			console.log(ids+kelas);
			var length = ids.length;
			if (length>0 && kelas!="") {
				var konfirmasi = window.confirm("Tambahkan "+length+" santri?");
				if (konfirmasi) {
					$.ajax({
						url: '<?= base_url($this->uri->segment(1)) ?>/prosesTambahSantri',
						type: 'post',
						data: {id: ids, kelas: kelas},
						success: function(response){
							console.log(response);
							window.location.href = "<?= base_url($this->uri->segment(1)) ?>/tampilSantri";
						}
					});
				}
			}else{
				window.alert('Pilih kelas dan santri dulu!')
			}
		});

		//menampilkan data santri perkelas
		$('#btn-tampil').on('click', function(){
			var kelas = $('#kelas').val();
			var tahun = $('#tahun').val();

			if (kelas === "" && tahun ==="") {
				window.alert("Pilih kelas atau tahun dulu!");
			}else{
				$.ajax({
					url: '<?= base_url() ?>/kelas/ambilData',
					type: 'POST',
					data:{kelas: kelas, tahun: tahun},
					success: function(response){
						$('#tampilSemua').hide();
						$('#tampil').html(response);
						$('#tampil').show();

					}
				});
			}
			
		});

		$("#btn-reset").on('click', function(){
			$("#kelas").val(null).trigger("change");
			$("#tahun").val(null);
			$("#tampilSemua").show();
			$("#tampil").hide();

		});

		$("#btn-export").on("click", function(){
			var kelas = $("#kelas").val();
			if (kelas==="") {
				alert('pilih kelas dulu');
			}else{
				window.location.href="<?= base_url() ?>kelas/exportExcel/"+kelas;
			}
		});
		
	});
</script>
<script>
	$(function(){
		$('#tahun').datepicker({
			minViewMode: 2,
			format: 'yyyy'
		});
		$('#tanggalLahir').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('#tanggalTerima').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('#tgl_awal').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('#tgl_akhir').datepicker({
			format: 'yyyy-mm-dd'
		});

		//cari tempo catatan santri
		$('#btn-cek').on('click', function(event){
			event.preventDefault();
			var tgl_akhir = $('#tgl_akhir').val();
			var tgl_awal = $('#tgl_awal').val();
			var taksplit = tgl_akhir.split('-');
			var tasplit = tgl_awal.split('-');
			var tgl = new Date();
			var le_tgl_akhir = tgl.setFullYear(taksplit[0],taksplit[1],taksplit[2]);
			var le_tgl_awal = tgl.setFullYear(tasplit[0],tasplit[1],tasplit[2]);
			var tempo = (le_tgl_akhir-le_tgl_awal)/(60*60*24*1000);
			
			$('#tempo').val(tempo);
		});
	});
</script>
<script>
	$(document).ready(function(){
		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table = $("#data-table").dataTable({
			initComplete: function() {
				var api = this.api();
				$('#data-table_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: '<p style="color: green"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></p><span class="sr-only">Loading…</span>',

			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url('kelas/json')?>", "type": "POST"},
			columns: [
			{"data": "0"},
			{"data": "1"},
			{"data": "2"}
			],
			order: [[2, 'desc']],

			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
	});
	
// untuk menampilkan ckeditor pada modal
CKEDITOR.replace('editor1');

$(document).ready(function(){

$.fn.modal.Constructor.prototype.enforceFocus = function () {
    modal_this = this
    $(document).on('focusin.modal', function (e) {
        if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
        // add whatever conditions you need here:
        &&
        !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
            modal_this.$element.focus()
        }
    })
};

});

</script>

<script>
$("#files").change(function() {
  filename = this.files[0].name;
  console.log(filename);
});
</script>

<script>
$(document).ready( function () {
    $('#tabweb').DataTable();
} );
</script>