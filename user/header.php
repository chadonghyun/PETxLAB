<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PETxLAB</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/favicon/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/favicon/favicon.ico" type="image/x-icon">

  <!-- 부트스트랩 css연결 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- 부트스트랩 아이콘 연결 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
  <!--부트스트랩 자바스크립트 연결-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!--제이쿼리 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- 리셋파일 -->
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/css/reset.css" type="text/css">
  <!-- base.css(공통서식) -->
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/css/base.css" type="text/css">
  <!-- coom.css(헤더&푸터서식) -->
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/css/common.css" type="text/css">
  <script src="./js/header.js"></script>
</head>
<body>
  <header>
    <ul>
      <li class="mnu_bar">
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
      </li>
      <li><a href="index.php" title="메인페이지 바로가기"><img src="./images/logo_main.png" alt="메인로고"></a></li>
      <li><img src="./images/logo_user.png" alt="user아이콘"></li>
    </ul>

    <article class="right_box">
      <div class="gnb_hd">
        <button>로그아웃</button>
        <div class="close_btn">
          <span>&nbsp;</span>
          <span>&nbsp;</span>
        </div>
      </div>
      <ul class="gnb">
        <li class="act01">아카데미소개
          <ul class="lnb">
            <li>회사소개</li>
            <li>찾아오시는 길</li>
          </ul>
        </li>
        <li>전문교육과정
          <ul class="lnb">
            <li>반려동물 전문창업</li>
            <li>반려동물 행동교정사</li>
            <li>반려동물 식품관리사</li>
            <li>펫 유치원 교원사</li>
            <li>펫 뷰티션</li>
            <li>반려동물장례코디네이터</li>
            <li>반려동물관리사</li>
            <li>동물병원코디네이터</li>
            <li>펫시터</li>
          </ul>
        </li>
        <li>일반교육과정
          <ul class="lnb">
            <li>펫푸드</li>
            <li>펫미용</li>
            <li>펫아이템</li>
            <li>행동교정</li>
          </ul>
        </li>
        <li>수강후기
          <ul class="lnb">
            <li>동문현황</li>
            <li>영상후기</li>
            <li>자필후기</li>
          </ul>
        </li>
        <li>취창업정보
          <ul class="lnb">
            <li>구인정보</li>
            <li>인재등록</li>
            <li>자료실</li>
          </ul>
        </li>
        <li>고객센터
          <ul class="lnb">
            <li>공지사항</li>
            <li>아카데미뉴스</li>
            <li>교육현장갤러리</li>
            <li>1:1문의</li>
            <li>자주하는 질문</li>
          </ul>
        </li>
      </ul>
    </article>
  </header>

  <?php
    include './footer.php';
  ?>

  <!-- php작업시 아래 태그 기재하여 작업하기~ -->
  <!-- <main></main>
</body>
</html> -->