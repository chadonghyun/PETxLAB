<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";


if(mysqli_connect_errno()){
  printf("%s \n",mysqli_connect_errno());
  exit;
}

// 데이터 조회하기

$find = $_POST['find'];
$query = "select * from boardqnareg where qna_title ='%$find%'";
$result = mysqli_query($con,$query);


mysqli_close($con);
?>

