<?php

include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$no = $_GET['course_id'];
$query = "SELECT * FROM CourseReg where course_id ='$no'";

$result = mysqli_query($con, $query);
$rows =mysqli_fetch_assoc($result);


?>

<main>
  <!-- adm_l_update.css -->
  <link rel="stylesheet" href="./css/tch_l_print.css" type="text/css">
  <!-- 스크립트 -->
  <script src="./js/adm_l_print.js" defer></script>

  <section id="lecreg">
    <form method="post" action="tch_l_update.php?course_id=<?=$no?>">
      <div class="container wrap d-flex justify-content-between">
        <!-- 좌측박스 -->
        <div class="profile">
          <div class="profile__card card">
            <div class="profile__img d-flex ratio ratio-1x1">
              <img src= "<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/images/logo.png" alt="mainlogo">
            </div>
            <h4 class="title">작성자</h4>
            <input type="text" value="<?php echo "$username"?>" name="user_name" class="writer" readonly>
            <h4 class="title">아이디</h4>
            <input type="text" value="<?php echo "$userid"?>" name="user_id" class="id" readonly>

            <!-- 삭제 버튼 -->

            <input type="hidden" name="course_id" value="<?=$no?>">
            <button type="submit" class="edit">강의수정</button>
            <button type="submit" formaction="tch_l_delete.php" class="delete">강의삭제</button>
          </div>
        </div>
        <!-- 우측박스 -->
        <div class="lecreg-contents">
          <div class="lecreg-detail card">
            <div class="row">
              <div class="col-md-6 lecreg-leftbox">
                <div>
                  <label for="course_type">과정분류</label>
                  <input type="text" id="course_type" name="course_type" class="form-control"
                      value="<?php
                      if($rows['course_type']=='professional'){echo"전문교육과정";}
                      else {echo "일반교육과정";} ?>" readonly>              
                </div>
                <div>
                <label for="course_category">카테고리</label>
                      <input type="text" name="course_caregory" id="course_caregory" class="form-control" 
                      value="<?=$rows['course_category']?>" readonly>                  
                </div>
                <div class="titlebox">
                  <label for="course_title">강좌제목</label>
                  <input type="text" name="course_title" id="course_title" class="form-control" value="<?=$rows['course_title']?>" readonly>
                  <a href="#" title="바로가기">강의바로가기</a>                        
                </div>
                <div class="flex">
                  <div>
                    <label for="course_startday">강의 시작일</label>
                    <input type="text" id="course_startday" class="course_startday" name="course_startday" class="form-control" value="<?=$rows['course_startday']?>" readonly>  
                  </div>
                  <div>
                    <label for="course_endday">강의 종료일</label>
                    <input type="text" id="course_endday" class="course_endday" name="course_endday" class="form-control" value="<?=$rows['course_endday']?>" readonly>                     
                  </div>                  
                </div>
                <div>
                  <label for="course_duration">강의 기간</label>
                  <input type="text" id="course_duration" name="course_duration" class="form-control" value="<?=$rows['course_duration']?>" readonly>                  
                </div>

              </div>
              <div class="col-md-6 lecreg-rightbox">
                <div>
                  <label for="course_price">강의금액</label>
                  <input type="text" name="course_price" id="course_price" class="form-control" value="<?=$rows['course_price']?>" readonly>                  
                </div>
                <div class="form-group">
                  <label for="course-image">대표이미지</label>
                  <div class="custom-file">
                    <input type="text" class="custom-file-input" id="course-image" name="course-image" value="파일명: <?=$rows['course_image']?>" readonly>
                    <div class="imagebox">
                      <img src="./uploads/<?=$rows['course_image']?>" alt="upload_image">
                    </div>
                  </div>                 
                </div>
                <div>
                  <label for="course_shortdesc">짧은설명</label>
                  <input type="text" name="course_shortdesc" id="course_shortdesc" class="form-control" value="<?=$rows['course_shortdesc']?>" readonly>                  
                </div>
              </div>
              <div class="col-md-12 lecreg-desc card">
                  <label for="course_longdesc">상세설명</label>
                  <textarea name="course_longdesc" id="course_longdesc" class="course_longdesc" rows="10" readonly><?=$rows['course_longdesc']?></textarea>
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</main>