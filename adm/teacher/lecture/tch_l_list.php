<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/PETxLAB/config.php');
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$no=empty($_GET['no']) ? 1 : $_GET['no'];
$find=empty($_GET['find']) ? '' : $_GET['find'];
$catgo=empty($_GET['catgo']) ? 'qna_title' : $_GET['catgo'];



?>

<!-- 메인영역 -->
<main>
  <!-- adm_b_list.css -->
  <link rel="stylesheet" type="text/css" href="./css/tch_l_list.css">
  <script src="./js/tch_l_list.js" defer></script>

  <article id="main_h">
    <form action="tch_l_list.php" method="get" >
      <ul id="tab_mnu">
        <li><a href="tch_l_list.php?no=3">전체강의관리</a></li>
        <li><a href="tch_l_list.php?no=2">전문교육과정</a></li>
        <li><a href="tch_l_list.php?no=1">일반취미과정</a></li>
      </ul>
      <div id="search_wrap">
        <input type="hidden" name="no" value="<?=$no?>">
        <select id="search_box" name="catgo">
          <option value="course_title">제목 + 내용</option>
          <option value="course_category">카테고리</option>
          <option value="course_type">코스타입</option>
        </select>
        <input type="search" placeholder="여기에 입력하세요." id="text_box" name="find"  value="<?=$find?>">
        <button class="b-search"><i class="bi bi-search"></i></button>
      </div>
    </form>
  </article>

  <form action="" method="post">
  <input type="hidden" name="no" value="<?=$no?>">
  <article id="main_b">
    <table id="c_list">
      <thead>
        <tr>
          <th>No</th><th>과정ID</th><th>과정분류</th><th>카테고리</th><th>강의명</th><th>강사</th><th>강의기간</th><th>강의수</th><th>자료수</th><th>수강생수</th><th><input type="checkbox" id="check1" onclick='selectAll(this)'><label for="check1"></label></th>
        </tr>
      </thead>

  <?php
