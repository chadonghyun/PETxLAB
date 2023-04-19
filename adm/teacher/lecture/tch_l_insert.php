<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";



$uploaded_file_name_tmp = $_FILES['course-image']['tmp_name'];
$uploaded_file_name = $_FILES['course-image']['name'];
$upload_folder =$_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/teacher/lecture/uploads/";
// $upload_folder =$_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/teacher/lecture/uploads/";
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




$sql = "INSERT INTO coursereg (course_type, course_category, course_title, course_startday, course_endday, course_duration, course_price, course_image, course_shortdesc, course_longdesc, user_id) 
VALUES ('$course_type', '$course_category', '$course_title', '$course_startday', '$course_endday', '$course_duration', $course_price, '$course_image', '$course_shortdesc', '$course_longdesc', '$user_id')";

$result2 = mysqli_query($con, $sql);

if($result2){
    ?>  <script>
            alert('강의가 등록되었습니다.');
            location.replace('./tch_l_list.php?no=3');
        </script>
    <?php
    } else {
        echo (mysqli_error($con));
    }

mysqli_close($con);
?>

