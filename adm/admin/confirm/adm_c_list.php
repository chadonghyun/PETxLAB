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
  <link rel="stylesheet" type="text/css" href="./css/adm_c_list.css">
  <script src="./js/adm_c_list.js" defer></script>

  <article id="main_h">
    <ul id="tab_mnu">
      <li><a href="adm_c_list.php?no=3">전체리스트</a></li>
      <li><a href="adm_c_list.php?no=2">승인리스트</a></li>
      <li><a href="adm_c_list.php?no=1">미승인리스트</a></li>
    </ul>

    <div id="search_wrap">
      <form action="adm_c_list.php" method="get" >
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
          <th>No</th>
          <th>신청번호</th>
          <th>과정ID</th>
          <th>강의명</th>
          <th>이름(아이디)</th>
          <th>신청일자</th>
          <th>결제상태</th>
          <th>승인여부</th>
          <th>
            <input type="checkbox" id="check1" onclick='selectAll(this)'>
            <label for="check1"></label>
          </th>
        </tr>
      </thead>

      <?php
          if($no == 1){
            $sql = "select * from user_course where confirm = 0 order by user_course_id desc";
          }else if($no == 2){
            $sql = "select * from user_course where confirm = 1 order by user_course_id desc";
          }else if($no == 3){
            $sql = "select * from user_course order by user_course_id desc";
          }
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
          
            if($no == 1){
              $sql2 = "select * from user_course where confirm = 0 ".($find != "" ? "AND ".$catgo." LIKE '%".$find."%' " : "")." order by user_course_id desc limit $start, $list_num;";
            }else if($no == 2){
              $sql2 = "select * from user_course where confirm = 1 ".($find != "" ? "AND ".$catgo." LIKE '%".$find."%' " : "")." order by user_course_id desc limit $start, $list_num;";
            }else if($no == 3){
              $sql2 = "select * from user_course ".($find != "" ? "WHERE ".$catgo." LIKE '%".$find."%' " : "")." order by user_course_id desc limit $start, $list_num;";
            }
          $result = mysqli_query($con, $sql2);
          $cnt = $start + 1;

          
          $i =  $num - (($page-1)*10);
      ?>
      

      <tbody>
        <?php while ($row = mysqli_fetch_array($result)){?>
          
        <tr>
          <td><?php
            echo $i;
            $i--;
          ?></td>
          <td><?=$row['user_course_id']?></td>
          <td><?=$row['course_id']?></td>
          <td><?=$row['course_title']?></td>
          <td><?=$row['user_name']?>(<?=$row['user_id']?>)</td>
          <td><?=$row['created_at'] ? date('Y-m-d', strtotime($row['created_at'])) : ''?></td>
          <td>
            <?php
              if ($row['payment'] == 1) {
            ?>
                <span>결제완료</span>
            <?php
              } else {
            ?>
                <span>결제전</span>
            <?php
              }
            ?>
          </td>
          <td>
            <?php
              if ($row['confirm'] == 1) {
            ?>
                <span class="confirm confirm_txt">승인완료</span>
            <?php
              }else{
            ?>    
                <button type="submit" formaction="update_confirm.php" name="user_course_id" value="<?=$row['user_course_id']?>" class="confirm confirm_btn">승인하기</button>
            <?php    
              }
            ?>
          </td>
          <td>
            <input type="checkbox" id="<?=$row['user_course_id']?>" value="<?=$row['user_course_id']?>" name="checked[]">
            <label for="<?=$row['user_course_id']?>"></label>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <ul id="page_nv">
      <?php 
        /* paging : 이전 페이지 */ 

        if($page <= 1){ ?> 
        <li><a href="adm_m_list.php?no=<?=$no?>&page=1">&#x003C;</a></li>
        <?php } 
        else{ ?> 
        <li><a href="adm_m_list.php?no=<?=$no?>&page=<?php echo ($page-1); ?>">&#x003C;</a></li>
        <?php };
        ?> 
      
        <?php /* pager : 페이지 번호 출력 */ 

        for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
        <li>
          <a href="adm_m_list.php?no=<?=$no?>&page=<?php echo $print_page; ?>">
            <?php echo $print_page; ?>
          </a> 
        </li>
        <?php };?> 
        <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

        <li><a href="adm_m_list.php?no=<?=$no?>&page=<?php echo $total_page; ?>">&#x003E;</a></li>
        <?php } else{ ?>
        <li><a href="adm_m_list.php?no=<?=$no?>&page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
        <?php };
        ?>
    </ul>
    
    <div class="btn_box">
      <button type="submit" formaction="mailto.php" onclick="return post();">선택승인취소</button>
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


      // function autoIncrement(startnum){
      // let init = startnum;

      // let td_list = document.getElementsByClassName("autoInc");
      //   for(let i = 0; i < td_list.length; i++){
      //     init++;
      //     td_list[i].innerHTML = "&nbsp" + init;
      //   }};
      //   autoIncrement(0);
    });
  </script>
</body>
</html>