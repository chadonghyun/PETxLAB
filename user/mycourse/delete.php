<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$no = $_POST['number'];

$sql_del = "DELETE FROM boardqnareg WHERE number = '$no'";
$result_del = mysqli_query($con, $sql_del);

echo "
<script>
    location.href = 'class_QnA_list.php?no=1';
</script>
";

mysqli_close($con);
?>