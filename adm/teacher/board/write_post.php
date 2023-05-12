<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$number = $_POST['number'];
$board_contents = $_POST["board_reply"];
$reply_time = date('Y-m-d H:i:s');
// $qna_response = 1;

$sql = "UPDATE boardqnareg SET response='$board_contents', reply_time='$reply_time', qna_response= 1 WHERE number = '$number'";

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