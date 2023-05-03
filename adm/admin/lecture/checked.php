<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$checked = $_POST['checked'];

foreach($checked as $row){
    $sql = "UPDATE coursereg SET checked = 1 WHERE course_id = '$row'";
    $result = mysqli_query($con, $sql);
}

?>