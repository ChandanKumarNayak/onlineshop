<?php include "../constant.inc.php"; ?>
<?php include "../db.inc.php"; ?>
<?php include "../function.inc.php"; ?>

<?php
session_start();
$msgArr = "";

$admin_email = get_safe_value($_POST['admin_email']);
$admin_pass = get_safe_value($_POST['admin_pass']);

if(!empty($admin_email) && !empty($admin_pass)){

    $sql_admin = ("SELECT * FROM admin WHERE email = '$admin_email' AND binary pass = '$admin_pass'");
    $sql_admin_query = mysqli_query($db,$sql_admin);
    if(mysqli_num_rows($sql_admin_query) == 1){
        while($row = mysqli_fetch_assoc($sql_admin_query)){
            $_SESSION['ADMIN_ID'] = get_safe_value($row['id']);
        }
        $msgArr = array("status" => "login-success");
    } else {
        $msgArr = array("status" => "login-error", "msg" => "Incorrect credential.");
    }

} else {
    $msgArr = array("status" => "error-empty", "msg" => "Idiot, Fill them all.");
}

echo json_encode($msgArr);

?>