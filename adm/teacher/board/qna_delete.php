<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

include_once './checked.php';

$no = $_POST['no'];

$sql_del = "DELETE FROM boardqnareg WHERE checked = 1";
$result_del = mysqli_query($con, $sql_del);

echo "
<script>
    location.href = 'tch_b_list.php?no=$no';
</script>
";

mysqli_close($con);
?>