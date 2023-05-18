<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$number = $_POST['number'];
$user_level = $_POST['user_level'];
$teacher_history = $_POST['teacher_history'];

$sql = "UPDATE userregistration SET user_level = '$user_level', extra4 = '$teacher_history' WHERE number = '$number'";
$result = mysqli_query($con, $sql);

echo "
<script>
    location.href = 'adm_m_view.php?no=$number';
</script>
";

?>