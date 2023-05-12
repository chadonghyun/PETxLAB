<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

  // 회원 정보 조회
  $id = $_SESSION['user_id'];
  
  $sql = "SELECT * FROM userregistration WHERE user_id = '$id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);

  // 회원 데이터 삭제
  $sql = "DELETE FROM userregistration WHERE user_id = '$id'";
  mysqli_query($con, $sql);

  // 세션 삭제
  unset($_SESSION['user_id']);

  // 세션 종료
  session_destroy();

  // 탈퇴 완료 메시지 출력 및 로그인페이지로 이동
  echo "<script>
    alert('회원탈퇴가 완료되었습니다.');
    location.href='./login.php';
  </script>";
  exit();
?>
