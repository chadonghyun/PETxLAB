<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/PETxLAB/config.php');
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

?>

<!-- 메인영역 -->
<main>
  <!-- adm_m_list.css -->
  <link rel="stylesheet" type="text/css" href="./css/adm_m_list.css">
  <script src="./js/adm_m_list.js" defer></script>

  <article id="main_h">
    <ul id="tab_mnu">
      <li><a href="adm_m_list.php?no=3">회원관리</a></li>
      <li><a href="adm_m_list.php?no=2">강사관리</a></li>
      <li><a href="adm_m_list.php?no=1">수강생관리</a></li>
    </ul>

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
          <th>No</th><th>회원번호</th><th>분류</th><th>이름(아이디)</th><th>휴대전화</th><th>이메일</th><th>수강</th><th>접속일</th><th>가입일</th><th>메일발송</th><th><input type="checkbox" id="check1" onclick='selectAll(this)'><label for="check1"></label></th>
        </tr>
      </thead>

      <?php
      $no=$_GET['no'];

        if($no == 1){
          $sql = "select * from userregistration where user_level = 1 order by number desc";
        }else if($no == 2){
          $sql = "select * from userregistration where user_level = 2 order by number desc";
        }else if($no == 3){
          $sql = "select * from userregistration order by number desc";
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
            $sql2 = "select * from userregistration where user_level = 1 order by number desc limit $start, $list_num;";
          }else if($no == 2){
            $sql2 = "select * from userregistration where user_level = 2 order by number desc limit $start, $list_num;";
          }else if($no == 3){
            $sql2 = "select * from userregistration order by number desc limit $start, $list_num;";
          }
        $result = mysqli_query($con, $sql2);
        $cnt = $start + 1;
      ?>
      

      <tbody>
        <?php while ($row = mysqli_fetch_array($result)){?>
          
        <tr>
          <td><?=$row['number']?></td>
          <td><?=$row['number']?></td>
          <td><?php
            if ($row['user_level'] == 1) {
              echo "수강생";
            } else if ($row['user_level'] == 2) {
              echo "강사";
            } else if ($row['user_level'] == 3) {
              echo "관리자";
            }
          ?></td>
          <td><?=$row['user_name']?></td>
          <td><?=$row['user_phone']?></td>
          <td><?=$row['user_email']?></td>
          <td>2</td>
          <td>20</td>
          <td><?=$row['reg_date'] ? date('Y-m-d', strtotime($row['reg_date'])) : ''?></td>
          <td><i class="bi bi-envelope"></i></td>
          <td><input type="checkbox" id="<?=$row['number']?>"><label for="<?=$row['number']?>"></label></td>
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
    
    <button><i class="bi bi-envelope"></i> 전체발송</button>
    <button><i class="bi bi-envelope"></i> 선택발송</button>
  </article>
  </main>

  <script>
    let url = window.location.href;
    url = url.split('=');
    console.log(url[1]);
    let page_num = url - 1;

    let pagination_item = document.querySelectorAll('#page_nv > li');

    console.log(pagination_item[4]);



    if(page_num == 0){
      pagination_item[4].addClass('active');
    }else{
      pagination_item[page_num].addClass('active');
    }

  </script>
</body>
</html>