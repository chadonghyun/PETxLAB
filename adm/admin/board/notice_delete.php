<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$no = $_POST['no'];
include_once './checked.php';

$sql_del = "DELETE FROM boardnoticereg WHERE checked = 1";
$result_del = mysqli_query($con, $sql_del);

echo "
<script>
    location.href = 'adm_b_list.php?no=$no';
</script>
";

mysqli_close($con);
?>