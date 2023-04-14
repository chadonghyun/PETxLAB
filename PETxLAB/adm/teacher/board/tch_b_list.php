<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/PETxLAB/adm/db/db_con.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/PETxLAB/adm/config.php');
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";
?>

<!-- 메인영역 -->
<main>
  <!-- adm_b_list.css -->
  <link rel="stylesheet" type="text/css" href="./css/tch_b_list.css">
  <script src="./js/tch_b_list.js" defer></script>

  <article id="main_h">
    <ul id="tab_mnu">
      <li>QnA 게시판</li>
    </ul>
    <select id="lecture_box">
        <option value="제목 + 내용">강의선택</option>
        <option value="강의명1">강의명1</option>
        <option value="강의명2">강의명2</option>
        <option value="강의명3">강의명3</option>
      </select>

    <div id="search_wrap">
      <select id="search_box">
        <option value="제목 + 내용">제목 + 내용</option>
        <option value="아이디">아이디</option>
        <option value="이름">이름</option>
      </select>

      <input type="search" placeholder="여기에 입력하세요." id="text_box">
      <i class="bi bi-search"></i>
    </div>
  </article>

  <article id="main_b">
    <table id="c_list">
      <thead>
        <tr>
          <th>No</th><th>게시판</th><th>제목</th><th>작성자</th><th>작성일</th><th>조회수</th><th><input type="checkbox" id="check1" onclick='selectAll(this)'><label for="check1"></th>
        </tr>
      </thead>

      <?php
        $sql = "select * from boardnoticereg order by number desc";
        $result = mysqli_query($con, $sql);

        $num = mysqli_num_rows($result);

        $list_num = 10;
        $page_num = 5;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $total_page = ceil($num / $list_num);
        $total_block = ceil($total_page / $page_num);
        $now_block = ceil($page / $page_num);
        $s_pageNum = ($now_block - 1) * $page_num + 1;
        $s_oageNum = ($now_block -1) * $page_num +1;
        if($s_pageNum <= 0){$s_pageNum = 1;};
        $e_pageNum = $now_block * $page_num;
        if($e_pageNum > $total_page){$e_pageNum = $total_page;};

        $start = ($page - 1) * $list_num;
        $sql2 = "select * from boardnoticereg order by number desc limit $start, $list_num;";
        $result = mysqli_query($con, $sql2);
        $cnt = $start + 1;

        $query = "SELECT userregistration.user_name
          FROM userregistration
          JOIN boardnoticereg ON userregistration.user_id = boardnoticereg.user_id
          WHERE userregistration.user_level = 2";
        $result3 = mysqli_query($con, $query);
      ?>

      <tbody>
        <?php while ($row = mysqli_fetch_array($result)){
          $row2 = mysqli_fetch_assoc($result3); // while문 안에서 한번씩만 실행되도록 변경
        ?>
        <tr>
          <td><?= $row['number'] ?></td>
          <td><?= $row['Board_title'] ?></td>
          <td><?= $row['Board_content'] ?></td>
          <td><?= $row2['user_name']; ?></td>
          <td><?= $row['Board_date'] ? date('Y-m-d', strtotime($row['Board_date'])) : ''?></td>
          <td><?= $row['user_views'] ?></td>
          <td><input type="checkbox" id="<?= $row['number'] ?>"><label for="<?= $row['number'] ?>"></label></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <ul id="page_nv">
      <?php 
        /* paging : 이전 페이지 */ 

        if($page <= 1){ ?> 
        <li><a href="adm_m_list.php?page=1">&#x003C;</a></li>
        <?php } 
        else{ ?> 
        <li><a href="adm_m_list.php?page=<?php echo ($page-1); ?>">&#x003C;</a></li>
        <?php };
        ?> 
      
        <?php /* pager : 페이지 번호 출력 */ 

        for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
        <li>
          <a href="adm_m_list.php?page=<?php echo $print_page; ?>">
            <?php echo $print_page; ?>
          </a> 
        </li>
        <?php };?> 
        <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

        <li><a href="adm_m_list.php?page=<?php echo $total_page; ?>">&#x003E;</a></li>
        <?php } else{ ?>
        <li><a href="adm_m_list.php?page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
        <?php };
        ?>
    </ul>

    <button>게시글작성</button>
    <button>전체삭제</button>
    <button>선택삭제</button>
  </article>
  </main>
</body>
</html>