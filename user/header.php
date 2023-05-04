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
      <li><a href="index.php" title="메인페이지 바로가기"><img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo_main.png" alt="메인로고"></a></li>
      <li class="user_bar"><img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo_user.png" alt="user아이콘"></li>
    </ul>

    <article class="left_box">
      <div class="gnb_hd">
        <button>로그아웃</button>
        <div class="close_btn">
          <span>&nbsp;</span>
          <span>&nbsp;</span>
        </div>
      </div>
      <ul class="gnb">
        <div class="cat_box">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/cat.png" alt="">
        </div>
        <li class="act01">아카데미소개
          <ul class="lnb">
            <li><a href="#none" title="회사소개">회사소개</a></li>
            <li><a href="#none" title="찾아오시는 길">찾아오시는 길</a></li>
          </ul>
        </li>
        <li>전문교육과정
          <ul class="lnb">
            <li><a href="#none" title="반려동물 전문창업">반려동물 전문창업</a></li>
            <li><a href="#none" title="반려동물 행동교정사">반려동물 행동교정사</a></li>
            <li><a href="#none" title="반려동물 식품관리사">반려동물 식품관리사</a></li>
            <li><a href="#none" title="펫 유치원 교원사">펫 유치원 교원사</a></li>
            <li><a href="#none" title="펫 뷰티션">펫 뷰티션</a></li>
            <li><a href="#none" title="펫 장례코디네이터">펫 장례코디네이터</a></li>
            <li><a href="#none" title="반려동물 관리사">반려동물 관리사</a></li>
            <li><a href="#none" title="동물병원 코디네이터">동물병원 코디네이터</a></li>
            <li><a href="#none" title="펫시터">펫시터</a></li>
          </ul>
        </li>
        <li>일반교육과정
          <ul class="lnb">
            <li><a href="#none" title="펫푸드">펫푸드</a></li>
            <li><a href="#none" title="펫미용">펫미용</a></li>
            <li><a href="#none" title="펫아이템">펫아이템</a></li>
            <li><a href="#none" title="행동교정">행동교정</a></li>
          </ul>
        </li>
        <li>수강후기
          <ul class="lnb">
            <li><a href="#none" title="동문현황">동문현황</a></li>
            <li><a href="#none" title="영상후기">영상후기</a></li>
            <li><a href="#none" title="자필후기">자필후기</a></li>
          </ul>
        </li>
        <li>취창업정보
          <ul class="lnb">
            <li><a href="#none" title="구인정보">구인정보</a></li>
            <li><a href="#none" title="인재등록">인재등록</a></li>
            <li><a href="#none" title="자료실">자료실</a></li>
          </ul>
        </li>
        <li>고객센터
          <ul class="lnb">
            <li><a href="#none" title="공지사항">공지사항</a></li>
            <li><a href="#none" title="아카데미뉴스">아카데미뉴스</a></li>
            <li><a href="#none" title="교육현장갤러리">교육현장갤러리</a></li>
            <li><a href="#none" title="1:1문의">1:1문의</a></li>
            <li><a href="#none" title="자주하는 질문">자주하는 질문</a></li>
          </ul>
        </li>
      </ul>
    </article>

    <article class="right_box">
      <div class="gnb_hd">
        <button>로그아웃</button>
        <div class="close_btn">
          <span>&nbsp;</span>
          <span>&nbsp;</span>
        </div>
      </div>

      <div class="user_info">
        <div class="flex_box">
          <div class="img_box">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo.png" alt="user_img">
          </div>
          <div class="txt_box">
            <p>안녕하세요</p>
            <p><span>이름자리</span>님</p>
          </div>
        </div>
        <div class="myPage">
          <p><a href="#none" title="나의정보">나의정보</a></p>
          <p><a href="#none" title="나의정보">1:1 상담</a></p>
        </div>
      </div>

      <a href="#none" title="내강의실 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon01.png" alt="내강의실">
          </div>
          <p>내 강의실</p>
          <span>&nbsp;</span>
      </a>

      <a href="#none" title=">학습중인수업 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon02.png" alt=">학습중인수업">
          </div>
          <p>학습중인 수업</p>
          <span>0건</span>
      </a>

      <a href="#none" title="학습종료된 수업 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon03.png" alt="학습종료된 수업">
          </div>
          <p>학습종료된 수업</p>
          <span>0건</span>
      </a>

      <a href="#none" title="수업신청내역 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon04.png" alt="수업신청내역">
          </div>
          <p>수업신청내역</p>
          <span>0건</span>
      </a>
    </article>
  </header>

  <?php
    include './footer.php';
  ?>

  <!-- php작업시 아래 태그 기재하여 작업하기~ -->
  <!-- <main></main>
</body>
</html> -->