<?php

include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$no = $_GET['course_id'];
$query = "SELECT * FROM coursereg where course_id ='$no'";

$result = mysqli_query($con, $query);
$rows =mysqli_fetch_assoc($result);

$user_query = "SELECT userregistration.user_name FROM userregistration JOIN coursereg ON userregistration.user_id = coursereg.user_id WHERE coursereg.course_id='$no'";

$result2 = mysqli_query($con,$user_query);
$row2 = mysqli_fetch_assoc($result2); 
?>

<main>
  <!-- adm_l_update.css -->
  <link rel="stylesheet" href="./css/tch_l_print.css" type="text/css">
        <!-- flatpicker 라이브러리 추가 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
  <!-- 스크립트 -->
  <script src="./js/adm_l_update.js" defer></script>

  <section id="lecreg">
    <form method="post" action="" enctype="multipart/form-data">
      <div class="container wrap d-flex justify-content-between">
        <!-- 좌측박스 -->
        <div class="profile">
          <div class="profile__card card">
            <div class="profile__img d-flex ratio ratio-1x1">
              <img src= "<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/images/logo.png" alt="mainlogo">
            </div>
            <h4 class="title">작성자</h4>
            <input type="text" value="<?=$row2['user_name']?>" name="user_name" class="writer" readonly>
            <h4 class="title">아이디</h4>
            <input type="text" value="<?=$rows['user_id']?>" name="user_id" class="id" readonly>

            <!-- 삭제 버튼 -->

            <input type="hidden" name="course_id" value="<?=$no?>">
            
            <button type="submit" formaction="tch_l_edit.php" class="edit">수정완료</button>

            <!-- <input type="reset" class="delete_all" value="강의삭제"></input> -->
          </div>
        </div>
        <!-- 우측박스 -->
        <div class="lecreg-contents">
          <div class="lecreg-detail card">
            <div class="row">
              <div class="col-md-6 lecreg-leftbox">
                <div>
                  <label for="course_type">과정분류</label>
                  <select name="course_type" id="course_type" class="course_type form-control" onchange="course(this)" required>
                    <option value="<?php
                      if($rows['course_type']=='professional'){echo"전문교육과정";}
                      else {echo "일반교육과정";} ?>">선택하세요</option>
                    <option value="professional">전문교육과정</option>
                    <option value="general">일반교육과정</option>
                  </select>                  
            
                </div>
                <div>
                <label for="course_category">카테고리</label>
                      <select name="course_category" id="course_category" class="form-control">
                        <option value="<?=$rows['course_category']?>">선택하세요</option>
                      </select>
                
                </div>
                <div class="titlebox">
                  <label for="course_title">강좌제목</label>
                  <input type="text" name="course_title" id="course_title" class="form-control" value="<?=$rows['course_title']?>" >
                                      
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
                  <input type="number" name="course_price" id="course_price" class="form-control" value="<?=$rows['course_price']?>" >                  
                </div>
                <div class="form-group">
                  <label for="course-image">대표이미지</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="course-image" name="course-image">
                    <!-- <div class="imagebox"><img src="./uploads/<?=$rows['course_image']?>" alt="upload_image"></div> -->
                    <div id="image-preview"></div> 
                  </div>                 
                </div>
                <div>
                  <label for="course_shortdesc">짧은설명</label>
                  <input type="text" name="course_shortdesc" id="course_shortdesc" class="form-control" value="<?=$rows['course_shortdesc']?>" >                  
                  </div>
                </div>
              </div>
            </div>   
              <div class="col-md-12 lecreg-desc card">
                  <label for="course_longdesc">상세설명</label>
                  <textarea name="course_longdesc" id="course_longdesc" class="course_longdesc" rows="10"><?=$rows['course_longdesc']?></textarea>
                </div>
            </div>
          </div>

    </form>
  </section>
</main>