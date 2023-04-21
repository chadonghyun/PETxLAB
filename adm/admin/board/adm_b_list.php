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
  <!-- adm_m_list.css -->
  <link rel="stylesheet" type="text/css" href="./css/adm_b_list.css">
  <script src="./js/adm_b_list.js" defer></script>

  <article id="main_h">
    <ul id="tab_mnu">
      <li><a href="adm_b_list.php?no=1">공지사항</a></li>
      <li><a href="adm_b_list.php?no=2">QnA</a></li>
    </ul>

    <div id="search_wrap">
    <form action="adm_b_list.php" method="get" >
          <input type="hidden" name="no" value="<?=$no?>">
        <select id="search_box" name="catgo">
      <?php
        if($no == 1){
            echo "
            <option value='Board_title'>제목 + 내용</option>
            <option value='uesr_id'>아이디</option>
            <option value='Board_content'>컨텐츠</option>
            ";
          }else if ($no == 2) {
            echo "
            <option value='qna_title'>제목 + 내용</option>
            <option value='uesr_id'>아이디</option>
            <option value='qna_category'>카테고리</option>
            ";
          }
          ?>
        </select>

      <input type="search" placeholder="여기에 입력하세요." id="text_box" name="find" value="<?=$find?>">
      <button class="b-search"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </article>
  <article id="main_b">
    <table id="c_list">
      <thead>

      <?php
          $sql = "select * from boardqnareg ".($find != "" ? "WHERE ".$catgo." LIKE '%".$find."%' " : "")." order by number desc";  

          if($no == 1){
            echo "<tr><th>No</th><th>게시판</th><th>제목</th><th>작성자</th><th>작성일</th><th>조회수</th><th><input type='checkbox' id='check1' onclick='selectAll(this)'><label for='check1'></label></th></tr>  </thead>";
            $sql = "select * from boardnoticereg order by number desc";
          }else if($no == 2){
            echo "<tr><th>No</th><th>게시판</th><th>제목</th><th>작성자</th><th>작성일</th><th>답변여부</th><th><input type='checkbox' id='check1' onclick='selectAll(this)'><label for='check1'></label></th></tr>       </thead>";
            $sql = "select * from boardqnareg order by number desc";
          }

        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);

        $list_num = 10;
        $page_num = 5;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $total_page = ceil($num / $list_num);
        $total_block = ceil($total_page / $page_num);
        $now_block = ceil($page / $page_num);
        $s_pageNum = ($now_block -1) * $page_num +1;
        if($s_pageNum <= 0){$s_pageNum = 1;};
        $e_pageNum = $now_block * $page_num;
        if($e_pageNum > $total_page){$e_pageNum = $total_page;};

        $start = ($page - 1) * $list_num;
        $cnt = $start + 1;
        $i = 1;
        if($no == 1){
          $query = "SELECT * FROM boardnoticereg ".($find != "" ? "WHERE ".$catgo." LIKE '%".$find."%' " : "")."  ORDER BY number DESC LIMIT $start, $list_num";
          $result3 = mysqli_query($con, $query);
          while($row = mysqli_fetch_array($result3)) {
            echo "<tbody>";
            echo "<tr>";
            echo "<td>".$row['number']."</td>";
            echo "<td> 공지사항 </td>";
            echo "<td><a href='adm_b_view.php?idx=".$row['number']."'>".$row['Board_title']."</a></td>";
            echo "<td>".$row['user_name']."</td>";
            echo "<td>".substr($row['Board_date'],0,10)."</td>";
            echo "<td>".$row['user_views']."</td>";
            echo "<td><input type='checkbox' id='".$row['number']."'><label for=". $row['number']."></label></td>";
            echo "</tr>";
          }
        }else if($no == 2){

          $sql = "SELECT * FROM boardqnareg WHERE course_id ".($find != "" ? "AND ".$catgo." LIKE '%".$find."%' " : "")." ORDER BY number DESC LIMIT $start, $list_num";                  
          $result3 = mysqli_query($con, $sql);
            while ($row2 = mysqli_fetch_assoc($result3)) {
              echo "<tr><td>" . sprintf("%03d", $row2['number']) . "</td>";
              echo "<td>" . $row2['qna_category'] . "</td>";
              echo "<td>" . $row2['qna_title'] . "</td>";
              echo "<td>" . $row2['user_id'] . "</td>";
              echo "<td>" . substr($row2['Board_date'], 0, 10) . "</td>";
              if($row2['qna_response'] == '0') {
                echo "<td>미답변</td>";
              } else {
                echo "<td>답변완료</td>";
              }
              echo "<td><input type='checkbox' id='".$row2['number']."'><label for=". $row2['number']."></label></td>";
              echo "</tr>";
            }
        }
      ?>


      </tbody>
    </table>

    <ul id="page_nv">
      <?php 
        /* paging : 이전 페이지 */ 

        if($page <= 1){ ?> 
          <li><a href="adm_b_list.php?no=<?=$no?>&page=1">&#x003C;</a></li>
          <?php } 
          else{ ?> 
          <li><a href="adm_b_list.php?no=<?=$no?>&page=<?php echo ($page-1); ?>">&#x003C;</a></li>
          <?php };
          ?> 
      
      <?php /* pager : 페이지 번호 출력 */ 

      for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
      <li>
        <a href="adm_b_list.php?no=<?=$no?>&page=<?php echo $print_page; ?>">
          <?php echo $print_page; ?>
        </a> 
      </li>
      <?php };?> 
      <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

      <li><a href="adm_b_list.php?no=<?=$no?>&page=<?php echo $total_page; ?>">&#x003E;</a></li>
      <?php } else{ ?>
      <li><a href="adm_b_list.php?no=<?=$no?>&page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
      <?php };
      ?>
    </ul>

    <div class="btn_box">
      <button onclick="location.href='adm_b_write.php'";>게시글작성</button>
      <button>전체삭제</button>
      <button>선택삭제</button>
    </div>
  </article>
  </main>

  <script>
    $(function(){
      let page_num = <?=$page?>;
      let no = <?=$no?>;

      let tab_menu = document.querySelectorAll('#tab_mnu li');

      //사용자가 선택한 탭메뉴의 n번째에 해당서식이 변경되게 한다.
        if( no == 1 ){
          tab_menu[0].classList.add('act01');
        }else if( no == 2){
          tab_menu[1].classList.add('act01');
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
</html>