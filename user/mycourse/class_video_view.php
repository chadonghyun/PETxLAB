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
  
  // 가져온 course_id 값을 변수에 저장
  $courseId = $row['course_id'];
  // course_id 값을 사용하여 class_lecture_view.php 주소생성
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
    
    // video_progress 테이블에서 user_id에 해당하는 수강 완료한 동영상 수
    $sql_completed_videos = "SELECT COUNT(*) AS completed_videos FROM video_progress WHERE user_id = '$userid' AND video_status = 1";
    $result_completed_videos = mysqli_query($con, $sql_completed_videos);
    if (!$result_completed_videos) {
      die(mysqli_error($con));
    }
    $row_completed_videos = mysqli_fetch_array($result_completed_videos);
    $completedVideos = $row_completed_videos['completed_videos'];

    // video 테이블에서 전체 강의 수
    $sql_total_videos = "SELECT COUNT(*) AS total_videos FROM video";
    $result_total_videos = mysqli_query($con, $sql_total_videos);
    if (!$result_total_videos) {
      die(mysqli_error($con));
    }
    $row_total_videos = mysqli_fetch_array($result_total_videos);
    $totalVideos = $row_total_videos['total_videos'];

    // 수강 완료한 동영상의 백분율
    $progressPercentage = ($completedVideos / $totalVideos) * 100;

    // user_course 테이블의 progress 업데이트
    $sql_update_user_course = "UPDATE user_course SET progress = $progressPercentage WHERE user_id = '$userid' AND course_id = $course_id";
    $result_update_user_course = mysqli_query($con, $sql_update_user_course);
    if (!$result_update_user_course) {
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