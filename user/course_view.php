<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

    $idx = $_GET['idx'];
    $coursereg_query = "SELECT * FROM coursereg WHERE course_id = '$idx'";
    $result = mysqli_query($con, $coursereg_query);
    $row = mysqli_fetch_assoc($result);


    $usercourse_query = "SELECT * FROM user_course WHERE user_id = '$userid' and course_id = '$idx'";
    $result2 = mysqli_query($con, $usercourse_query);
    $row2 = mysqli_fetch_assoc($result2);


    $video_query = "SELECT * FROM video WHERE course_id = '$idx'";
    $result3 = mysqli_query($con, $video_query);

?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/css/course_view.css" type="text/css">

<main>
    <form action="user_course_insert.php" method="post">
        <input type="hidden" name="course_id" value="<?=$idx?>">
        <ul class="course_list">
            <li class="card">
                <div class="course_thumb ratio ratio-4x3">
                    <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/adm/teacher/lecture/uploads/<?=$row['course_image']?>" alt="<?=$row['course_title']?>">
                </div>
                <div class="course_desc d-flex">
                    <span class="course_cate" style="text-decoration:none;">
                        <?=$row['course_type']?>
                    </span>
                    <h3 class="course_title text-truncate"><?=$row['course_title']?></h3>
                    <input type="hidden" name="course_title" value="<?=$row['course_title']?>">

                    <span class="duration">
                        <?=$row['course_startday']?> ~ <?=$row['course_endday']?>
                        <input type="hidden" name="start_date" value="<?=$row['course_startday']?>">
                        <input type="hidden" name="end_date" value="<?=$row['course_endday']?>">
                    </span>

                    <span class="date">
                        <?php
                            echo((substr($row['course_duration'],0,1) == 0) ? substr($row['course_duration'],1) : $row['course_duration']);
                        ?>
                    </span>

                    <p class="desc_txt">
                        <?=$row['course_shortdesc']?>
                    </p>

                    <div class="progress_area">
                        <div class="progress_bar"></div>
                    </div>
                    <p class="progress_txt">
                        진도율: <?php 
                        echo (
                            (mysqli_num_rows($result2) == 0) ? '0.00' : explode(".", $row2['progress'])[0]
                        );
                        ?>%
                    </p>
                </div>
            </li>
            <?php if(mysqli_num_rows($result2) == 0){ ?>
                <li class="card">
                <div class="card_title d-flex">
                    <h4>강의목록</h4>
                    <span>
                        총 <?php echo(mysqli_num_rows($result3)); ?>건
                    </span>
                </div>
                <ul>
                    <?php while($row3 = mysqli_fetch_array($result3)){ ?>
                    <li class="card inner_card justify-content-between">
                        <!-- <a href="" class="d-flex justify-content-between" title=""> -->
                            <div class="video_desc">
                                <h5 class="video_title">
                                    <?php
                                        echo (explode(".", $row3['video_path'])[0]);
                                    ?>
                                </h5>
                                <p class="video_duration">
                                    강의 길이: 
                                    <?=$row3['video_length']?>분
                                </p>
                            </div>
                            <i class="bi bi-play-circle"></i>
                        <!-- </a> -->
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php
                $file_arr = explode(',',$row['course_file']);
                if($file_arr[0] !== ''){
            ?>
            <li class="card">
                <div class="card_title d-flex">
                    <h4>자료목록</h4>
                    <span>총 <?=count($file_arr)?>건</span>
                </div>
                <ul>
                    <?php
                        foreach($file_arr as $file){
                    ?>
                    <li class="card inner_card d-flex justify-content-between">
                        <!-- <a href="" class="d-flex justify-content-between" title=""> -->
                            <div class="file_desc">
                                <h5 class="file_title">
                                    <?php echo $file ?>
                                </h5>
                            </div>
                            <i class="bi bi-arrow-down-circle"></i>
                        <!-- </a> -->
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <li>
                <button type="submit" class="registration">수강신청</button>
            </li>
            <?php }else{ ?>
                <li>
                    <?php
                        if($row2['confirm'] == 0){
                    ?>
                        <p class="registration waiting">
                            승인 대기중입니다.
                        </p>
                    <?php }else{ ?>
                        <button type="submit" class="registration" formaction="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/mycourse/class_lecture_view.php?no=<?=$row['course_id']?>">강의실로 바로가기</button>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </form>
</main>
<script>
    let progress = document.querySelector('.progress_bar');
    progress.style.width = "<?=$row2['progress']?>%";
</script>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>