<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

$qna_category = $_GET['qna_category'];
$course_id = $_GET['no'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $qna_title = $_POST["QnA_title"];
  $qna_question = $_POST["QnA_con"];

  $sql = "INSERT INTO boardqnareg (qna_title, qna_question, course_id, qna_category, user_id) 
          VALUES ('$qna_title', '$qna_question', '$course_id', '$qna_category', '$user_id')";

  $result = mysqli_query($con, $sql);

  if ($result) {
    ?>
    <script>
      alert('게시글이 작성되었습니다.');
      location.replace('./class_QnA_list.php?no=1');
    </script>
    <?php
  } else {
    echo mysqli_error($con);
  }
}
?>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_QnA_write.css" type="text/css">

<main>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="wrap">
      <h3 class="wr_title">제목</h3>
      <input type="text" placeholder="제목을 적어주세요." name="QnA_title" id="QnA_title">
      <h3 class="wr_content">내용</h3>
      <textarea name="QnA_con" id="QnA_con" rows="20" placeholder="질문 내용을 적어주세요."></textarea>
      <a href= "./class_QnA_list.php" class="list_view">목록보기</a>
      <input type=submit class="post" id="post" value="게시글 등록">
      <button type="reset" class="del_post">작성 취소</button>
    </div>
  </form>
</main>

<?php
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>