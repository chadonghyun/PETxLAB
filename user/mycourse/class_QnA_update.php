<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

$no = $_GET['number'];
$query = "SELECT * FROM boardqnareg WHERE number ='$no'";

$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $qna_title = $_POST["QnA_title"];
  $qna_question = $_POST["QnA_con"];

  $sql = "UPDATE boardqnareg SET qna_title='$qna_title', qna_question='$qna_question', Board_date = CURRENT_TIMESTAMP WHERE number = '$no'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    ?>
    <script>
      alert('게시글이 수정되었습니다.');
      location.replace('./class_QnA_list.php?no=1');
    </script>
    <?php
  } else {
    echo (mysqli_error($con));
  }
}

?>


<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_QnA_update.css" type="text/css">

<main>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="number" value="<?=$no?>">
    <div class="wrap">
      <h3 class="vw_title">제목</h3>
      <span class="regist_date">등록일 : <?=date('Y-m-d', strtotime($rows['Board_date'])); ?></span>
      <div class="vw_in">
        <span class="<?=$rows['qna_response'] == 1 ? 'com' : 'fal'; ?>">
          <?=$rows['qna_response'] == 1 ? '해결' : '미해결'; ?>
        </span>
        <input type="text" placeholder="제목을 적어주세요." name="QnA_title" id="QnA_title" value="<?=$rows['qna_title']?>">
      </div>
      <h3 class="wr_content">내용</h3>
      <textarea name="QnA_con" id="QnA_con" rows="20" placeholder="질문 내용을 적어주세요."><?=$rows['qna_question']?></textarea>
      <a href="./class_QnA_list.php?no=1" class="list_view">목록보기</a>
      <button type="submit" class="list_edit">게시글 수정 완료</button>
      <button type="button" onclick="deletePost()" class="del_post">게시글 삭제</button>
    </div>
 

  </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>