<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  //출석일 수
  $sql = "SELECT COUNT(DISTINCT DATE(login_time)) AS total_logins FROM loginlog GROUP BY user_id";
  $result = $con->query($sql);

  // 학습중인 사용자 수 조회
  $sql_in_progress = "SELECT COUNT(*) AS count_in_progress FROM user_course WHERE user_id = '$userid' AND status = 'in_progress'";
  $result_in_progress = $con->query($sql_in_progress);
  $row_in_progress = $result_in_progress->fetch_assoc();
  $count_in_progress = $row_in_progress["count_in_progress"];

  // 신청 내역 수 조회 (pending_approval 상태)
  $sql_pending_approval = "SELECT COUNT(*) AS count_pending_approval FROM user_course WHERE user_id = '$userid' AND status = 'pending_approval'";
  $result_pending_approval = $con->query($sql_pending_approval);
  $row_pending_approval = $result_pending_approval->fetch_assoc();
  $count_pending_approval = $row_pending_approval["count_pending_approval"];

  // 학습완료한 사용자 수 조회
  $sql_completed = "SELECT COUNT(*) AS count_completed FROM user_course WHERE user_id = '$userid' AND status = 'completed'";
  $result_completed = $con->query($sql_completed);
  $row_completed = $result_completed->fetch_assoc();
  $count_completed = $row_completed["count_completed"];

  //QnA데이터 출력
  $sql_QnA = "SELECT qna_category, qna_title, Board_date, qna_response
  FROM boardqnareg
  WHERE user_id = '$userid'";
  $result_QnA = $con->query($sql_QnA);

?>

<!-- myclass.css(나의강의실서식) -->
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/css/myclass.css">
<!-- myclass.js(나의강의실스크립트) -->
<script src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/js/myclass.js" defer></script>

