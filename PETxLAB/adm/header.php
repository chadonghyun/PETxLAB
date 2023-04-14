<?php

?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header,Footer</title>
    <!-- 부트스트랩 css연결 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- 부트스트랩 아이콘 연결 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
    <!--부트스트랩 자바스크립트 연결-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--제이쿼리 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <!--리셋파일-->
    <link rel="stylesheet" href="./css/reset.css" type="text/css">
    <!-- base.css(공통서식) -->
    <link rel="stylesheet" href="./css/base.css" type="text/css">
    <!-- common.css(헤더&푸터) -->
    <link rel="stylesheet" href="./css/common.css" type="text/css">

    <link rel="stylesheet" href="./css/index.css">
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- fullcalendar 언어 CDN -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/locales-all.min.js'></script>
<script src="./script/callender.js"></script>


</head>
<body>
  <!-- 헤더영역 -->
  <header>
    <?php if ($userlevel == 3){
      echo'
      <div id="header-left" class="ad_cl">
      ';
      }
      else if($userlevel == 2){
        echo'
        <div id="header-left" class="tc_cl">
        ';
      }
      ?>
            <!-- <div id="header-left" class="ad_cl"> -->
      <h1>
        <a href="#" title="home">
          <img src= "<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/images/logo.png" alt="mainlogo">
        </a>
      </h1>
      <ul class="header-menu">
        <li>
          <a href="#" title="홈">
            <i class="bi bi-house-door"></i>
            <span>홈</span>
          </a>
        </li>
        <li>
          <a href="#" title="회원관리">
            <i class="bi bi-person-circle"></i>
            <span>회원관리</span>
          </a>
        </li>
        <li>
          <a href="#" title="강의관리">
          <i class="bi bi-person-video3"></i>
          <span>강의관리</span>
          </a>
        </li>
        <li>
          <a href="#" title="게시판관리">
            <i class="bi bi-clipboard2"></i>
            <span>게시판관리</span>
          </a>
        </li>
        <li>
          <a href="#" title="수강관리">
            <i class="bi bi-pencil"></i>
            <span>수강관리</span>
          </a>
        </li>
      </ul>
      <div class="header-footer">
        <ul>
          <li>
            <p>petxlab</p>
          </li>
          <li>
            <p>상호:펫츠랩 | 대표자명:차동현</p>
            <p>사업자등록번호:00-000-0000</p>
            <p>이메일:chadong@petxlab.me</p>
            <p>주소: 서울시 마포구 거시기</p>
            <p>
              <a href="#" title="이용약관">이용약관</a>
              <span>|</span>
              <a href="#" title="개인정보처리방침">개인정보처리방침</a>
            </p>
          </li>
          <li>
            <address>PETxLAB All rights reserved</address>
          </li>
        </ul>
        <a href="#" title="메인페이지 바로가기">
          <i class="bi bi-house-door"></i>
          <span>PETXLAB 홈페이지 바로가기</span>
        </a>
      </div>
    </div>

    <div id="header-right">
      <div class="header-user">
        <p>홈</p>
        <p><img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/images/minilogo.png" alt="logo"></p>
        <p>
          <span>
          <?php
          $logged = $username."(".$userid.") 님 "; 
          echo $logged; 
          ?>
          </span> 
        </p>
        <a href="./logout.php" title="로그아웃">
          <span>로그아웃</span>
        </a>
      </div>
    </div>
  </header>


  <!-- php작업시 아래 태그 기재하여 작업하기~ -->
  <!-- <main></main>
</body>
</html> -->