<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$no = $_GET['number'];

//해당 qna테이블 데이터 가져오가
$query = "SELECT * FROM boardqnareg where number ='$no'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);

//이름가져오기
$userId  =$rows['user_id'];
$sql2 = "SELECT user_name FROM userregistration WHERE user_id = '$userId'";
$result2 = mysqli_query($con, $sql2);
$rows2 = mysqli_fetch_assoc($result2);
?>

<!-- board css -->
<link rel="stylesheet" href="./css/board_write.css" type="text/css">


<!-- 메인영역 -->
<main>
  <form method="post" action="tch_b_update.php?no=<?=$no?>">
    <section class="board-view">
        <div class="wrap d-flex justify-content-between">
            <div class="profile">
                <div class="profile__card card">
                    <div class="profile__img d-flex ratio ratio-1x1">
                        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/images/logo.png" alt="프로필 사진">
                    </div>
                    <h4 class="title">작성자</h4>
                    <input type="text" name="user_name" value="<?=$rows2['user_name']?>" readonly>
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
                  <!-- <input type="hidden" name="idx" value="<?=$no?>"> -->
                  <h4 class="title d-flex justify-content-between">제목<span class="ms-2 font-normal">등록일 <?=substr($rows['Board_date'],0,10)?></span></h4>
                  <input type="text" name="title" value="<?=$rows['qna_title']?>" readonly>
                  <h4 class="title">내용</h4>
                  <div class="textarea_wrap disabled">
                    <textarea name="board_contents" id="board_contents" rows="9" readonly><?=$rows['qna_question']?></textarea>
                  </div>
                  <?php if ($rows['qna_response'] == 1): ?>
                    <h4 class="title d-flex justify-content-between">답변 <span class="ms-2 font-normal">등록일 <?=substr($rows['reply_time'],0,10)?></span></h4>
                  <div class="textarea_wrap disabled">
                    <textarea name="board_reply" id="board_reply" rows="9" readonly><?=$rows['response']?></textarea>
                  </div>
                  <?php endif; ?>
                  <div class="board-btn d-flex justify-content-end">
                    <a href="javascript:history.back();" class="btn btn-fill btn-w-128">목록보기</a>
                    <a href="./tch_b_write.php?number=<?=$rows['number']?>" class="btn btn-fill btn-w-128" <?= $rows['qna_response'] == 1 ? 'style="display: none;"' : '' ?>>답변 달기</a>
                    <a href="./tch_b_update.php?number=<?=$rows['number']?>" class="btn btn-fill btn-w-128" <?= $rows['qna_response'] == 0 ? 'style="display: none;"' : '' ?>>답변 수정</a>

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