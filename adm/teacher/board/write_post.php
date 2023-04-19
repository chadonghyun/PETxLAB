<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$Board_title = $_POST['title'];
$Board_content = $_POST['board_contents'];
$Board_date = date('Y.m.d');
// $user_id = $_POST['user_id'];
// $user_name = $_POST['user_name'];

$sql = "INSERT INTO boardnoticereg(Board_title, Board_content, Board_date, user_id, user_name, user_views) VALUES ('$Board_title', '$Board_content', '$Board_date', '$userid', '$username', 0)";

$result = mysqli_query($con, $sql);

if($result){
    ?>  
    <script>
            alert('게시글이 등록되었습니다.');
            location.replace('./tch_b_list.php?no=1');
        </script>
    <?php
    } else {
        echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($con));
    }
    
mysqli_close($con);

?>