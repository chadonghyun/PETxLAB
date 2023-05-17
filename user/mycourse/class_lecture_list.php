<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $no=empty($_GET['no']) ? 3 : $_GET['no'];
  $find=empty($_GET['find']) ? '' : $_GET['find'];

  //전체 강의 리스트
  $sql = "SELECT * FROM user_course";
  if ($no == 1) {
    $sql .= " WHERE user_course.status = 'in_progress' AND user_course.user_id = '$userid'";
    $sql .= ($find != "") ? " AND " . "user_course.course_title" . " LIKE '%" . $find . "%'" : "";
  } else if ($no == 2) {
    $sql .= " WHERE user_course.status = 'completed' AND user_course.user_id = '$userid'";
    $sql .= ($find != "") ? " AND " . "user_course.course_title" . " LIKE '%" . $find . "%'" : "";
  } else if ($no == 3) {
    $sql .= " WHERE user_course.status = 'pending_approval' AND user_course.user_id = '$userid'";
    $sql .= ($find != "") ? " AND " . "user_course.course_title" . " LIKE '%" . $find . "%'" : "";
  }
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die(mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $row_total = mysqli_num_rows($result);

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
      <p>총 <?=$row_total?>건</p>
      <button type="submit"><i class="bi bi-search"></i></button>
      <input type="search" name="find" id="find" value="<?=$find?>" placeholder="검색어 입력">
    </div>
  </form>
  <form action="" method="post">
    <input type="hidden" name="no" value="<?=$no?>">
      <ul class="lecture_list">
        <?php
          // user_course 테이블에서 데이터 가져오기
          $sql2 = "SELECT * FROM coursereg 
                    INNER JOIN user_course ON coursereg.course_id = user_course.course_id
                    WHERE user_course.user_id = '$userid'";
          if ($no == 1) {
            $sql2 .= " AND user_course.status = 'in_progress'";
            $sql2 .= ($find != "") ? " AND " . "user_course.course_title" . " LIKE '%" . $find . "%'" : "";
          } else if ($no == 2) {
            $sql2 .= " AND user_course.status = 'completed'";
            $sql2 .= ($find != "") ? " AND " . "user_course.course_title" . " LIKE '%" . $find . "%'" : "";
          } elseif ($no == 3) {
            $sql2 .= " AND user_course.status = 'pending_approval'";
            $sql2 .= ($find != "") ? " AND " . "user_course.course_title" . " LIKE '%" . $find . "%'" : "";
          } else {
            // $no 값이 유효하지 않은 경우에 대한 처리
            echo "유효하지 않은 값입니다.";
            exit;
          }
          $sql2 .= " ORDER BY user_course.created_at DESC";
          $result2 = mysqli_query($con, $sql2);
          if (!$result2) {
            die(mysqli_error($con));
          }

          // 페이지네이션 변수 계산
          $list_num = 10; // 한 페이지에 보여줄 데이터 개수
          $page_num = 5; // 한 번에 표시할 페이지 번호 개수
          $page = isset($_GET["page"]) ? $_GET["page"] : 1; // 현재 페이지 번호
          $total_page = ceil($result2->num_rows / $list_num); // 총 페이지 개수
          $total_blocks = ceil($total_page / $page_num); // 총 블록 개수
          $now_block = ceil($page / $page_num); // 현재 블록 번호
          $s_pageNum = ($now_block - 1) * $page_num + 1; // 표시할 첫 번째 페이지 번호
          $e_pageNum = $now_block * $page_num; // 표시할 마지막 페이지 번호
          if ($e_pageNum > $total_page) {
              $e_pageNum = $total_page;
          }

          // 현재 페이지에 해당하는 데이터 가져오기
          $start = ($page - 1) * $list_num; // 조회 시작 위치
          $sql2 .= " LIMIT $start, $list_num";
          $result2 = mysqli_query($con, $sql2);
          if (!$result2) {
              die(mysqli_error($con));
          }
          while ($row2 = $result2->fetch_assoc()) {
            if($row2['course_type']=='professional'){$row2['course_type'] ="전문교육과정";} else {$row2['course_type'] =  "일반교육과정";}
            // 각 행의 데이터를 사용하여 동적으로 <li> 요소 생성
            $courseType = $row2['course_type'];
            $courseTitle = $row2['course_title'];
            $courseImg = $row2['course_image'];
            $number = $row2['course_id'];
        ?>
        <li class="lec_con d-flex">
          <div class="img_box2"><img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/adm/teacher/lecture/uploads/<?=$courseImg?>" alt="강의이미지"></div>
          <div class="content" >
            <span class="lec_cate"><?=$courseType?></span>
            <p class="lec_title"><?=$courseTitle?></p>
            <div class="progress_bar">
              <div class="progress_gauge" style="width : <?=$row2['progress']?>%"></div>
            </div>
            <span class="per">진도율 : <?=$row2['progress']?>%</span>
            <a href="./class_lecture_view.php?no=<?=$number?>" title="바로가기" class="shortcut">바로가기</a>
          </div>
        </li>
        <?php } ?>
      </ul>
      <div class="pagination">
      <?php if ($s_pageNum > 1) { ?>
          <a href="?no=<?=$no?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo $s_pageNum - 1; ?>" class="page_link">&lt;</a>
      <?php } ?>
      <?php for ($i = $s_pageNum; $i <= $e_pageNum; $i++) { ?>
          <a href="?no=<?=$no?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo $i; ?>" class="page_link <?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
      <?php } ?>
      <?php if ($e_pageNum < $total_page) { ?>
          <a href="?no=<?=$no?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo $e_pageNum + 1; ?>" class="page_link">&gt;</a>
      <?php } ?>
    </div>
  </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>