<?php

session_start();

//unset = 정보삭제
session_destroy();

//echo ==  document.write
if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == '2') {
  echo "
    <script>
      location.href = './login.php';
    </script>
  ";
} else if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == '3') {
  echo "
    <script>
      location.href = './login.php';
    </script>
  ";
} else {
  echo "
    <script>
      location.href = '../user/index.php';
    </script>
  ";
}
?>