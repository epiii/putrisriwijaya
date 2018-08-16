<?php

$user_name = "root";
$password  = "9kali9=81ub";
$database  = "voucher";
// $database  = "putriajax";
$host_name = "localhost";

$conn = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_select_db($conn, $database);

if ($conn || mysqli_select_db($conn, $database)) {

} else {
    echo " failed";
}

?>
