<?php

$conn = mysqli_connect('localhost','root','','petxlab')or die("connect failde");
session_start();

$Board_title = $_POST['title'];
$Board_content = $_POST['board_contents'];
$Board_date = date('Y.m.d');
$user_id = '작성자아이디';
$user_name = '작성자이름';

$sql = "INSERT INTO boardnoticereg(Board_title, Board_content, Board_date, user_id, user_name, user_views) VALUES ('$Board_title', '$Board_content', '$Board_date', '$user_id', '$user_name', 0)";

$result = mysqli_query($conn, $sql);

if($result){
    ?>  <script>
            alert('게시글이 등록되었습니다.');
            location.replace('./pr_center_list.php');
        </script>
    <?php
    } else {
        // echo "게시글 등록에 실패했습니다.";
        echo (mysqli_error($conn));
    }


mysqli_close($conn);

?>