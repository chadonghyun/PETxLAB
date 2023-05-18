<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

    // 강의 정보 가져오기
    $no = $_GET['no'];
    $coursereg_query = "SELECT * FROM coursereg WHERE course_id = '$no'";
    $result = mysqli_query($con, $coursereg_query);
    $row = mysqli_fetch_assoc($result);
    if ($row['course_type'] == 'professional') {
        $row['course_type'] = "전문교육과정";
    } else {
        $row['course_type'] = "일반교육과정";
    }

    // 유저 강의 정보 가져오기
    $usercourse_query = "SELECT * FROM user_course WHERE user_id = '$userid' and course_id = '$no'";
    $result2 = mysqli_query($con, $usercourse_query);
    $row2 = mysqli_fetch_assoc($result2);

    // 해당 강의 리스트 가져오기
    $video_query = "SELECT * FROM video WHERE course_id = '$no'";
    $result3 = mysqli_query($con, $video_query);
    $num_rows = mysqli_num_rows($result3);

?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/css/class_lecture_view.css" type="text/css">

<main>
  <form action="" method="post">
    <input type="hidden" name="no" value="<?=$no?>">
    <input type="hidden" name="qna_category" value="<?=$row['course_type']?>">
    <ul class="course_list">
      <li class="card">
        <div class="course_thumb ratio ratio-4x3">
          <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/adm/teacher/lecture/uploads/<?php echo $row['course_image'] ?>" alt="">
        </div>
        <div class="course_desc d-flex">
          <span class="course_cate" style="text-decoration:none;">
            <?php echo $row['course_type'] ?>
          </span>
          <h3 class="course_title text-truncate"><?= $row['course_title'] ?></h3>

          <span class="duration">
            <?= $row['course_startday'] ?> ~ <?= $row['course_endday'] ?>
          </span>

          <span class="date">
            <?php
            echo ((substr($row['course_duration'], 0, 1) == 0) ? substr($row['course_duration'], 1) : $row['course_duration']);
            ?>
          </span>

          <p class="desc_txt">
            <?= $row['course_shortdesc'] ?>
          </p>

          <div class="progress_area">
            <div class="progress_bar"></div>
          </div>
          <p class="progress_txt">
            진도율: <?php echo (explode(".", $row2['progress'])[0]); ?>%
          </p>
        </div>
      </li>
      <li class="card">
        <div class="card_title d-flex">
          <h4>강의목록</h4>
          <span>총 <?php echo $num_rows ?>건</span>
          </div>
        <ul>
          <?php
            while ($row3 = $result3->fetch_array()) {
                $video_progress_query = "SELECT video_status FROM video_progress WHERE user_id = '$userid' AND video_id = '".$row3['video_id']."'";
                $video_progress_result = mysqli_query($con, $video_progress_query);
                $video_progress_row = mysqli_fetch_assoc($video_progress_result);
          ?>
          <li class="card inner_card">
            <a href="./class_video_view.php?course_id=<?= $row3['course_id'] ?>&no=<?= $row3['video_id'] ?>" class="d-flex justify-content-between" title="">
              <div class="video_desc">
                <h5 class="video_title">
                  <?php echo (explode(".", $row3['video_path'])[0]); ?>
                </h5>
                <p class="video_duration">
                  강의 길이: 30분
                  <span class="state <?= $video_progress_row['video_status'] == 1 ? 'com' : 'fal'; ?>">
                    <?= $video_progress_row['video_status'] == 1 ? '수강완료' : '미수강'; ?>
                  </span>
                </p>
              </div>
              <i class="bi bi-play-circle"></i>
            </a>
          </li>
          <?php } ?>
        </ul>
      </li>
      <?php
        $file_arr = explode(',', $row['course_file']);
        if ($file_arr[0] !== '') {
      ?>
      <li class="card">
        <div class="card_title d-flex">
          <h4>자료목록</h4>
          <span>총 <?= count($file_arr) ?>건</span>
        </div>
        <ul>
          <?php
              foreach ($file_arr as $file) {
          ?>
          <li class="card inner_card d-flex">
            <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/adm/teacher/lecture/uploads/<?=$file?>" class="d-flex justify-content-between" title="">
              <div class="file_desc">
                <h5 class="file_title">
                  <?php echo $file ?>
                </h5>
              </div>
              <i class="bi bi-arrow-down-circle"></i>
            </a>
          </li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>
    </ul>
    <a href="./class_QnA_write.php?no=<?=$no?>&qna_cate=<?=$row['course_type']?>" title="질문하기" class="gogo">질문하기</a>
  </form>
</main>

<script>
  let progress = document.querySelector('.progress_bar');
  progress.style.width = "<?= $row2['progress'] ?>%";
</script>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>