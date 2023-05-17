<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";


$course_id = $_POST['course_id'];
$course_title = $_POST['course_title'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$sql = "INSERT INTO user_course(user_id, user_name, course_id, course_title, start_date, end_date) VALUES('$userid', '$username', '$course_id', '$course_title', '$start_date', '$end_date')";

$result = mysqli_query($con, $sql);

if($result){
    ?>  
    <script>
            alert('신청되었습니다.');
            history.go(-1);
        </script>
    <?php
    } else {
        echo "신청에 실패했습니다.";
        echo (mysqli_error($con));
    }
    
mysqli_close($con);

?>