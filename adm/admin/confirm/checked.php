<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$checked = $_POST['checked'];

foreach($checked as $row){
    $sql = "UPDATE userregistration SET checked = 1 WHERE number = '$row'";
    $result = mysqli_query($con, $sql);
}

?>