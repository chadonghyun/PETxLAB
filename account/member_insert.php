<?php

include_once '../db/db_con.php'; //db연결하기


//전달받은 데이터값을 각각 변수에 담기
$name = $_POST["user_name"];
$id = $_POST["user_id"];
$pass = password_hash($_POST['user_pass'],PASSWORD_DEFAULT);
$birth1 = $_POST['user_birth_year'];
$birth2 = $_POST['user_birth_month'];
$birth3 = $_POST['user_birth_day'];
$email = $_POST['email_id'] .'@'. $_POST['email_domain'];
$address1 = $_POST['user_addr1'];
$address2 = $_POST['user_addr2'];
$address3 = $_POST['user_addr3'];
$phone = $_POST['phone_first'] . $_POST['phone_mid'] . $_POST['phone_last'];
$telephone = $_POST['telephone_first'] . $_POST['telephone_mid'] . $_POST['telephone_last'];
$job = $_POST['user_job'];
$interest = $_POST['extra2'];

$sql = "INSERT INTO userregistration (user_id, user_name, user_pass, user_email, user_addr1, user_addr2, user_addr3, user_phone, user_birth_year, user_birth_month, user_birth_day, user_telephone, user_job, extra2) 
VALUES ('$id', '$name', '$pass', '$email', '$address1', '$address2', '$address3', '$phone', '$birth1', '$birth2', '$birth3', '$telephone', '$job', '$interest')"; 


$result = mysqli_query($con,$sql); //sql에 저장된 명령 실행
if (!$result) {
  die('Error: ' . mysqli_error($con)); //쿼리 에러가 있을 경우 출력
}

mysqli_close($con);
?>

<script>
  alert('회원가입 완료')
  location.href = './login.php';
</script>