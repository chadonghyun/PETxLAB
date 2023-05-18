<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$no = $_GET['no'];
$query = "SELECT * FROM userregistration WHERE number = '$no'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);

$user_id = $rows['user_id'];

?>

<!-- board css -->
<link rel="stylesheet" href="./css/member_view.css" type="text/css">


<!-- 메인영역 -->
<main>
  <form action="update_post.php" method="post">
    <section class="board-view">
        <div class="wrap d-flex justify-content-between">
            <div class="profile">
                <select name="user_level" id="" class="card level">
                    <option value="<?=$rows['user_level']?>">
                      <?php
                        if($rows['user_level'] == 1){
                          echo '수강생';
                        }else if($rows['user_level'] == 2){
                          echo '강사';
                        }else if($rows['user_level'] == 3){
                          echo '관리자';
                        }
                      ?>
                    </option>
                    <option value="3">관리자</option>
                    <option value="2">강사</option>
                    <option value="1">수강생</option>
                </select>
                <div class="profile__card card">
                    <div class="profile__img d-flex ratio ratio-1x1">
                        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/images/logo.png" alt="프로필 사진">
                    </div>
                    <h4 class="title">회원번호</h4>
                    <input type="hidden" name="number" value="<?=$rows['number']?>">
                    <p><?=$rows['number']?></p>
                    <h4 class="title">이름</h4>
                    <p><?=$rows['user_name']?></p>
                    <h4 class="title">아이디</h4>
                    <p><?=$rows['user_id']?></p>
                    <a href="mailto:<?=$rows['user_email']?>" target="_blank" class="btn btn-100p btn-line">
                        <i class="bi bi-envelope"></i>
                        메일발송
                    </a>
                    <button type="submit" class="btn btn-fill btn-100 mt-2">
                      수정내역저장
                    </button>
                </div>
            </div>

            
            <div class="contents d-flex justify-content-between">

            <?php
              if($rows['user_level'] == 1){ ?>
                <div class="contents__card card">
                  <h4 class="title">휴대전화</h4>
                  <input type="text" name="phone" value="<?=$rows['user_phone']?>">
                  <h4 class="title">이메일</h4>
                  <input type="text" name="email" value="<?=$rows['user_email']?>">
                  <div class="d-flex justify-content-between">
                    <div class="half-box">
                        <h4 class="title">접속일</h4>
                        <input type="text" name="login_time" value="<?php
                          $login_time = "SELECT loginlog.login_time FROM loginlog JOIN userregistration ON loginlog.number = userregistration.number WHERE user_num = '$no'";
                          
                          $login_time_result = mysqli_query($con, $login_time);

                          $login_time_arr = array();
                          while($login_time_rows = mysqli_fetch_array($login_time_result)){
                            $login_time_arr[] = substr($login_time_rows['login_time'], 0, 10);
                          }

                          $check_arr = array_unique($login_time_arr);
                          echo count($check_arr);
                        ?>">
                    </div>
                    <div class="half-box">
                        <h4 class="title">가입일</h4>
                        <input type="text" name="reg_date" value="<?=substr($rows['reg_date'], 0, 10)?>">
                    </div>
                  </div>

                  <?php
                    $class_list = "SELECT * FROM user_course WHERE user_id = '$user_id'";
                    $class_result = mysqli_query($con, $class_list);
                    $class_count = mysqli_num_rows($class_result);
                  ?>
                  
                  <h4 class="title d-inline-block">수강중인 리스트  <span class="font-normal"><?=$class_count?>건</span></h4>
                  <div class="data_wrap">
                      <ul>
                          <?php 
                            if($class_count == 0){
                          ?>
                            <li>
                              수강중인 강의가 없습니다.
                            </li>
                          <?php }else{ ?>
                            <?php while($list_row = mysqli_fetch_assoc($class_result)){ ?>
                              <li>
                                <?=$list_row['course_title']?>
                              </li>
                            <?php } ?>
                          <?php } ?>
                      </ul>
                  </div>

                  <?php
                    $class_list .= "AND status = 'completed'";
                    $class_result = mysqli_query($con, $class_list);
                    $class_count = mysqli_num_rows($class_result);
                  ?>

                  <h4 class="title d-inline-block">수강완료 리스트  <span class="font-normal"><?=$class_count?>건</span></h4>
                  <div class="data_wrap">
                      <ul>
                      <?php 
                            if($class_count == 0){
                          ?>
                            <li>
                              수강 완료된 강의가 없습니다.
                            </li>
                          <?php }else{ ?>
                            <?php while($list_row = mysqli_fetch_assoc($class_result)){ ?>
                              <li>
                                <?=$list_row['course_title']?>
                              </li>
                            <?php } ?>
                          <?php } ?>
                      </ul>
                  </div>

                </div>
            <?php }else{ ?>
              <div class="contents__card card">
                  <h4 class="title">휴대전화</h4>
                  <input type="text" name="phone" value="<?=$rows['user_phone']?>">
                  <h4 class="title">이메일</h4>
                  <input type="text" name="email" value="<?=$rows['user_email']?>">
                  <h4 class="title">강사등록일</h4>
                  <input type="text" name="reg_date" value="<?=substr($rows['reg_date'], 0, 10)?>">


                  <?php
                    $lecture_list = "SELECT * FROM coursereg WHERE user_id = '$user_id'";
                    $lecture_result = mysqli_query($con, $lecture_list);
                    $lecture_count = mysqli_num_rows($lecture_result);
                  ?>
                  
                  <h4 class="title d-inline-block">등록 강의수  <span class="font-normal"><?=$lecture_count?>건</span></h4>
                  <div class="data_wrap lecture_list">
                      <ul>
                        <?php 
                          if($lecture_count == 0){
                        ?>
                          <li>
                            등록된 강의가 없습니다.
                          </li>
                        <?php }else{ ?>
                          <?php while($list_row = mysqli_fetch_assoc($lecture_result)){ ?>
                            <li>
                              <?=$list_row['course_title']?>
                            </li>
                          <?php } ?>
                        <?php } ?>
                      </ul>
                  </div>

                  <h4 class="title d-inline-block">이력 및 학력</h4>
                  <div class="data_wrap">
                    <textarea name="teacher_history" id="board_contents"><?php echo $rows['extra4'];?></textarea>
                  </div>

                </div>
            <?php } ?>
                <div class="contents__card card d-flex">
                  <h4 class="title">비고사항</h4>
                  <div class="data_wrap">
                    <textarea name="board_contents" id="board_contents"><?php echo $rows['extra3'];?>
                      <?php 
                          if($no==6) echo"
                          나를 찾았군 후후후 
                          나는야 이 회사의 CEO MR.차.동.현. 
                          
                          이 웹사이트의 에스터에그 4개를 찾았는가?
                          그러면 자네는 우리 회사에 입사할 기회를 가졌어. 
                          나에게 DM으로 연락해 
                          DM은 우리 사원들에게 문의하도록. 
                          ";
                      ?>
                    </textarea>
                  </div>
                  <button type="submit" class="btn btn-fill btn-w-128 ms-auto mt-0" formaction="memo_update.php">비고사항 등록</button>
                </div>
            </div>
        </div>
    </section>
  </form>
</main>
</body>
</html>