<?php
require_once 'lib/koneksi.php';
require_once 'lib/fungsi.php';
?>
<html>
<head>
	<title>Pengajuan Voucher	</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" /> -->
	<!-- <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
	<!-- <script src="js/jquery-latest.min.js" type="text/javascript"></script> -->
	<!-- <script src="js/popper.min.js"></script> -->

	<!-- <script type="text/javascript" src="js/action.js"></script> -->
	<!-- <script type="text/javascript" src="js/jquery.js"></script> -->

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

	<style type="text/css">
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.pageLoader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(assets/images/loading.gif) center no-repeat #fff;
		opacity: 0.7;
	}
	</style>

	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> -->
	<body>
		<div class="pageLoader"></div>
		<br />

		<div class="container">
			<div class="card">
				<div class="card-body">
					<h2>Pengajuan Voucher </h2>
					<h3>user</h3>

					<br />

					<!-- <div id="alertinfo" class="alert alert-success alert-dismissible"> -->
					<div style="display:none;" id="alert-div" class="alert alert-dismissible">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <span id="alert-msg">
					  </span>
					</div>

					<form method="post" onsubmit="saveform();return false;">

						<div class="form-group row">
							<label for="nama" class="col-sm-2 col-form-label">ID Pengguna </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="id_pengguna" name="id_pengguna" placeholder="id pengguna ..." required/>
							</div>
						</div>

						<div class="form-group row">
							<label for="nama" class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama ..." required/>
							</div>
						</div>

						<div class="form-group row">
							<label for="nama" class="col-sm-2 col-form-label">No HP</label>
							<div class="col-sm-10">
								<input type="number" min="1" xmax="15" class="form-control" id="nohp" name="nohp" placeholder="No HP ..." required/>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kode</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="kode" name="kode" placeholder="kode ..." required/>
							</div>
						</div>


						<div class="form-group row">
	    	        		<div class="offset-sm-2 col-sm-10">
            					<input type="submit" id="submit" value="Simpan" class="btn btn-info" />

            				</div>
	            		</div>
					</form>
				</div>
			</div>

			<br />

		</div>
		<br />
	</body>

	<script>
		$(document).ready(function(){
			setTimeout(function(){
				$('.pageLoader').attr('style','display:none');
			}, 700);
		});

		function hargacb(jenis) {
			$.ajax({
				url:'action.php',
				data:{
					'mode':'comboharga',
					'jenis':jenis
				},type:'post',
				dataType:'json',
				beforeSend:function () {
					$('.pageLoader').removeAttr('style');
				},success:function(ret){
					setTimeout(function(){
						$('.pageLoader').attr('style','display:none');

						var opt='';
						if(ret.total==0) opt+='<option>-data kosong-</option>';
						else{
							opt+='<option value="">-- Pilih --</option>';
							$.each(ret.returns.data, function  (id,val) {
								opt+='<option value="'+val.harga_angka+'">'+val.harga_rp+'</option>';
							});
						}$('#hargacombo').html(opt);
					}, 700);
				}, error : function (xhr, status, errorThrown) {
					$('.pageLoader').attr('style','display:none');
			        alertinfo('danger','error : ['+xhr.status+'] '+errorThrown);
			    }
			});
		}

		function saveform(){
        var urlx ='&mode=save';
        $.ajax({
					url:'pengajuanProses.php',
					cache:false,
					type:'post',
					dataType:'json',
					data:$('form').serialize()+urlx,
					beforeSend:function () {
						$('.pageLoader').removeAttr('style');
					},success:function(dt){
						setTimeout(function(){
							console.log(dt.status);
							$('.pageLoader').attr('style','display:none');
							if(dt.status='success'){resetform();}
							alertinfo((dt.status!='success'?'danger':'success'),dt.status);
						},700);
					},error: function (xhr, ajaxOptions, thrownError) {
		        alert(xhr.status+' - '+xhr.responseText);
		        alert(thrownError);
		      }
      });
    }

	    function alertinfo(clr,msg) {
	    	$('#alert-div').removeAttr('style');
        $('#alert-msg').html(msg);
        $('#alert-div').addClass('alert-'+clr);
    	}

	    function resetform() {
				$('#id_pengguna').val('');
	    	$('#nama').val('');
	    	$('#nohp').val('');
	    	$('#kode').val('');
	    }
	</script>

</html>
