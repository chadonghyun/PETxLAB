<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$no = $_POST['course_id'];

$uploaded_file_name_tmp = $_FILES['course-image']['tmp_name'];
$uploaded_file_name = $_FILES['course-image']['name'];
$upload_folder =$_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/teacher/lecture/uploads/";
move_uploaded_file($uploaded_file_name_tmp,$upload_folder.$uploaded_file_name);



$course_type = $_POST["course_type"];
$course_category = $_POST["course_category"];
$course_title = $_POST["course_title"];
$course_startday = $_POST["course_startday"];
$course_endday = $_POST["course_endday"];
$course_duration = $_POST["course_duration"];
$course_price = $_POST["course_price"];
$course_image = $uploaded_file_name;
$course_shortdesc = $_POST["course_shortdesc"];
$course_longdesc = $_POST["course_longdesc"];
$user_id = $_POST["user_id"];


$sql = "UPDATE CourseReg SET course_type='$course_type', course_category='$course_category', course_title='$course_title', course_startday='$course_startday', course_endday='$course_endday',course_duration='$course_duration',course_price='$course_price', course_image='$course_image', course_shortdesc='$course_shortdesc',course_longdesc='$course_longdesc', user_id='$user_id' WHERE course_id = '$no'";


$result = mysqli_query($con, $sql);

if($result){
    ?>  
    <script>
        alert('게시글이 수정되었습니다.');
        location.replace('./tch_l_print.php?course_id=<?=$no?>');
    </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($con));
    }


mysqli_close($con);

?>