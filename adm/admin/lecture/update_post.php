<?php
$conn = mysqli_connect('localhost','root','','petxlab')or die("connect failde");
session_start();

$no = $_POST['course_id'];

$uploaded_file_name_tmp = $_FILES['course-image']['tmp_name'];
$uploaded_file_name = $_FILES['course-image']['name'];
$upload_folder ="/Applications/XAMPP/xamppfiles/htdocs/PETxLAB/adm/admin/lecture/uploads/";
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


$sql = "INSERT INTO CourseReg (course_type, course_category, course_title, course_startday, course_endday, course_duration, course_price, course_image, course_shortdesc, course_longdesc) 
VALUES ('$course_type', '$course_category', '$course_title', '$course_startday', '$course_endday', '$course_duration', $course_price, '$course_image', '$course_shortdesc', '$course_longdesc')";

$result = mysqli_query($conn, $sql);

if($result){
  ?>  <script>
          alert('게시글이 수정되었습니다.');
          location.replace('./pr_center_list.php');
      </script>
  <?php
  } else {
      // echo "게시글 등록에 실패했습니다.";
      echo (mysqli_error($conn));
  }


mysqli_close($conn);

?>