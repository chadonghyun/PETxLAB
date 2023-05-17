<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PETxLAB/config.php";

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

            $uploaded_files[] = $uploaded_file_name2; // 파일 경로를 배열에 추가
        }
    }
}

// 비디오 업로드 하기
$uploaded_file_name_tmp3 = isset($_FILES['course-file2']['tmp_name']) ? $_FILES['course-file2']['tmp_name'] : array();
$uploaded_file_names3 = isset($_FILES['course-file2']['name']) ? $_FILES['course-file2']['name'] : array();

$uploaded_files2 = array(); // 업로드된 비디오 파일 경로를 저장할 배열
$upload_folder3 = $_SERVER['DOCUMENT_ROOT'] . "/PETxLAB/adm/teacher/lecture/videos/";

if (is_array($uploaded_file_name_tmp3)) {
    
    //getid3로 비디오 파일의 시간 정보 가져오기
    require_once $_SERVER['DOCUMENT_ROOT'] . "/PETxLAB/getid3/getid3/getid3.php";

    foreach ($uploaded_file_name_tmp3 as $key => $tmp_name) {
        $uploaded_file_name2 = isset($uploaded_file_names3[$key]) ? $uploaded_file_names3[$key] : '';
        $uploaded_file_name_tmp = isset($uploaded_file_name_tmp3[$key]) ? $uploaded_file_name_tmp3[$key] : '';

        if (!empty($uploaded_file_name_tmp)) {
            move_uploaded_file($uploaded_file_name_tmp, $upload_folder3 . $uploaded_file_name2);

            $uploaded_files2[] = $uploaded_file_name2; // 파일 경로를 배열에 추가

            $video_file = $upload_folder3 . $uploaded_file_name2;

            $getID3 = new getID3();
            $file_info = $getID3->analyze($video_file);
            $video_duration = $file_info['playtime_string'];

            $video_length = mysqli_real_escape_string($con, $video_duration);
            $update_sql = "UPDATE video SET video_length = '$video_length' WHERE video_path = '$uploaded_file_name2'";
            $result4 = mysqli_query($con, $update_sql);


        }
    }
}

$course_price = $_POST["course_price"];
$course_image = $uploaded_file_name;
$course_file = implode(",", $uploaded_files);
$course_shortdesc = $_POST["course_shortdesc"];
$course_longdesc = $_POST["course_longdesc"];
$user_id = $_POST["user_id"];
$course_type = $_POST["course_type"];
$course_category = $_POST["course_category"];
$course_title = $_POST["course_title"];
$course_startday = $_POST["course_startday"];
$course_endday = $_POST["course_endday"];
$course_duration = $_POST["course_duration"];

// 강의 정보 삽입
$sql = "INSERT INTO coursereg (course_type, course_category, course_title, course_startday, course_endday, course_duration, course_price, course_image, course_file, course_shortdesc, course_longdesc, user_id) 
VALUES ('$course_type', '$course_category', '$course_title', '$course_startday', '$course_endday', '$course_duration', $course_price, '$course_image', '$course_file', '$course_shortdesc', '$course_longdesc', '$user_id')";

$result2 = mysqli_query($con, $sql);

if ($result2) {
    // 강의 정보 등록 성공
// video 테이블에 path 추가
$video_paths = implode(",", $uploaded_files2); 

// 새로 추가한 강의의 course_id 가져오기
$course_id = mysqli_insert_id($con);

// Video 테이블에 비디오 경로 저장
// 반복문으로 들어가기
$result3 = true; 
$video_ids = [];

// Loop through the uploaded files
foreach ($uploaded_files2 as $key => $uploaded_file) {
    // Insert video path into video table
    $insert_sql = "INSERT INTO video (course_id, video_length, video_status, video_path) VALUES ('$course_id', '', 0, '$uploaded_file')";
    $result3 = mysqli_query($con, $insert_sql);

    if ($result3) {
        $video_id = mysqli_insert_id($con);
        $video_ids[] = $video_id;

        $video_file = $upload_folder3 . $uploaded_file;

        $getID3 = new getID3();
        $file_info = $getID3->analyze($video_file);
        $video_duration = $file_info['playtime_string'];
        $video_length = mysqli_real_escape_string($con, $video_duration);
        $update_sql = "UPDATE video SET video_length = '$video_length' WHERE video_id = '$video_id'";
        $result4 = mysqli_query($con, $update_sql);
        ?>
        <script>
            alert('강의가 등록되었습니다.');
            location.replace('./tch_l_list.php?no=3');
        </script>
        <?php
        }else {
            echo (mysqli_error($con));
    }
}
}
    



mysqli_close($con);
?>
