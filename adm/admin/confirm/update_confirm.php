<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$user_course_id = $_POST['user_course_id'];

echo $user_course_id;


$sql = "UPDATE user_course SET confirm = 1 WHERE user_course_id = '$user_course_id'";
$result = mysqli_query($con, $sql);


if($result){
    ?>  <script>
            // history.go(-1);
        </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($con));
    }


mysqli_close($con);

?>