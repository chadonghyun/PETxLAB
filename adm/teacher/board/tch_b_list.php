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
  <link rel="stylesheet" type="text/css" href="./css/tch_b_list.css">
  <script src="./js/tch_b_list.js" defer></script>

  <article id="main_h">
    <ul id="tab_mnu">
      <li><a href="tch_b_list.php?no=1">QnA 게시판</a></li>
    </ul>
    <select id="lecture_box">
        <option value="제목 + 내용">강의선택</option>
        <option value="강의명1">강의명1</option>
        <option value="강의명2">강의명2</option>
        <option value="강의명3">강의명3</option>
      </select>

    <div id="search_wrap">
        <form action="tch_b_list.php" method="get" >
          <input type="hidden" name="no" value="<?=$no?>">
        <select id="search_box" name="catgo">
          <option value="qna_title">제목 + 내용</option>
          <option value="uesr_id">아이디</option>
          <option value="qna_category">카테고리</option>
        </select>

        <input type="search" placeholder="여기에 입력하세요." name="find" id="text_box" value="<?=$find?>">
        <button class="b-search"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </article>

  <article id="main_b">
    <table id="c_list">
      <thead>
        <tr>
          <th>No</th><th>게시판</th><th>제목</th><th>작성자</th><th>작성일</th><th>답변여부</th><th><input type="checkbox" id="check1" onclick='selectAll(this)'><label for="check1"></th>
        </tr>
      </thead>

      <?php

        $sql = "select * from boardqnareg ".($find != "" ? "WHERE ".$catgo." LIKE '%".$find."%' " : "")." order by number desc";
        $result = mysqli_query($con, $sql);

        $num = mysqli_num_rows($result);

        $list_num = 10;
        $page_num = 5;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $total_page = ceil($num / $list_num);
        $total_block = ceil($total_page / $page_num);
        $now_block = ceil($page / $page_num);
        $s_pageNum = ($now_block - 1) * $page_num + 1;
        if($s_pageNum <= 0){$s_pageNum = 1;};
        $e_pageNum = $now_block * $page_num;
        if($e_pageNum > $total_page){$e_pageNum = $total_page;};

        $start = ($page - 1) * $list_num;
        $sql2 = "select * from boardqnareg order by number desc limit $start, $list_num;";
        $result = mysqli_query($con, $sql2);
        $cnt = $start + 1;

        $sql4 = "SELECT course_id FROM coursereg WHERE user_id = '$userid'";

        $sql = "SELECT qna_title, Board_date, qna_category, number, qna_response, user_id FROM boardqnareg WHERE course_id IN ($sql4) ".($find != "" ? " AND ".$catgo." LIKE '%".$find."%' " : "")." ORDER BY number DESC LIMIT $start, $list_num";
        $result3 = mysqli_query($con, $sql);

        $num2 = mysqli_num_rows($result3);

        $i =  $num2 - (($page-1)*10);
      ?>

      <tbody>
        <?php while ($row2 = mysqli_fetch_assoc($result3)) { ?>
          <tr>
            <td><?php
                echo $i;
                $i--;
                ?></td>
            <td><?= $row2['qna_category'] ?></td>
            <td><?= $row2['qna_title'] ?></td>
            <td><?= $row2['user_id'] ?></td>
            <td><?= substr($row2['Board_date'], 0, 10)?></td>
            <?php if($row2['qna_response'] == '0') { ?>
              <td>미답변</td>
            <?php } else { ?>
              <td>답변완료</td>
            <?php } ?>
            <td><input type="checkbox" id="<?= $row['number'] ?>"><label for="<?= $row['number'] ?>"></label></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <ul id="page_nv">
      <?php 
      
        /* paging : 이전 페이지 */ 
        if($page <= 1){ ?> 
          <li><a href="tch_b_list.php?page=1">&#x003C;</a></li>
          <?php } 
          else{ ?> 
          <li><a href="tch_b_list.php?page=<?php echo ($page-1); ?>">&#x003C;</a></li>
          <?php };
          ?> 
      
      <?php /* pager : 페이지 번호 출력 */ 

      for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
      <li>
        <a href="tch_b_list.php?page=<?php echo $print_page; ?>">
          <?php echo $print_page; ?>
        </a> 
      </li>
      <?php };?> 
      <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

      <li><a href="tch_b_list.php?page=<?php echo $total_page; ?>">&#x003E;</a></li>
      <?php } else{ ?>
      <li><a href="tch_b_list.php?page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
      <?php };
      ?>
    </ul>
    <div class="btn_box">
    <button onclick="location.href='tch_b_write.php'">게시글작성</button>
    <button>전체삭제</button>
    <button>선택삭제</button>
    </div>
  </article>
  </main>

  <script>
    $(function(){
      let page_num = <?=$page?>;
      let no = <?=$no?>;

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
</html>