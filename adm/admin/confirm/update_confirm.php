<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$user_course_id = $_POST['user_course_id'];
$sql = "UPDATE user_course SET confirm = 1, status = 'in_progress' WHERE user_course_id = '$user_course_id'";
$result = mysqli_query($con, $sql);

$sql2 = "SELECT * FROM user_course 
        JOIN video
        on user_course.course_id = video.course_id
        WHERE user_course_id = '$user_course_id'";
$result2 = mysqli_query($con, $sql2);

while($row = mysqli_fetch_array($result2)){
    $course_id = $row['course_id'];
    $video_id = $row['video_id'];
    $user_id = $row['user_id'];

    $video_insert = "INSERT INTO video_progress(course_id, video_id, user_id, video_status) VALUES('$course_id', '$video_id', '$user_id', 0)";
    $insert_result = mysqli_query($con, $video_insert);
};


if($result){
    ?>  <script>
            history.go(-1);
        </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($con));
    }


mysqli_close($con);

?>