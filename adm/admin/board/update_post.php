<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$idx = $_POST['idx'];

$Board_title = $_POST['title'];
$Board_content = $_POST['board_contents'];
$Board_date = date('Y.m.d');
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];

$sql = "UPDATE boardnoticereg SET Board_title='$Board_title', Board_content='$Board_content', user_id='$user_id', user_name='$user_name' WHERE number = '$idx'";

$result = mysqli_query($con, $sql);

if($result){
    ?>  <script>
            alert('게시글이 수정되었습니다.');
            location.replace('./adm_b_list.php?no=1');
        </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($con));
    }


mysqli_close($con);

?>