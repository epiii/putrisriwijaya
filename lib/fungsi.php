<?php

function pr($par){
	echo '<pre>';
		print_r($par);
	echo'</pre>';
	exit();
}

function vd($par){
	echo '<pre>';
		var_dump($par);
	echo'</pre>';
	exit();
}

function getDataByParam($table,$par,$val){
	global $conn;
	$whr = $val!=''?' WHERE '.$par.'="'.$val.'"':'';
	$s='SELECT * FROM '.$table.$whr.' ORDER BY '.$par.' ASC';
	$e=mysqli_query($conn,$s);
	$r=mysqli_fetch_assoc($e);
	$n=mysqli_num_rows($e);
	// pr($e);
	return [
		'message'=>!$e?mysqli_error($conn):($n<=0?'empty':'success'),
		'data'  =>$r
	];
}

?>
