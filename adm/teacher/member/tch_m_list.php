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
  <!-- tch_m_list.css -->
  <link rel="stylesheet" type="text/css" href="./css/tch_m_list.css">
  <script src="./js/tch_m_list.js" defer></script>

  <article id="main_h">
    <ul id="tab_mnu">
      <li>수강생관리</li>
    </ul>

    <div id="search_wrap">
    <form action="tch_m_list.php" method="get" >
    <input type="hidden" name="no" value="<?=$no?>">
      <select id="search_box"  name="catgo">
        <option value="user_name">이름</option>
        <option value="user_email">이메일</option>
      </select>

      <input type="search" placeholder="여기에 입력하세요." id="text_box" name="find"  value="<?=$find?>">
      <button class="b-search"><i class="bi bi-search"></i></button>
    </form>
    </div>
  </article>
  <form action="" method="post">
  <input type="hidden" name="no" value="<?=$no?>">
  <article id="main_b">
    <table id="c_list">
      <thead>
        <tr>
          <th>No</th><th>회원번호</th><th>수강중인 강의</th><th>이름(아이디)</th><th>휴대전화</th><th>이메일</th><th>등록일</th><th>메일발송</th><th><input type="checkbox" id="check1" onclick='selectAll(this)'><label for="check1"></label></th>
        </tr>
      </thead>

      <?php
        $sql = "SELECT u.*, c.course_title
        FROM coursereg c
        JOIN user_course uc ON uc.course_id = c.course_id
        JOIN userregistration u ON u.user_id = uc.user_id
        WHERE c.user_id = '$userid'
        ".($find != "" ? "AND ".$catgo." LIKE '%".$find."%'" : "")."  
        ORDER BY u.number DESC";
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
        $sql2 = "SELECT u.*, c.course_title, uc.created_at 
        FROM coursereg c
        JOIN user_course uc ON uc.course_id = c.course_id
        JOIN userregistration u ON u.user_id = uc.user_id
        WHERE c.user_id = '$userid'
        ".($find != "" ? "AND ".$catgo." LIKE '%".$find."%'" : "")."  
        ORDER BY u.number DESC LIMIT $start, $list_num";
        $result = mysqli_query($con, $sql2);
        $cnt = $start + 1;

        $i =  $num - (($page-1)*10);
      ?> 
      

      <tbody>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php
                echo $i;
                $i--;
              ?></td>
            <td><?= $row['number'] ?></td>
            <td><?= $row['course_title'] ?></td>
            <td><a href="adm_m_view.php?no=<?= $row['number'] ?>"><?= $row['user_name'] ?></a></td>
            <td><?= $row['user_phone'] ?></td>
            <td><?= $row['user_email'] ?></td>
            <td><?= $row['created_at'] ? date('Y-m-d', strtotime($row['created_at'])) : '' ?></td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox" id="<?= $row['number'] ?>" value="<?= $row['number'] ?>" name="checked[]"><label for="<?= $row['number'] ?>"></label></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <ul id="page_nv">
      <?php 
        /* paging : 이전 페이지 */ 

        if($page <= 1){ ?> 
        <li><a href="tch_m_list.php?page=1">&#x003C;</a></li>
        <?php } 
        else{ ?> 
        <li><a href="tch_m_list.php?page=<?php echo ($page-1); ?>">&#x003C;</a></li>
        <?php };
        ?> 
      
        <?php /* pager : 페이지 번호 출력 */ 

        for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
        <li>
          <a href="tch_m_list.php?page=<?php echo $print_page; ?>">
            <?php echo $print_page; ?>
          </a> 
        </li>
        <?php };?> 
        <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

        <li><a href="tch_m_list.php?page=<?php echo $total_page; ?>">&#x003E;</a></li>
        <?php } else{ ?>
        <li><a href="tch_m_list.php?page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
        <?php };
        ?>
    </ul>
    <div class="btn_box">
      <button type="submit" formaction="mailto.php" onclick="return post();"><i class="bi bi-envelope"></i>   선택발송</button>
      <button type="submit" formaction="delete.php" onclick="return post();">선택삭제</button>
    </div>
  </article>
  </form>
  </main>

  <script>
    $(function(){
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