<?php
require_once 'lib/koneksi.php';
require_once 'lib/fungsi.php';

// pr($_POST);
$out=[];
if (!isset($_POST['mode'])) {
	$out['isRequest']=false;
}else{
	$out['isRequest']=true;
	$mode = $_POST['mode'];

	if ($mode=='save') {
		$s='INSERT INTO user SET
			id_pengguna ="'.$_POST['id_pengguna'].'",
			nama ="'.$_POST['nama'].'",
			nohp ="'.$_POST['nohp'].'",
			kode ="'.$_POST['kode'].'"
		';
		// pr($s);
		$e = mysqli_query($conn,$s);
		$out['status']=$e?'success':'failed to save data';
	}else if($mode=='delete'){
		// code here
	}else{
		// code here
	}
}
echo json_encode($out);
?>
