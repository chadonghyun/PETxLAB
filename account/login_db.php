<?php
session_start();
include_once '../db/db_con.php';

// login.php에서 post방식으로 전달받은 id, pw를 변수에 각각 담는다
$id = $_POST['user_id'] ?? '';
$pass = $_POST['user_pass'] ?? '';

// 쿼리문을 사용하여 id체크
$sql = "SELECT * FROM userregistration WHERE user_id = '$id'";
$result = mysqli_query($con, $sql);

$num_match = mysqli_num_rows($result);

if (!$num_match) {
  echo "
  <script>
    window.alert('등록되지 않은 아이디입니다.');
    history.go(-1)
  </script>
  ";
} else {
  $row = mysqli_fetch_assoc($result);
  $db_pass = $row['user_pass'];

  if (!password_verify($pass, $db_pass)) {
    echo "
    <script>
      window.alert('비밀번호가 다릅니다.');
      history.go(-1)
    </script>
    ";
    exit;
  } else {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['user_level'] = $row['user_level'];

    // l 테이블에 로그인 정보 저장
    $user_id = $_SESSION['user_id'];
    $login_time = date("Y-m-d H:i:s");
    $login_status = 1;
    $login_IP = $_SERVER['REMOTE_ADDR'];

    // user_id 값으로 userregistration 테이블에서 해당하는 number 값을 가져옴
    $sql_user = "SELECT number FROM userregistration WHERE user_id = '$user_id'";
    $result_user = mysqli_query($con, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $number = $row_user['number'];

    $userlevel = $_SESSION['user_level'];

    // 기존에 로그인된 아이디가 있는지 확인
    $sql_loginlog = "SELECT * FROM loginlog WHERE user_num = '$number'";
    $result_loginlog = mysqli_query($con, $sql_loginlog);
    $num_rows_loginlog = mysqli_num_rows($result_loginlog);

    if ($num_rows_loginlog > 0) {
      // 이미 로그인된 아이디가 있는 경우, 해당 아이디의 로그인 정보를 업데이트
      $query = "UPDATE loginlog SET login_time = '$login_time', login_status = '$login_status', login_IP = '$login_IP' WHERE user_num = '$number'";
    } else {
      // 로그인된 아이디가 없는 경우, 새로운 로그인 정보를 추가
      $query = "INSERT INTO loginlog (user_num, user_id, login_time, login_status, login_IP) VALUES ('$number', '$user_id', '$login_time', '$login_status', '$login_IP')";
    }
      
    mysqli_close($con);

    if ($userlevel == 2) {
        header('Location: ../adm/teacher/t_index.php');
    } else if ($userlevel == 3) {
      header('Location: ../adm/admin/a_index.php');
    } else{
      header ('Location: ../user/index.php');
    }
      exit;
  }
}
?>
