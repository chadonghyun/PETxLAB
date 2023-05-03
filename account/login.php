<?php

include_once '../db/db_con.php';
include_once '../config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/favicon/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/favicon/favicon.ico" type="image/x-icon">
  
  <!-- 부트스트랩 css연결 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- 부트스트랩 아이콘 연결 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
  <!--부트스트랩 자바스크립트 연결-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!--리셋파일-->
  <link rel="stylesheet" href="../adm/css/reset.css" type="text/css">
  <!-- base.css(공통서식) -->
  <link rel="stylesheet" href="../adm/css/base.css" type="text/css">
  <!-- common.css(헤더&푸터) -->
  <link rel="stylesheet" href="../adm/css/common.css" type="text/css">
  <link rel="stylesheet" href="./css/login.css" type="text/css">
  <script src="./script/login.js" defer></script>

</head>
<body>
  <main>
    <div class="container">
      <div class="log_input">
        <div class="log_form">
          <h2>
            <a href="" title="바로가기">
              <img src="./images/color_logo.png" alt="">
            </a>
          </h2>
          <form action="login_db.php" method="post" name="로그인">
            <input type="text" placeholder="아이디" name="user_id" class="login">
            <input type="password" placeholder="비밀번호" name="user_pass" class="password">
            <div class="find">
              <div>
                <input type="checkbox" class="checkbox" name="save_id" id="save_id">
                <label for="save_id">아이디 저장</label>
              </div>
              <div>
                <a href="#none" title="아이디찾기" id="find_id">아이디 찾기</a>
                <span>|</span>
                <a href="#none" title="아이디찾기" id="find_pass">비밀번호 찾기</a>
              </div>
            </div>
            <button type="submit" id="login">로그인</button>
            <a href="./signin.php" id="join">회원가입</a>
          </form>
        </div>
      </div>
      <div class="log_img">
        <img src="./images/loginbg.jpg" alt="로그인">
      </div>
    </div>
  </main>
</body>
</html>