<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";

include_once './checked.php';

$no = $_POST['no'];

$sql_select = "SELECT * FROM userregistration WHERE checked = 1";
$result_select = mysqli_query($con, $sql_select);

$email_list = array();
while($rows = mysqli_fetch_array($result_select)){
    $email_list[] = $rows['user_email'];
}

$email_list_string = implode(',',$email_list);

echo "
<script>
    window.location.href = 'mailto:' + '".$email_list_string."';
    history.back(-1);
</script>
";


$sql_change = "UPDATE userregistration SET checked = 0 WHERE checked = 1";
$result_change = mysqli_query($con, $sql_change);

mysqli_close($con);
?>
