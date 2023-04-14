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

    // Loginlog 테이블에 로그인 정보 저장
    $user_id = $_SESSION['user_id'];
    $login_time = date("Y-m-d H:i:s");
    $login_status = 1;
    $login_IP = $_SERVER['REMOTE_ADDR'];

    // user_id 값으로 userregistration 테이블에서 해당하는 number 값을 가져옴
    $sql_user = "SELECT number FROM userregistration WHERE user_id = '$user_id'";
    $result_user = mysqli_query($con, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $number = $row_user['number'];

    $query = "INSERT INTO Loginlog (user_num, user_id, login_time, login_status, login_IP) VALUES ('$number', '$user_id', '$login_time', '$login_status', '$login_IP')";
    mysqli_query($con, $query) or die(mysqli_error($con));
      
    mysqli_close($con);

    header('Location: ../adm/admin/index.php');
    exit;
  }
}
?>
