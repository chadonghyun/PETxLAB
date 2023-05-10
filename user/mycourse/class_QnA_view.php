<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $no = $_GET['number'];
  $query = "SELECT * FROM boardqnareg where number ='$no'";

  $result = mysqli_query($con, $query);
  $rows =mysqli_fetch_assoc($result);

?>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_QnA_view.css" type="text/css">

<main>
  <form action="" method="post">
    <div class="wrap">
      <h3 class="vw_title">제목</h3>
      <?php?><span class="regist_date">등록일 : <?=date('Y-m-d', strtotime($rows['Board_date'])); ?></span>
      <div class="vw_in">
        <input type="text" placeholder="제목을 적어주세요." name="QnA_title" id="QnA_title" value="<?=$rows['qna_title']?>" readonly>
        <span class="<?=$rows['qna_response'] == 1 ? 'com' : 'fal'; ?>">
          <?=$rows['qna_response'] == 1 ? '해결' : '미해결'; ?>
        </span>
      </div>
      <h3 class="wr_content">내용</h3>
      <textarea name="QnA_con" id="QnA_con" rows="20" placeholder="질문 내용을 적어주세요." readonly><?=$rows['qna_question']?></textarea>
      <?php if ($rows['qna_response'] == 1): ?>
      <div class="response_view">
        <h3 class="reply_title">댓글</h3>
        <textarea name="reply" id="reply" rows="10" class="reply" readonly></textarea>
      </div>
      <?php endif; ?>
      <a href= "./class_QnA_list.php?no=1" class="list_view">목록보기</a>
      <a href= "./class_QnA_update.php?number=<?=$rows['number'] ?>" class="list_update">게시글 수정</a>
      <button type="submit" formaction="delete.php" onclick="return post();" class="del_post">게시글 삭제</button>
    </div>
  </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>