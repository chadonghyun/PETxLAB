<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";
?>
    <main>
    <!-- adm_l_update.css -->
    <link rel="stylesheet" href="./css/adm_l_write.css">
      <!-- flatpicker 라이브러리 추가 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <!-- 스크립트 -->
    <script src="./js/adm_l_write.js" defer></script>
    
    <section id="lecreg">
    <form action="adm_l_insert.php" method="post" enctype="multipart/form-data">
      <div class="container wrap d-flex justify-content-between">
        <!-- 좌측 박스-->
        <div class="profile">
          <div class="profile__card card">
            <div class="profile__img d-flex ratio ratio-1x1">
              <img src= "<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/images/logo.png" alt="mainlogo">
            </div>
            <h4 class="title">작성자</h4>
            <p>작성자명</p>
            <h4 class="title">아이디</h4>
            <p>작성자아이디</p>

            <input type="submit" name="action" id="save_frm" value="강의등록" class="save_frm">
            <input type="reset" value="등록취소" class="delete_all">
          </div>
        </div>

        <!-- 콘텐츠 내용 -->
        <div class="lecreg-contents">
          <div class="lecreg-detail card">

              <div class="row">
                  <div class="col-md-6 lecreg-leftbox">
                    <div>
                      <label for="course_type">과정분류</label>
                      <select name="course_type" id="course_type" class="course_type form-control" onchange="course(this)" required>
                        <option>선택하세요</option>
                        <option value="professional">전문교육과정</option>
                        <option value="general">일반교육과정</option>
                      </select>
                    </div>
                    <div>
                      <label for="course_category">카테고리</label>
                      <select name="course_category" id="course_category" class="form-control">
                        <option>선택하세요</option>
                      </select>
                    </div>
                    <div>
                      <label for="course_title">강좌제목</label>
                      <input type="text" name="course_title" id="course_title" class="form-control" required>
                    </div>
                    <div class="flex">
                      <div class="position-relative">
                        <label for="course_startday">강의 시작일</label>
                        <i class="bi bi-calendar-check"></i>
                        <input type="text" id="course_startday" name="course_startday" class="form-control" readonly>  
                      </div>

                      <div class="position-relative">
                        <label for="course_endday">강의 종료일</label>
                        <i class="bi bi-calendar-check"></i>
                        <input type="text" id="course_endday" name="course_endday" class="form-control" readonly>                    
                      </div>

                    </div>
                      <label for="course_duration">강의 기간</label>
                      <input type="text" id="course_duration" name="course_duration" class="form-control" readonly>               
                  </div>
                  <div class="col-md-6 lecreg-rightbox">
                    <div>
                      <label for="course_price">강의금액</label>
                      <input type="number" name="course_price" id="course_price" class="form-control" required>
                    </div>

                    <!-- 이미지 파일로 다운로드 받기 -->

                    <div class="form-group">
                      <label for="course-image">대표이미지</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="course-image" name="course-image">
                        <div id="image-preview"></div>
                      </div>
                      
                    </div>
                    <div>
                      <label for="course_shortdesc">짧은설명</label>
                      <input type="text" name="course_shortdesc" id="course_shortdesc" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-12 lecreg-desc card">
                    <label for="course_longdesc">상세설명</label>

                    <textarea name="course_longdesc" id="course_longdesc"rows="10" class="course_longdesc"></textarea>
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