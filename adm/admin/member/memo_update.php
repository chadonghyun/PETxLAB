<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

$board_contents = $_POST['board_contents'];
$number = $_POST['number'];

$sql = "UPDATE userregistration SET extra3 = '$board_contents' WHERE number = '$number'";
$result = mysqli_query($con, $sql);

echo "
<script>
    location.href = 'adm_m_view.php?no=$number';
</script>
";

?>