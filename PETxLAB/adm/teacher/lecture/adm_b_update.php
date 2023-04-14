<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";
?>
    <main>
    <!-- adm_l_update.css -->
    <link rel="stylesheet" href="./css/adm_l_update.css">
      <!-- flatpicker 라이브러리 추가 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <!-- 스크립트 -->
    <script src="./js/thc_b_update.js" defer></script>
    
    <section id="lecreg">
    <form action="post">
      <div class="container wrap d-flex justify-content-between">
        <!-- 좌측 박스-->
        <div class="profile">
          <div class="profile__card card">
            <div class="profile__img d-flex ratio ratio-1x1">
              <img src="./images/logo.png" alt="프로필 사진">
            </div>
            <h4 class="title">작성자</h4>
            <p>작성자명</p>
            <h4 class="title">아이디</h4>
            <p>작성자아이디</p>
              <a href="#" class ="btn btn-100p btn-line">
                강의등록
              </a>
            <!-- <a href="#" class="btn btn-100p btn-fill">
              등록취소
            </a> -->
            <input type="reset" value="리셋"></input>
          </div>
        </div>

        <!-- 우측박스 -->
        <div class="lecreg-contents">
          <div class="lecreg-detail card">

              <div class="row">
                  <div class="col-md-6 lecreg-leftbox">
                    <div>
                      <label for="course_id">과정ID</label>
                      <input type="text" id="course_id" name="course_id" class="form-control" readonly>
                      <label for="course_type">과정분류</label>
                      <select name="course_type" id="course_type" class="course_type form-control" onchange="course(this)" required>
                        <option>선택하세요</option>
                        <option value="professional">전문교육과정</option>
                        <option value="general">일반교육과정</option>
                      </select>
                    </div>
                    <div>
                      <label for="course_title">강좌제목</label>
                      <input type="text" name="course_title" id="course_title" class="form-control" required>
                    </div>
                    <div>
                      <label for="course_category">카테고리</label>
                      <select name="course_category" id="course_category" class="form-control">
                        <option>선택하세요</option>
                      </select>
                    </div>
                    <div>
                      <label for="course_startday">강의 시작일</label>
                      <input type="text" id="course_startday" name="course_startday" class="form-control" readonly>  
                      <label for="course_endday">강의 종료일</label>
                      <input type="text" id="course_endday" name="course_endday" class="form-control" readonly>                    
                      <label for="course_duration">강의 기간</label>
                      <input type="text" id="course_duration" name="course_duration" class="form-control" readonly>               
                    </div>
                  </div>
                  <div class="col-md-6 lecreg-rightbox">
                    <div>
                      <label for="course_price">강의금액</label>
                      <input type="text" name="course_price" id="course_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="course-image">강의 이미지 업로드</label>
                      <div class="custom-file">
                        <label class="custom-file-label" for="course-image" id="image-label"></label>
                        <input type="file" class="custom-file-input" id="course-image" name="course-image">
                      </div>
                      <div id="image-preview"></div>
                      <button type="button" class="btn btn-primary" id="update-image-btn">이미지 업데이트</button>
                    </div>
                    <div>
                      <label for="course_shortdesc">짧은설명</label>
                      <input type="text" name="course_shortdesc" id="course_shortdesc" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-12 lecreg-desc card">
                    <label for="course_longdesc">상세설명</label>

                    <textarea name="course_longdesc" id="course_longdesc"rows="10"></textarea>
                  </div>
              </div>    

          </div>
        </div>
      </div>
    </form>  
    </section>  

    </main>
  </body>
</html>