<main>
  <div class="wrap">
    <section id="myinfo">
      <div class="pf_desc">
        <div class="pf_img">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo.png" alt="프로필">
        </div>
        <div class="pf_sub">
          <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/info_update.php" title="">정보수정</a>
          <p><?php echo $userid ?></p>
          <p><?php echo $username ?></p>
          <span><?php
              while ($row = $result->fetch_assoc()) {
                $user_logins = $row["total_logins"];
                // 각 유저의 총 접속일 수 출력
              }
              echo $user_logins
                ?>일 출석</span>
        </div>
      </div>
      <div class="pf_class">
        <div class="pf_l ">
          <a href="" title="" class="pf_case">
            <p class="case"><?php echo $count_in_progress?>건</p>
            <span>학습중</span>
          </a>
        </div>
        <div class="pf_c">
          <a href="" title="" class="pf_case">
            <p class="case"><?php echo $count_completed?>건</p>
            <span>학습종료</span>
          </a>
        </div>
        <div class="pf_r">
          <a href="" title="" class="pf_case">
            <p class="case"><?php echo $count_pending_approval?>건</p>
            <span>신청내역</span>
          </a>
        </div>
      </div>
    </section>
    <section id="mycourse">
      <div class="cr_top top">
        <h2>학습중인 강의</h2>
        <a href="#none" title="">전체보기</a>
      </div>
      <div class="cr_con">
        <div class="cr_img">
          <img src="" alt="">
        </div>
        <div class="cr_sub">
          <span><?php?>전문교육과정</span>
          <h3><?php?>펫 베이커리 특화과정</h3>
          <div class="cr_gauge">
            <div class="cr_gauge_bar"></div>
          </div>
          <div class="cr_rate">
            <span>진도율: 20%<?php?></span>
            <a href="" title="">바로가기</a>
          </div>
        </div>
      </div>
    </section>
  
  
    <section id="myweek">
      <div class="wk_top top">
        <h2>주간학습</h2>
        <span>*강의 1건 이상 학습시 체크됩니다.</span>
      </div>
      <div class="calender">
        <div class="ymw">
          <span>23년 5월 3주차</span>
        </div>
        <div class="days">
          <div class="day">
            <span>월</span>
            <div class="my_checked">
              <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/stamp.png" alt="">
            </div>
          </div>
          <div class="day">
            <span>화</span>
            <div class="my_checked">
              <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/stamp.png" alt="">
            </div>
          </div>
          <div class="day">
            <span>수</span>
            <div class="my_checked">
              <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/stamp.png" alt="">
            </div>
          </div>
          <div class="day">
            <span>목</span>
            <div class="my_checked">
            </div>
          </div>
          <div class="day">
            <span>금</span>
            <div class="my_checked">
            </div>
          </div>
          <div class="day">
            <span>토</span>
            <div class="my_checked">
            </div>
          </div>
          <div class="day">
            <span>일</span>
            <div class="my_checked">
            </div>
          </div>
        </div>
      </div>
    </section>
  
  
    <section id="mycer">
      <div class="cer_top top">
        <h2>수료증</h2>
        <a href="" title="전체보기">전체보기</a>
      </div>
      <!-- <div class="cer_none">
        <div class="cer_img">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/nocer.png" alt="">
        </div>
        <div class="cer_sub">
          <p>보유중인 수료증이 없어요</p>
          <p>수료발급 가능 강의를 완강해보세요!</p>
          <?php?><a href="#none" title="강의보러가기">강의보러가기</a>
        </div>
      </div> -->
      <div class="cer_com">
    <?php
    $sql = "SELECT course_id
    FROM user_course
    WHERE user_id = '$userid' AND progress = 100";
  
    $result = $con->query($sql);
  
    if ($result->num_rows > 0) {
      // 결과가 존재하는 경우
      while ($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
  
        // course_id에 해당하는 과정 이미지 조회
        $sql = "SELECT course_image, course_title
                FROM coursereg
                WHERE course_id = '$courseId' LIMIT 5";
  
        $innerResult = $con->query($sql);
  
        if ($innerResult->num_rows > 0) {
          // 결과가 존재하는 경우
          $innerRow = $innerResult->fetch_assoc();
          $courseImg = $innerRow['course_image'];
          $courseTitle = $innerRow['course_title'];
  
          // 가져온 courseImg를 사용하여 필요한 작업 수행
          ?>
          <figure>
            <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/teacher/lecture/uploads/<?php echo $courseImg?>" alt="">
            <figcaption><?php echo $courseTitle ?></figcaption>
          </figure>
          <?php
        }
      }
    } else {
      // course_id에 해당하는 데이터가 없는 경우
      ?>
      <div class="cer_none">
        <div class="cer_img">
          <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/nocer.png" alt="">
        </div>
        <div class="cer_sub">
          <p>보유중인 수료증이 없어요</p>
          <p>수료발급 가능 강의를 완강해보세요!</p>
          <a href="#none" title="강의보러가기">강의보러가기</a>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
  
  
    </section>
  
  
    <section id="myqna">
      <div class="qna_top top">
        <h2>QnA</h2>
        <?php?><a href="./class_QnA_list.php" title="">전체보기</a>
      </div>
      <ul class="qna_tab_list">
        <li class="active" data-tab="all">전체</li>
        <li data-tab="solved">해결</li>
        <li data-tab="unsolved">미해결</li>
      </ul>
      <div class="qna_tab">
        <ul class="tabs">
          <li class="tab" data-tab="all">
            <?php
              $sql = "SELECT qna_category, qna_title, Board_date, qna_response
              FROM boardqnareg
              WHERE user_id = '$userid' LIMIT 5";
              $result = $con->query($sql);
  
              while ($row = $result->fetch_assoc()) {
              if ($row['qna_response'] == 1) {
              $response_class = 'sol';
              $response_text = '해결';
              } else {
              $response_class = 'unsol';
              $response_text = '미해결';
              }
  
              $category = $row['qna_category'];
              $title = $row['qna_title'];
              $date = $row['Board_date'];
  
              echo '<div class="content">';
              echo '<p>';
              echo "<span>$category</span>";
              echo "<span class='$response_class'>$response_text</span>";
              echo '</p>';
              echo "<p>$title</p>";
              echo "<span>$date</span>";
              echo '</div>';
              }
  
            ?>
          </li>
          <li class="tab" data-tab="unsolved">
            <?php
              $sql = "SELECT qna_category, qna_title, Board_date, qna_response
              FROM boardqnareg
              WHERE user_id = '$userid' AND qna_response = 0 LIMIT 5";
  
              $result = $con->query($sql);
  
              while ($row = $result->fetch_assoc()) {
              if ($row['qna_response'] == 1) {
              $response_class = 'sol';
              $response_text = '해결';
              } else {
              $response_class = 'unsol';
              $response_text = '미해결';
              }
  
              $category = $row['qna_category'];
              $title = $row['qna_title'];
              $date = $row['Board_date'];
  
              echo '<div class="content">';
              echo '<p>';
              echo "<span>$category</span>";
              echo "<span class='$response_class'>$response_text</span>";
              echo '</p>';
              echo "<p>$title</p>";
              echo "<span>$date</span>";
              echo '</div>';
              }
            ?>
          </li>
          <li class="tab" data-tab="solved">
          <?php
              $sql = "SELECT qna_category, qna_title, Board_date, qna_response
              FROM boardqnareg
              WHERE user_id = '$userid' AND qna_response = 1 LIMIT 5";
  
              $result = $con->query($sql);
  
              while ($row = $result->fetch_assoc()) {
              if ($row['qna_response'] == 1) {
              $response_class = 'sol';
              $response_text = '해결';
              } else {
              $response_class = 'unsol';
              $response_text = '미해결';
              }
  
              $category = $row['qna_category'];
              $title = $row['qna_title'];
              $date = $row['Board_date'];
  
              echo '<div class="content">';
              echo '<p>';
              echo "<span>$category</span>";
              echo "<span class='$response_class'>$response_text</span>";
              echo '</p>';
              echo "<p>$title</p>";
              echo "<span>$date</span>";
              echo '</div>';
              }
            ?>
          </li>
        </ul>
      </div>
    </section>
  </div>
</main>

<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>

</body>
</html>