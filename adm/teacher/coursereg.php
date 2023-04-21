<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";

// 세션 시작
session_start();

// 현재 로그인된 사용자의 user_id 가져오기
if(isset($_SESSION['user_id'])) {$userid = $_SESSION['user_id'];}

$sql = "SELECT * FROM coursereg WHERE user_id='$userid'";
$result = mysqli_query($con, $sql);

$data = array();
while($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

echo json_encode($data);
?>