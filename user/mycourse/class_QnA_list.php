<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $no=empty($_GET['no']) ? 3 : $_GET['no'];
  $find=empty($_GET['find']) ? '' : $_GET['find'];
  $catgo=empty($_GET['catgo']) ? 'qna_title' : $_GET['catgo'];
  
  // 1. 전체 데이터 개수
  $sql = "SELECT COUNT(*) as total FROM boardqnareg";
  if ($no == 2) {
    $sql .= " WHERE boardqnareg.qna_response = '1' AND boardqnareg.user_id = '$userid'";
    $sql .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
  } else if ($no == 3) {
    $sql .= " WHERE boardqnareg.qna_response = '0' AND boardqnareg.user_id = '$userid'";
    $sql .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
  } else {
    $sql .= " WHERE boardqnareg.user_id = '$userid'";
    $sql .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
  }
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die(mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $total_records = $row['total'];

?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_QnA_list.css" type="text/css">
<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/js/class_QnA_list.js"></script>


<main>
  <form action="class_QnA_list.php" method="get">
    <h2 class="sub_title">
      <ul id="cate">
        <li class="active"><a href="class_QnA_list.php?no=1">QnA 전체</a></li>
        <li><a href="class_QnA_list.php?no=2">QnA 해결</a></li>
        <li><a href="class_QnA_list.php?no=3">QnA 미해결</a></li>
      </ul>
      <span id="toggle"><i class="bi bi-caret-down-fill"></i></span>
    </h2>
    <div class="search_area d-flex">
      <input type="hidden" name="no" value="<?=$no?>">
      <p>총 <?=$total_records ?>건</p>
      <button type="submit"><i class="bi bi-search"></i></button>
      <input type="search" name="find" id="find" value="<?=$find?>" placeholder="검색어 입력">
    </div>
  </form>
  <form action="" method="post">
    <input type="hidden" name="no" value="<?=$no?>">
    <ul class="course_list">
      <?php
        // boardqnareg 테이블에서 데이터 가져오기
        $sql3 = "SELECT * FROM boardqnareg ";
        if ($no == 1) {
          $sql3 .= "WHERE user_id = '$userid'";
          $sql3 .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
        } elseif ($no == 2) {
          $sql3 .= "WHERE user_id = '$userid' AND qna_response = 1";
          $sql3 .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
        } elseif ($no == 3) {
          $sql3 .= "WHERE user_id = '$userid' AND qna_response = 0";
          $sql3 .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
        } else {
          // $no 값이 유효하지 않은 경우에 대한 처리
          echo "유효하지 않은 값입니다.";
          exit;
        }
        $sql3 .= " ORDER BY Board_date DESC";
        $result3 = mysqli_query($con, $sql3);
        if (!$result3) {
          die(mysqli_error($con));
        }
      
        // 페이지네이션 변수 계산
        $list_num = 10; // 한 페이지에 보여줄 데이터 개수
        $page_num = 5; // 한 번에 표시할 페이지 번호 개수
        $page = isset($_GET["page"]) ? $_GET["page"] : 1; // 현재 페이지 번호
        $total_page = ceil($result3->num_rows / $list_num); // 총 페이지 개수
        $total_blocks = ceil($total_page / $page_num); // 총 블록 개수
        $now_block = ceil($page / $page_num); // 현재 블록 번호
        $s_pageNum = ($now_block - 1) * $page_num + 1; // 표시할 첫 번째 페이지 번호
        $e_pageNum = $now_block * $page_num; // 표시할 마지막 페이지 번호
        if ($e_pageNum > $total_page) {
            $e_pageNum = $total_page;
        }

        // 현재 페이지에 해당하는 데이터 가져오기
        $start = ($page - 1) * $list_num; // 조회 시작 위치
        $sql3 .= " LIMIT $start, $list_num";
        $result3 = mysqli_query($con, $sql3);
        if (!$result3) {
            die(mysqli_error($con));
        }
        while ($row2 = $result3->fetch_assoc()) {
          // 각 행의 데이터를 사용하여 동적으로 <li> 요소 생성
          $qnaStatus = $row2['qna_response'];
          $courseTitle = $row2['qna_title'];
          $registrationDate = $row2['Board_date'];
          $number = $row2['number'];
          $qna_cate = $row2['qna_category'];
      ?>
      <!-- 생성된 <li> 요소 출력 -->
      <li class="card d-flex justify-content-between">
        <div class="course_desc d-flex">
          <span class="course_cate" style="text-decoration:none;"><?php echo $qna_cate?></span>
          <span class="<?php echo $row2['qna_response'] == 1 ? 'com' : 'fal'; ?>">
            <?php echo $qnaStatus == 1 ? '해결' : '미해결'; ?>
          </span>
          <a href="./class_QnA_view.php?number=<?php echo $number; ?>" class="course_title"><?php echo $courseTitle; ?></a>
          <p class="registration_date">등록일 : <?php echo date('Y-m-d', strtotime($registrationDate)); ?></p>
          <a href="./class_QnA_view.php?number=<?php echo $number; ?>" class="detail_btn">바로가기</a>
        </div>
      </li>
    <?php } ?>
    </ul>
    <div class="pagination">
      <?php if ($s_pageNum > 1) { ?>
          <a href="?no=<?=$no?>&page=<?php echo $s_pageNum - 1; ?>" class="page_link">&lt;</a>
      <?php } ?>
      <?php for ($i = $s_pageNum; $i <= $e_pageNum; $i++) { ?>
          <a href="?no=<?=$no?>&page=<?php echo $i; ?>" class="page_link <?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
      <?php } ?>
      <?php if ($e_pageNum < $total_page) { ?>
          <a href="?no=<?=$no?>&page=<?php echo $e_pageNum + 1; ?>" class="page_link">&gt;</a>
      <?php } ?>
    </div>
  </form>
</main>


<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>