<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

  $id=$_POST['user_id'];

  // 회원 정보 조회
  $userid = $_SESSION['user_id'];
  
  $sql = "SELECT * FROM userregistration WHERE user_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  // 회원 데이터 삭제
  $sql = "DELETE FROM userregistration WHERE user_id = '$id'";
  mysqli_query($conn, $sql);

  // 세션 삭제
  unset($_SESSION['user_id']);

  // 세션 종료
  session_destroy();

  // 탈퇴 완료 메시지 출력
  echo "회원탈퇴가 완료되었습니다.";

  // 로그인 페이지로 이동
  header("Location: login.php");
  exit();
?>
