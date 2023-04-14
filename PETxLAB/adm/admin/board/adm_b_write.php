<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";
?>

<!-- board css -->
<link rel="stylesheet" href="./css/board_write.css" type="text/css">


<!-- 메인영역 -->
<main>
  <form action="write_post.php" method="post">
    <section class="board-view">
        <div class="wrap d-flex justify-content-between">
            <div class="profile">
                <div class="profile__card card">
                    <div class="profile__img d-flex ratio ratio-1x1">
                        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/images/logo.png" alt="프로필 사진">
                    </div>
                    <h4 class="title">작성자</h4>
                    <p>작성자명</p>
                    <h4 class="title">아이디</h4>
                    <p>작성자아이디</p>
                    <a href="#" class="btn btn-100p btn-line">
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
                  <h4 class="title">게시판 카테고리</h4>
                  <select name="" id="">
                    <option value="1">게시판1</option>
                    <option value="2">게시판2</option>
                    <option value="3">게시판3</option>
                    <option value="4">게시판4</option>
                  </select>
                  <h4 class="title">제목</h4>
                  <input type="text" name="title">
                  <h4 class="title">내용</h4>
                  <div class="textarea_wrap">
                    <textarea name="board_contents" id="board_contents" rows="9"></textarea>
                  </div>
                  <div class="board-btn d-flex justify-content-end">
                    <a href="#" class="btn btn-fill btn-w-128">목록보기</a>
                    <button type="submit" class="btn btn-fill btn-w-128">게시글 등록</button>
                    <button type="reset" class="btn btn-line btn-w-128">작성 취소</button>
                  </div>
                </div>
            </div>
        </div>
    </section>
  </form>
</main>
</body>
</html>