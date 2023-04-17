<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

$no = $_GET['no'];
$query = "SELECT * FROM userregistration WHERE number = '$no'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);

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
                    <option value="1">관리자</option>
                    <option value="2">강사</option>
                    <option value="3">수강생</option>
                </select>
                <div class="profile__card card">
                    <div class="profile__img d-flex ratio ratio-1x1">
                        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/images/logo.png" alt="프로필 사진">
                    </div>
                    <h4 class="title">회원번호</h4>
                    <p><?=$rows['number']?></p>
                    <?php
                      if($rows['user_level'] == 1){
                        echo '
                          <h4 class="title">회원등급</h4>
                          <p>1등급 한우</p>
                        ';
                      }
                    ?>
                    <h4 class="title">이름</h4>
                    <p><?=$rows['user_name']?></p>
                    <h4 class="title">아이디</h4>
                    <p><?=$rows['user_id']?></p>
                    <a href="mailto:<?=$rows['user_email']?>" target="_blank" class="btn btn-100p btn-line">
                        <i class="bi bi-envelope"></i>
                        메일발송
                    </a>
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
            <?php }else{ ?>
              <div class="contents__card card">
                  <h4 class="title">휴대전화</h4>
                  <input type="text" name="phone" value="<?=$rows['user_phone']?>">
                  <h4 class="title">이메일</h4>
                  <input type="text" name="email" value="<?=$rows['user_email']?>">
                  <h4 class="title">강사등록일</h4>
                  <input type="text" name="email">
                  
                  <h4 class="title d-inline-block">등록 강의수  <span class="font-normal">2건</span></h4>
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

                  <h4 class="title d-inline-block">이력 및 학력  <span class="font-normal">2건</span></h4>
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
            <?php } ?>
                
                
                
                
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