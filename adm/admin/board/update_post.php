<?php

$conn = mysqli_connect('localhost','root','','petxlab')or die("connect failde");
session_start();

$no = $_POST['no'];

$Board_title = $_POST['title'];
$Board_content = $_POST['board_contents'];
$Board_date = date('Y.m.d');
$user_id = '작성자아이디';
$user_name = '작성자이름';

$sql = "UPDATE boardnoticereg SET Board_title='$Board_title', Board_content='$Board_content', user_id='$user_id', user_name='$user_name' WHERE number = '$no'";

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