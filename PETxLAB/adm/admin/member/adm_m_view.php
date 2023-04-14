<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";
?>

<!-- board css -->
<link rel="stylesheet" href="./css/member_view.css" type="text/css">


<!-- 메인영역 -->
<main>
  <form action="write_post.php" method="post">
    <section class="board-view">
        <div class="wrap d-flex justify-content-between">
            <div class="profile">
                <select name="" id="" class="card level">
                    <option>회원 분류</option>
                    <option value="1">관리자</option>
                    <option value="2">강사</option>
                    <option value="3">수강생</option>
                </select>
                <div class="profile__card card">
                    <div class="profile__img d-flex ratio ratio-1x1">
                        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/images/logo.png" alt="프로필 사진">
                    </div>
                    <h4 class="title">회원번호</h4>
                    <p>00001</p>
                    <h4 class="title">회원등급</h4>
                    <p>1등급 한우</p>
                    <h4 class="title">이름</h4>
                    <p>이름</p>
                    <h4 class="title">아이디</h4>
                    <p>아이디</p>
                    <a href="#" class="btn btn-100p btn-line">
                        <i class="bi bi-envelope"></i>
                        메일발송
                    </a>
                </div>
            </div>
            <div class="contents d-flex justify-content-between">
                <div class="contents__card card">
                  <h4 class="title">휴대전화</h4>
                  <input type="text" name="phone">
                  <h4 class="title">이메일</h4>
                  <input type="text" name="email">
                  <div class="d-flex justify-content-between">
                    <div class="half-box">
                        <h4 class="title">접속일</h4>
                        <input type="text" name="email">
                    </div>
                    <div class="half-box">
                        <h4 class="title">가입일</h4>
                        <input type="text" name="email">
                    </div>
                  </div>
                  
                  <h4 class="title d-inline-block">수강중인 리스트  <span class="font-normal">2건</span></h4>
                  <div class="data_wrap">
                      <ul>
                          <li>
                            리스트1
                          </li>
                          <li>
                            리스트2
                          </li>
                      </ul>
                  </div>

                  <h4 class="title d-inline-block">수강완료 리스트  <span class="font-normal">2건</span></h4>
                  <div class="data_wrap">
                      <ul>
                          <li>
                            리스트1
                          </li>
                          <li>
                            리스트2
                          </li>
                      </ul>
                  </div>

                </div>
                
                
                <div class="contents__card card d-flex">
                  <h4 class="title">비고사항</h4>
                  <div class="data_wrap">
                    <textarea name="board_contents" id="board_contents"></textarea>
                  </div>
                  <button type="submit" class="btn btn-fill btn-w-128 ms-auto mt-0">게시글 등록</button>
                </div>
            </div>
        </div>
    </section>
  </form>
</main>
</body>
</html>