<?php include $_SERVER['DOCUMENT_ROOT']."/constant.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/db.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/function.inc.php"; ?>

<?php 
session_start();
if (!isset($_SESSION['ADMIN_ID'])) {
    redirect(ADMIN_LANDING_PATH.'login');
}
?>

<?php

    $id = "";
    $type = "";
    $cat_status = "";
    $cat_status_new = "";

    if(isset($_POST['id']) && $_POST['id'] != 0 && isset($_POST['type']) && $_POST['type'] != ''){

    $id = get_safe_value($_POST['id']);    
    $type = get_safe_value($_POST['type']);

    if($type == 'cat_status'){

        $query1 = "SELECT * FROM product_cat WHERE cat_id = '$id'";
        $qresult=mysqli_query($db, $query1);
        while ($row = mysqli_fetch_assoc($qresult)) {
            $cat_status = get_safe_value($row['cat_status']);
        }
        if($cat_status == 'Active'){
            $cat_status_new = 'Deactive';
        } else {
            $cat_status_new = 'Active';
        }
        $query1 = "UPDATE product_cat SET cat_status = '$cat_status_new'
        WHERE cat_id = '$id'";              
        if($qresult=mysqli_query($db, $query1))
        {
            echo 1;
        } else {
            echo 0; 
        }
    }
    }
?>