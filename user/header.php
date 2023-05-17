<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

  // 학습중
  $sql_in_progress = "SELECT COUNT(*) AS count_in_progress FROM user_course WHERE user_id = '$userid' AND status = 'in_progress'";
  $result_in_progress = $con->query($sql_in_progress);
  $row_in_progress = $result_in_progress->fetch_assoc();
  $count_in_progress = $row_in_progress["count_in_progress"];

  // 신청 내역 수 조회 (pending_approval 상태)
  $sql_pending_approval = "SELECT COUNT(*) AS count_pending_approval FROM user_course WHERE user_id = '$userid' AND status = 'pending_approval'";
  $result_pending_approval = $con->query($sql_pending_approval);
  $row_pending_approval = $result_pending_approval->fetch_assoc();
  $count_pending_approval = $row_pending_approval["count_pending_approval"];

  // 학습완료
  $sql_completed = "SELECT COUNT(*) AS count_completed FROM user_course WHERE user_id = '$userid' AND status = 'completed'";
  $result_completed = $con->query($sql_completed);
  $row_completed = $result_completed->fetch_assoc();
  $count_completed = $row_completed["count_completed"];

  //최근 학습 중인 강의
  if (isset($_SESSION['userid'])) {
    $sql_recent = "SELECT user_course.course_id, coursereg.course_title, coursereg.course_type, coursereg.course_image, user_course.progress 
    FROM coursereg
    INNER JOIN user_course ON coursereg.course_id = user_course.course_id
    WHERE user_course.user_id = '$userid' AND user_course.confirm = 1
    ORDER BY user_course.user_course_id DESC LIMIT 1";
    $result_recent = mysqli_query($con, $sql_recent);
    if(!$result_recent){
      die(mysqli_error($con));
    }
    $row_recent = mysqli_fetch_assoc($result_recent);
    if($row_recent['course_type']=='professional'){$row_recent['course_type'] ="전문교육과정";} else {$row_recent['course_type'] =  "일반교육과정";}
    $courseTitle = $row_recent['course_title'];
    $courseType = $row_recent['course_type'];
    $courseImg = $row_recent['course_image'];
    $progress = $row_recent['progress'];
  }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="펫슬랩,petxlab,반려동물,동물강의,반려동물강의,인터넷강의,동물,애완동물">
  <meta name="Description" content="Let me do it for you. 반려동물을 위한 교육 패러다임.">
  <meta name="Robots" content="noindex,nofollow">
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
  <!-- 헤더.js -->
  <script src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/js/header.js"></script>
  <!-- myclass.js(나의강의실스크립트) -->
  <!-- <script src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/js/myclass.js" defer></script> -->

  <!-- 다음 주소 api -->
  <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script src="./script/addressapi.js"></script>
