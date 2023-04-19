<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$idx = $_GET['idx'];

$query = "SELECT * FROM boardnoticereg WHERE number = '$idx'"; 
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);

$view_sql = "UPDATE boardnoticereg SET user_views = user_views + 1 WHERE number = '$idx'";
mysqli_query($con, $view_sql);
?>

<!-- board css -->
<link rel="stylesheet" href="./css/board_write.css" type="text/css">


<!-- 메인영역 -->
<main>
  <form method="post" action="tch_b_update.php?idx=<?=$idx?>">
    <section class="board-view">
        <div class="wrap d-flex justify-content-between">
            <div class="profile">
                <div class="profile__card card">
                    <div class="profile__img d-flex ratio ratio-1x1">
                        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/images/logo.png" alt="프로필 사진">
                    </div>
                    <h4 class="title">작성자</h4>
                    <input type="text" name="user_name" value="<?=$rows['user_name']?>" readonly>
                    <h4 class="title">아이디</h4>
                    <input type="text" name="user_id" value="<?=$rows['user_id']?>" readonly>
                    <a href="#" class="btn btn-100p btn-line" title="메일발송">
                        <i class="bi bi-envelope"></i>
                        메일발송
                    </a>
                    <a href="#" class="btn btn-100p btn-fill">
                        자세히 보기
                    </a>
                </div>
            </div>
            <div class="contents">
                <div class="contents__card card">
                  <input type="hidden" name="idx" value="<?=$idx?>">
                  <h4 class="title">게시판 카테고리</h4>
                  <select name="" id="">
                    <option value="1">게시판1</option>
                    <option value="2">게시판2</option>
                    <option value="3">게시판3</option>
                    <option value="4">게시판4</option>
                  </select>
                  <h4 class="title d-flex">제목 <span class="ms-auto font-normal">조회수 <?=$rows['user_views']?></span><span class="ms-2 font-normal">등록일 <?=substr($rows['Board_date'],0,10)?></span></h4>
                  <input type="text" name="title" value="<?=$rows['Board_title']?>" readonly>
                  <h4 class="title">내용</h4>
                  <div class="textarea_wrap disabled">
                    <textarea name="board_contents" id="board_contents" rows="9" readonly><?=$rows['Board_content']?></textarea>
                  </div>
                  <div class="board-btn d-flex justify-content-end">
                    <a href="javascript:history.back();" class="btn btn-fill btn-w-128">목록보기</a>
                    <button type="submit" class="btn btn-fill btn-w-128">게시글 수정</button>
                    <button type="submit" class="btn btn-line btn-w-128" formaction="delete.php">게시글 삭제</button>
                  </div>
                </div>
            </div>
        </div>
    </section>
  </form>
  <?php
    echo (mysqli_error($con));
  ?>
</main>
</body>
</html>