<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";

$no = $_POST['course_id'];
$sql = "SELECT * FROM CourseReg WHERE course_id = '$no'";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_assoc($result);

$sql_d = "DELETE FROM CourseReg WHERE  course_id = '$no'";
$result_d = mysqli_query($con, $sql_d);

echo (mysqli_error($con));

if($result_d){
    ?>  
    <script>
        alert('게시글이 삭제되었습니다.');
        location.replace('./tch_l_list.php');
    </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($con));
    }

mysqli_close($con);
?>





