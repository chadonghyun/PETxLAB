<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$checked = $_POST['checked'];

var_dump($checked);

foreach($checked as $number){
    $sql = "UPDATE boardqnareg SET checked = 1 WHERE number = '$number'";
    $result = mysqli_query($con, $sql);
}

?>