// 1. 전체 데이터 갯수 
$sql = "SELECT COUNT(*) as total FROM coursereg";
if ($no == 1) {
  $sql .= " WHERE coursereg.course_type = 'general'";
  $sql .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
} else if ($no == 2) {
  $sql .= " WHERE coursereg.course_type = 'professional'";
  $sql .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";
}else{
$sql .= ($find != "") ? " WHERE " . $catgo . " LIKE '%" . $find . "%'" : "";
}
$result = mysqli_query($con, $sql);
if (!$result) {
  die(mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];




// Calculate pagination variables
$list_num = 10;
$page_num = 5;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$total_page = ceil($total_records / $list_num);
$total_blocks = ceil($total_page / $page_num);
$now_block = ceil($page / $page_num);
$s_pageNum = ($now_block - 1) * $page_num + 1;
$e_pageNum = $now_block * $page_num;
if ($e_pageNum > $total_page) {
    $e_pageNum = $total_page;
}

// Calculate start index for query
$start = ($page - 1) * $list_num;

// Build the query to fetch records with pagination
$sql2 = "SELECT coursereg.*, userregistration.user_name FROM coursereg JOIN userregistration ON coursereg.user_id = userregistration.user_id";
$sql2 .= ($no == 1) ? " WHERE coursereg.course_type = 'general'" : (($no == 2) ? " WHERE coursereg.course_type = 'professional'" : "");
$sql2 .= ($no == 3) ? "" : "";
$sql2 .= ($find != "") ? " AND " . $catgo . " LIKE '%" . $find . "%'" : "";

// or 2. 
$sql2 .= " ORDER BY coursereg.course_id DESC LIMIT " . $start . "," . $list_num;
$result2 = mysqli_query($con, $sql2);



// 전체값을 받아 오는 것
$i =  $total_records - (($page-1)*10);
?>

<tbody>
    <?php while ($row = mysqli_fetch_assoc($result2)) {

if($row['course_type']=='professional'){$row['course_type'] ="전문교육과정";} else {$row['course_type'] =  "일반교육과정";}

        ?>
        <tr>
            <td>
              <!-- 1, PHP 숫자 정렬하기 -->
              <?php
                  echo $i;
                  $i--;
                ?>
                </td>
            <td><?= $row['course_id'] ?></td>
            <td><?= $row['course_type'] ?></td>
            <td><?= $row['course_category'] ?></td>
            <td><a href="tch_l_print.php?course_id=<?= $row['course_id'] ?>"><?= $row['course_title'] ?></a></td>
            <?php
            $user_query = "SELECT userregistration.user_name FROM userregistration WHERE userregistration.user_id = '{$row['user_id']}'";
            $user_result = mysqli_query($con, $user_query);
            $user_row = mysqli_fetch_assoc($user_result);
            ?>
            <td><?= $user_row['user_name']; ?></td>
            <td><?= $row['course_startday'] ?> ~ <?= $row['course_endday'] ?></td>
            <td>
              <?php
                $courseId = $row['course_id'];
                $sql = "SELECT COUNT(*) AS count FROM video WHERE course_id = '$courseId'";
                $result = mysqli_query($con, $sql);
                $countRow = mysqli_fetch_assoc($result);
                $count = $countRow['count'];
                echo $count;
              ?>
            </td>
            <td>
              <?php
                $courseFiles = explode(',', $row['course_file']);
                $fileCount = count($courseFiles);
                echo $fileCount;
              ?>
            </td>
            <td>
            <?php
                $courseId = $row['course_id'];
                $sql = "SELECT COUNT(*) AS count FROM user_course WHERE course_id = '$courseId'";
                $result = mysqli_query($con, $sql);
                $countRow = mysqli_fetch_assoc($result);
                $count = $countRow['count'];
                echo $count;
              ?>
            </td>
            <td><input type="checkbox" id="<?= $row['course_id'] ?>" value="<?= $row['course_id'] ?>" name="checked[]"><label for="<?= $row['course_id'] ?>"></label></td>
        </tr>
    <?php } ?>
</tbody>
    </table>

    <ul id="page_nv">
      <?php 
        /* paging : 이전 페이지 */ 

        if($page <= 1){ ?> 
        <li><a href="tch_l_list.php?no=<?=$no?>&page=1">&#x003C;</a></li>
        <?php } 
        else{ ?> 
        <li><a href="tch_l_list.php?no=<?=$no?>&page=<?php echo ($page-1); ?>">&#x003C;</a></li>
        <?php };
        ?> 
      
        <?php /* pager : 페이지 번호 출력 */ 

        for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
        <li>
          <a href="tch_l_list.php?no=<?=$no?>&page=<?php echo $print_page; ?>">
            <?php echo $print_page; ?>
          </a> 
        </li>
        <?php };?> 
        <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

        <li><a href="tch_l_list.php?no=<?=$no?>&page=<?php echo $total_page; ?>">&#x003E;</a></li>
        <?php } else{ ?>
        <li><a href="tch_l_list.php?no=<?=$no?>&page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
        <?php };
        ?>
    </ul>
    <div class="btn_box">
      <button type="submit" formaction="tch_l_write.php" >강의생성</button>
      <button type="submit" formaction="delete.php" onclick="return post();">선택삭제</button>
    </div>
  </article>
  </form>
  </main>

  <script>
    $(function(){
      let page_num = <?=$page?>;
      let no = <?=$no?>;

      let tab_menu = document.querySelectorAll('#tab_mnu li');

      //사용자가 선택한 탭메뉴의 n번째에 해당서식이 변경되게 한다.
        if( no == 3 ){
          tab_menu[0].classList.add('act01');
        }else if( no == 2){
          tab_menu[1].classList.add('act01');
        }else if( no == 1){
          tab_menu[2].classList.add('act01');
        }


      // 현재 페이지 번호
      let currentPage = <?php echo $page; ?>;

      // 페이지 번호를 감싸는 ul 태그
      let pageNav = document.querySelector('#page_nv');

      // 페이지 번호를 감싸는 li 태그들
      let pageLinks = pageNav.querySelectorAll('li');

      // 페이지 번호를 감싸는 a 태그들
      let pageAnchors = pageNav.querySelectorAll('li a');

      // 페이지 번호를 출력하는 for 문
      for (let i = 0; i < pageLinks.length; i++) {
        let link = pageLinks[i];
        let anchor = pageAnchors[i];

        // 현재 페이지인 경우
        if (parseInt(anchor.innerText) === currentPage) {
          anchor.style.color = '#333';
        }
      }

    });
  </script>
</body>