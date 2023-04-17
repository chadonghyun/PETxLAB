<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$idx = $_GET['idx'];
$query = "SELECT * FROM boardnoticereg WHERE number = '$idx'"; 

$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);


$user_query = "SELECT userregistration.user_email FROM userregistration JOIN boardnoticereg ON userregistration.user_id = boardnoticereg.user_id WHERE boardnoticereg.number = '$idx'";

$result2 = mysqli_query($con, $user_query);
$rows2 = mysqli_fetch_assoc($result2);



?>

<!-- board css -->
<link rel="stylesheet" href="./css/board_write.css" type="text/css">


<!-- 메인영역 -->
<main>
  <form method="post" action="update_post.php">
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
                    <a href="mailto:<?=$rows2['user_email']?>" class="btn btn-100p btn-line" title="메일발송">
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
                  <h4 class="title">제목</h4>
                  <input type="text" name="title" value="<?=$rows['Board_title']?>">
                  <h4 class="title">내용</h4>
                  <div class="textarea_wrap">
                    <textarea name="board_contents" id="board_contents" rows="9"><?=$rows['Board_content']?></textarea>
                  </div>
                  <div class="board-btn d-flex justify-content-end">
                    <a href="./adm_b_list.php" class="btn btn-fill btn-w-128">목록보기</a>
                    <button type="submit" class="btn btn-fill btn-w-128">게시글 수정</button>
                    <button type="reset" class="btn btn-line btn-w-128" formaction="delete.php">게시글 삭제</button>
                  </div>
                </div>
            </div>
        </div>
    </section>
  </form>
</main>
</body>
</html>