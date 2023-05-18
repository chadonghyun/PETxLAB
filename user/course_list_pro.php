<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

    $cate = empty($_GET['cate']) ? '반려동물 전문창업' : $_GET['cate'];
    $find=empty($_GET['find']) ? '' : $_GET['find'];

    $list_sql = "SELECT * FROM coursereg WHERE course_category = '$cate'";
    $list_sql .= ($find != "" ? "AND course_title LIKE '%".$find."%' " : "");
    $list_sql .= "ORDER BY course_id DESC";
    
    $result = mysqli_query($con, $list_sql);
    $num = mysqli_num_rows($result);

    $list_num = 10;
    $page_num = 5;
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $total_page = ceil($num / $list_num);
    $total_block = ceil($total_page / $page_num);
    $now_block = ceil($page / $page_num);
    $s_pageNum = ($now_block - 1) * $page_num + 1;
    // $s_oageNum = ($now_block -1) * $page_num +1;
    if($s_pageNum <= 0){$s_pageNum = 1;};
    $e_pageNum = $now_block * $page_num;
    if($e_pageNum > $total_page){$e_pageNum = $total_page;};

    $start = ($page - 1) * $list_num;
    
    $sql2 = "SELECT * FROM coursereg WHERE course_category = '$cate'";
    $sql2.= ($find != "" ? "AND course_title LIKE '%".$find."%' " : "");
    $sql2.= " ORDER BY course_id DESC limit $start, $list_num;";

    $result = mysqli_query($con, $sql2);
    $cnt = $start + 1;
    
    $i =  $num - (($page-1)*10);


?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/css/course_list.css" type="text/css">

<main>
    <h2>
        전문교육과정
    </h2>
    <form action="" method="get">
        <div class="sub_title">
            <h3>
                <?=$cate?>
            </h3>

            <nav id="cate">
                <ul>
                    <li>
                        <a href="./course_list_pro.php?cate=반려동물 전문창업">반려동물 전문창업</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=반려동물 행동교정사">반려동물 행동교정사</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=반려동물 식품관리사">반려동물 식품관리사</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=펫 유치원 교원사">펫 유치원 교원사</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=펫 뷰티션">펫 뷰티션</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=반려동물장례코디네이터">반려동물장례코디네이터</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=반려동물관리사">반려동물관리사</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=동물병원코디네이터">동물병원코디네이터</a>
                    </li>
                    <li>
                        <a href="./course_list_pro.php?cate=펫시터">펫시터</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="search_area d-flex">
            <p>총 <?=$num?>건</p>
            <div class="search_box">
                <input type="search" name="find" value="<?=$find?>" id="course_search" placeholder="검색어 입력">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </form>
    <form action="" method="post">
        <ul class="course_list">
            <?php
                while ($row = mysqli_fetch_array($result)){
            ?>
            <li class="card d-flex justify-content-between">
                <div class="course_thumb">
                    <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/adm/teacher/lecture/uploads/<?=$row['course_image']?>" alt="<?=$row['course_title']?>">
                </div>
                <div class="course_desc d-flex">
                    <span class="course_cate" style="text-decoration:none;">
                        전문교육과정
                    </span>
                    <h3 class="course_title text-truncate"><?= $row['course_title'] ?></h3>
                    <p class="progress_txt w-100">
                        등록일: <?=$row['course_startday']?>
                    </p>
                    <a href="./course_view.php?idx=<?=$row['course_id']?>" class="detail_btn ms-auto mt-auto" title="강의 바로가기">바로가기</a>
                </div>
            </li>
            <?php } ?>
        </ul>

        <ul id="page_nv">
            <?php 
            /* paging : 이전 페이지 */ 

            if($page <= 1){ ?> 
            <li><a href="course_list_pro.php?cate=<?=$cate?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=1">&#x003C;</a></li>
            <?php } 
            else{ ?> 
            <li><a href="course_list_pro.php?cate=<?=$cate?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo ($page-1); ?>">&#x003C;</a></li>
            <?php };
            ?> 
        
            <?php /* pager : 페이지 번호 출력 */ 

            for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?> 
            <li>
            <a href="course_list_pro.php?cate=<?=$cate?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo $print_page; ?>">
                <?php echo $print_page; ?>
            </a> 
            </li>
            <?php };?> 
            <?php /* paging : 다음 페이지 */ if($page >= $total_page){ ?> 

            <li><a href="course_list_pro.php?cate=<?=$cate?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo $total_page; ?>">&#x003E;</a></li>
            <?php } else{ ?>
            <li><a href="course_list_pro.php?cate=<?=$cate?><?php if(isset($_GET["find"])) print ('&find='.$_GET["find"]); ?>&page=<?php echo ($page+1); ?>">&#x003E;</a></li> 
            <?php };
            ?>
        </ul>

    </form>
</main>

<script>
    $(function(){
      let page_num = <?=$page?>;
      let tab_menu = document.querySelectorAll('#tab_mnu li');


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
    let cate = document.querySelector('.sub_title');

    cate.addEventListener('click', function(){
        this.classList.toggle('click');
    })
  </script>


<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>