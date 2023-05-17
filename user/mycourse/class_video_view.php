<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $course_id = $_GET['course_id'];
  $no = $_GET['no'];

  $sql = "SELECT course_id, course_title, course_shortdesc, course_type FROM coursereg WHERE course_id = $course_id";
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die(mysqli_error($con));
  }
  $row = mysqli_fetch_array($result);
  
  // 가져온 course_id 값을 변수에 저장합니다.
  $courseId = $row['course_id'];
  // course_id 값을 사용하여 class_lecture_view.php 주소를 생성합니다.
  $url = "./class_lecture_view.php?no=" . $courseId;

  $sql2 = "SELECT * FROM video WHERE video_id=$no";
  $result2 = mysqli_query($con, $sql2);
  $row2 = mysqli_fetch_array($result2);

  // 수강완료 버튼 클릭시
  if (isset($_POST['complete'])) {
    // video_progress 테이블 status값 수정
    $sql_update_progress = "UPDATE video_progress SET video_status = 1 WHERE user_id = '$userid' AND video_id = $no";
    $result_update_progress = mysqli_query($con, $sql_update_progress);
    if (!$result_update_progress) {
      die(mysqli_error($con));
    }

    // video 테이블 status값 수정
    $sql_update_video = "UPDATE video SET video_status = 1 WHERE video_id = $no";
    $result_update_video = mysqli_query($con, $sql_update_video);
    if (!$result_update_video) {
      die(mysqli_error($con));
    }
    echo '<script>location.replace("' . $url . '");</script>';
      exit();
    }
  ?>

<!-- class_video_view 서식 -->
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/css/class_video_view.css" type="text/css">
<script src="./js/class_video_view.js"></script>

<main>
  <section class="class_box">
    <article class="video_box">
    <?php $videoPath = $row2['video_path'];?>
    <video src="<?php echo '/PETxLAB/adm/teacher/lecture/videos/' . $videoPath ?>" id="class_video" controls></video>
<!-- 
      <img src="./img/set.png" alt="설정버튼" id="btn05">

      <ul>
        <li><img src="./img/back_play.png" alt="앞으로 가기 버튼" id="btn03"></li>
        <li>
          <img src="./img/play.png" alt="재생버튼" id="btn01">
          <img src="./img/pause.png" alt="정지버튼" id="btn02">
        </li>
        <li><img src="./img/front_play.png" alt="뒤로가기 버튼" id="btn04"></li>
      </ul>

      <div id="play_wrap">
        <div id="play_box">
          <div id="play_now"><img src="./img/foot_stamp.png" alt="강아지발바닥"></div>
        </div>
      </div>

      <img src="./img/screen.png" alt="전체화면" id="btn06">

      <div class="speed_box">
        <ul class="speed">
          <li id="btn07">x1</li>
          <li id="btn08">x1.5</li>
          <li id="btn09">x2</li>
        </ul>
      </div> -->
    </article>

    <article class="des_box">
      <div class="top_box">
      <?php
      if ($row['course_type'] == 'professional') {
        $row['course_type'] = "전문교육과정";
      } else {
        $row['course_type'] = "일반교육과정";
      }
      ?>
        <p><?=$row['course_type']?></p>
        <p><?=$row['course_title']?></p>
      </div>

      <?php $videoPath = explode('.', $row2['video_path'])[0]; ?>
      <div class="bottom_box">
        <p><?= $videoPath ?></p>
        <p><?=$row['course_shortdesc']?></p>
        <form method="POST">
          <button type="submit" name="complete">수강완료</button>
        </form>
        <button type="submit" onclick="goBack()">강의 목록보기</button>
      </div>
    </article>
  </section>
</main>

<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>