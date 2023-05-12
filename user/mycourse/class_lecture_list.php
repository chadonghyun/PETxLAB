<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $no=empty($_GET['no']) ? 3 : $_GET['no'];
  $find=empty($_GET['find']) ? '' : $_GET['find'];
  $catgo=empty($_GET['catgo']) ? 'qna_title' : $_GET['catgo'];

  //전체 강의 리스트

?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_lecture_list.css" type="text/css">
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/js/class_QnA_list.js"></script>

<main>
  <form action="class_lecture_list.php" method="get">
    <h2 class="sub_title">
      <ul id="cate">
        <li class="active"><a href="class_lecture_list.php?no=1" title="학습중인 수업">학습중인 수업</a></li>
        <li><a href="class_lecture_list.php?no=2" title="학습종료된 수업">학습종료된 수업</a></li>
        <li><a href="class_lecture_list.php?no=3" title="수업신청 내역">수업신청 내역</a></li>
      </ul>
      <span id="toggle"><i class="bi bi-caret-down-fill"></i></span>
    </h2>
    <div class="search_area d-flex">
      <input type="hidden" name="no" value="<?=$no?>">
      <p>총 <?php?>건</p>
      <button type="submit"><i class="bi bi-search"></i></button>
      <input type="search" name="find" id="find" value="<?=$find?>" placeholder="검색어 입력">
    </div>
  </form>
  <form action="" method="post">
    <input type="hidden" name="no" value="<?=$no?>">
      <ul class="lecture_list">
        <li class="lec_con d-flex">
          <div class="img_box"><img src="" alt=""></div>
          <div class="content" >
            <span class="lec_cate"><?php?>전문교육과정</span>
            <p class="lec_title"><?php?>펫베이커리 특화과정</p>
            <div class="progress_bar">
              <div class="progress_gauge"></div>
            </div>
            <span class="per">진도율 : </span>
            <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user" title="바로가기" class="shortcut">바로가기</a>
          </div>
        </li>
      </ul>
  </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>