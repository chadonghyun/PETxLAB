<?php
$conn = mysqli_connect('localhost','root','','petxlab')or die("connect failde");
session_start();

$no = $_POST['course_id'];
$sql = "SELECT * FROM CourseReg WHERE course_id = '$no'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

$sql_d = "DELETE FROM CourseReg WHERE  course_id = '$no'";
$result_d = mysqli_query($conn, $sql_d);

echo (mysqli_error($conn));

if($result_d){
    ?>  
    <script>
        alert('게시글이 삭제되었습니다.');
        location.replace('./adm_l_write.php');
    </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($conn));
    }

mysqli_close($conn);
?>





