<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";


  $sql = "select * from coursereg where course_id='$course_id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
?>

<!-- class_video_view 서식 -->
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/mycourse/css/class_video_view.css" type="text/css">
<script src="./js/class_video_view.js"></script>

<!-- <style>

  img {
    display:none;
  }
  img.on {
    display:inline;
  }
</style> -->

<main>
  <section class="class_box">
    <article class="video_box">
      <video src="./video/videoplayback.mp4" id="class_video"></video>
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
    </article>

    <article class="des_box">
      <div class="top_box">
        <p><?=$row['course_type']?></p>
        <p><?=$row['course_title']?></p>
      </div>

      <div class="bottom_box">
        <p>강의 1번의 제목 //비디오 테이블로 이어지기</p>
        <p><?=$row['course_shortdesc']?></p>
        <button>수강완료</button>
      </div>
    </article>
  </section>
</main>
<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>