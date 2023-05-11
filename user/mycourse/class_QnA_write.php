<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";
?>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_QnA_write.css" type="text/css">

<main>
  <form action="" method="post">
    <div class="wrap">
      <h3 class="wr_title">제목</h3>
      <input type="text" placeholder="제목을 적어주세요." name="QnA_title" id="QnA_title">
      <h3 class="wr_content">내용</h3>
      <textarea name="QnA_con" id="QnA_con" rows="20" placeholder="질문 내용을 적어주세요."></textarea>
      <a href= "./class_QnA_list.php" class="list_view">목록보기</a>
      <input type=submit class="post" id="post" value="게시글 등록">
      <button type="submit" formaction="delete.php" onclick="return post();" class="del_post">작성 취소</button>
    </div>
  </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>