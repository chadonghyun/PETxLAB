<?php 
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  
  //전달받은 데이터값을 각각 변수에 담기
  $id   = $_POST['user_id'];
  $name = $_POST['user_name'];
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

  $sql = "UPDATE userregistration SET user_name = '$name', user_pass = '$pass', user_email = '$email', user_addr1 = '$address1', user_addr2='$address2', user_addr3='$address3', user_phone='$phone', user_birth_year='$birth1', user_birth_month='$birth2', user_birth_day='$birth3', user_addr2='$address2', user_telephone='$telephone', user_job='$job',  extra2 = '$interest' WHERE user_id='$id'";

  mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
  mysqli_close($con);   //db종료
  
  echo "
    <script>
      alert('회원정보가 수정되었습니다.');
      location.href = '../user/header.php';
    </script>
  ";
?>