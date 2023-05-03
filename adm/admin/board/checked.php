<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$checked = $_POST['checked'];
$no = $_POST['no'];

if($no == 1){
    $table = 'boardnoticereg';
}else if($no == 2){
    $table = 'boardqnareg' ;
}

var_dump($checked);

foreach($checked as $number){
    $sql = "UPDATE $table SET checked = 1 WHERE number = '$number'";
    $result = mysqli_query($con, $sql);
}

?>