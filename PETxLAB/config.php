<!-- config.php 세션정보를 유지하기 위한 문서 -->
<!-- isset 함수 : 변수가 설정되었느지 확인해주는 함수입니다. 
보통 변수 값에 NULL 체크는 하지만, 설정 여부를 확인 안해서 발생하는 경우가 존재할 때 사용하는 함수입니다. -->

<?php

//세션
session_start();
if(isset($_SESSION['user_id'])) $userid = $_SESSION['user_id'];
  else $userid = '';

if(isset($_SESSION['user_name'])) $username = $_SESSION['user_name'];
  else $username = '';

if(isset($_SESSION['user_level'])) $userlevel = $_SESSION['user_level'];
  else $userlevel = '';

?>