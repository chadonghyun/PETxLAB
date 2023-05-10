<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";


// 이미지 업로드 하기
$uploaded_file_name_tmp = $_FILES['course-image']['tmp_name'];
$uploaded_file_name = $_FILES['course-image']['name'];
$upload_folder = $_SERVER['DOCUMENT_ROOT'] . "/PETxLAB/adm/teacher/lecture/uploads/";

move_uploaded_file($uploaded_file_name_tmp, $upload_folder . $uploaded_file_name);

// 학습자료 업로드 하기
$uploaded_file_name_tmp2 = isset($_FILES['course-file']['tmp_name']) ? $_FILES['course-file']['tmp_name'] : array();
$uploaded_file_names2 = isset($_FILES['course-file']['name']) ? $_FILES['course-file']['name'] : array();

$uploaded_files = array(); // 업로드된 파일명을 저장할 배열
$upload_folder2 = $_SERVER['DOCUMENT_ROOT'] . "/PETxLAB/adm/teacher/lecture/uploads/";

if (is_array($uploaded_file_name_tmp2)) {
    foreach ($uploaded_file_name_tmp2 as $key => $tmp_name) {
        $uploaded_file_name2 = isset($uploaded_file_names2[$key]) ? $uploaded_file_names2[$key] : '';
        $uploaded_file_name_tmp = isset($uploaded_file_name_tmp2[$key]) ? $uploaded_file_name_tmp2[$key] : '';

        if (!empty($uploaded_file_name_tmp)) {
            move_uploaded_file($uploaded_file_name_tmp, $upload_folder2 . $uploaded_file_name2);

            $uploaded_files[] = $uploaded_file_name2; // 파일명을 배열에 추가
        }
    }
}



$course_type = $_POST["course_type"];
$course_category = $_POST["course_category"];
$course_title = $_POST["course_title"];
$course_startday = $_POST["course_startday"];
$course_endday = $_POST["course_endday"];
$course_duration = $_POST["course_duration"];
$course_price = $_POST["course_price"];
$course_image = $uploaded_file_name;
$course_file = implode(",", $uploaded_files); // 여러 개의 파일명을 쉼표로 구분하여 문자열로 저장하기 ... 제발..
$course_shortdesc = $_POST["course_shortdesc"];
$course_longdesc = $_POST["course_longdesc"];
$user_id = $_POST["user_id"];

$sql = "INSERT INTO coursereg (course_type, course_category, course_title, course_startday, course_endday, course_duration, course_price, course_image, course_file, course_shortdesc, course_longdesc, user_id) 
VALUES ('$course_type', '$course_category', '$course_title', '$course_startday', '$course_endday', '$course_duration', $course_price, '$course_image', '$course_file', '$course_shortdesc', '$course_longdesc', '$user_id')";

$result2 = mysqli_query($con, $sql);

if ($result2) {
    ?>  
    <script>
        alert('강의가 등록되었습니다.');
        location.replace('./tch_l_list.php?no=3');
    </script>
    <?php
} else {
    echo (mysqli_error($con));
}

mysqli_close($con);
?>