</head>
<body>
  <header>
    <ul>
      <li class="mnu_bar">
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
      </li>

      <li><a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/index.php" title="메인페이지 바로가기"><img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo_main.png" alt="메인로고"></a></li>
      
      <?php 
          if(!$userid){
        ?>
        <li class="user_bar"><a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/login.php">LOGIN</a></li>
        <?php
          }else{
            $logged = $userid;
        ?>
        <li class="user_bar"><img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo_user.png" alt="user아이콘"></li>
        <?php
          }
        ?>
    </ul>

    <article class="left_box">
      <div class="gnb_hd">
      <?php 
          if(!$userid){
        ?>
        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/login.php">
        <button class="log_btn">로그인</button></a>
        <?php
          }else{
            $logged = $userid;
        ?>
        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/logout.php" title="로그아웃">
        <button class="out_btn">로그아웃</button></a>
        <?php
          }
        ?>
        <div class="close_btn">
          <span>&nbsp;</span>
          <span>&nbsp;</span>
        </div>
      </div>
      <ul class="gnb">
        <div class="cat_box">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/cat.png" alt="">
        </div>
        <li class="act01"><a href="#none" title="아카데미소개" class="act01">아카데미소개</a>
          <ul class="lnb">
            <li><a href="#none" title="회사소개">회사소개</a></li>
            <li><a href="#none" title="찾아오시는 길">찾아오시는 길</a></li>
          </ul>
        </li>
        
        <li><a href="#none" title="전문교육과정">전문교육과정</a>
          <ul class="lnb">
            <li><a href="#none" title="반려동물 전문창업">반려동물 전문창업</a>
          </li>
            <li><a href="#none" title="반려동물 행동교정사">반려동물 행동교정사</a>
          </li>
            <li><a href="#none" title="반려동물 식품관리사">반려동물 식품관리사</a>
          </li>
            <li><a href="#none" title="펫 유치원 교원사">펫 유치원 교원사</a>
          </li>
            <li><a href="#none" title="펫 뷰티션">펫 뷰티션</a>
          </li>
            <li><a href="#none" title="펫 장례코디네이터">펫 장례코디네이터</a>
          </li>
            <li><a href="#none" title="반려동물 관리사">반려동물 관리사</a>
          </li>
            <li><a href="#none" title="동물병원 코디네이터">동물병원 코디네이터</a>
          </li>
            <li><a href="#none" title="펫시터">펫시터</a>
          </li>
          </ul>
        </li>

        <li><a href="#none" title="일반교육과정">일반교육과정</a>
          <ul class="lnb">
            <li><a href="#none" title="펫푸드">펫푸드</a></li>
            <li><a href="#none" title="펫미용">펫미용</a></li>
            <li><a href="#none" title="펫아이템">펫아이템</a></li>
            <li><a href="#none" title="행동교정">행동교정</a></li>
          </ul>
        </li>

        <li><a href="#none" title="수강후기">수강후기</a>
          <ul class="lnb">
            <li><a href="#none" title="동문현황">동문현황</a></li>
            <li><a href="#none" title="영상후기">영상후기</a></li>
            <li><a href="#none" title="자필후기">자필후기</a></li>
          </ul>
        </li>

        <li><a href="#none" title="취창업정보">취창업정보</a>
          <ul class="lnb">
            <li><a href="#none" title="구인정보">구인정보</a></li>
            <li><a href="#none" title="인재등록">인재등록</a></li>
            <li><a href="#none" title="자료실">자료실</a></li>
          </ul>
        </li>

        <li><a href="#none" title="고객센터">고객센터</a>
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
        <?php 
            if(!$userid){
          ?>
          <a href="$_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/login.php"><button class="log_btn">로그인</button></a>
          <?php
            }else{
              $logged = $userid;
          ?>
          <ul>
            <li class="mnu_bar">
              <span>&nbsp;</span>
              <span>&nbsp;</span>
              <span>&nbsp;</span>
            </li>
          </ul>
          <?php
            }
          ?>
        <div class="close_btn">
          <span>&nbsp;</span>
          <span>&nbsp;</span>
        </div>
      </div>

      <div class="user_info">
        <p><a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/logout.php" title="로그아웃">로그아웃</a></p>
        <div class="flex_box">
          <div class="img_box">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo.png" alt="user_img">
        </div>
        <div class="txt_box">
            <p>안녕하세요</p>

            <?php
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT user_name FROM userregistration WHERE user_id='$user_id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            echo "<p><span>".$row['user_name']."</span>님</p>";
            ?>
          </div>
        </div>
        <div class="myPage">
          <p><a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/signin_print.php" title="나의정보">나의정보</a></p>
          <p><a href="#none" title="나의정보">1:1 상담</a></p>
        </div>
      </div>

      <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/myclass.php" title="내강의실 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon01.png" alt="내강의실">
          </div>
          <p>내 강의실</p>
          <span>&nbsp;</span>
      </a>

      <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/class_lecture_list.php?no=1" title=">학습중인수업 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon02.png" alt=">학습중인수업">
          </div>
          <p>학습중인 수업</p>
          <span><?php echo $count_in_progress?>건</span>
      </a>

      <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/class_lecture_list.php?no=2" title="학습종료된 수업 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon03.png" alt="학습종료된 수업">
          </div>
          <p>학습종료된 수업</p>
          <span><?php echo $count_completed?>건</span>
      </a>

      <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/class_lecture_list.php?no=3" title="수업신청내역 바로가기" class="lecture_box">
          <div>
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/icon04.png" alt="수업신청내역">
          </div>
          <p>수업신청내역</p>
          <span><?php echo $count_pending_approval?>건</span>
      </a>
    </article>
  </header>
  <!-- php작업시 아래 태그 기재하여 작업하기~ -->
  <!-- <main></main>
</body>
</html> -->