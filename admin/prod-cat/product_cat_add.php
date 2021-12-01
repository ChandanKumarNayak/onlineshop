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

    $msgArr = "";
    $cat_img_new ="";
    $cat_img_xtn ="";
    $cat_img_valid_xtn = array();
    $cat_img_upload_path ="";
    
    $action_type = get_safe_value($_POST['type']);

    if($action_type == 'add_cat'){

    $cat_img = get_safe_value($_FILES['cat_img']['name']);
    $cat_name = get_safe_value($_POST['cat_name']);
    $cat_status = get_safe_value($_POST['cat_status']);

    if(!empty($cat_img) && !empty($cat_name) && !empty($cat_status)){

        $cat_img_xtn = pathinfo($cat_img,PATHINFO_EXTENSION);
    $cat_img_valid_xtn = array('jpg','jpeg','png');
    if(in_array($cat_img_xtn,$cat_img_valid_xtn)){
        $cat_img_new = rand().'.'.$cat_img_xtn;
        $cat_img_upload_path = 'images/' . $cat_img_new;

        $check_cat_name = mysqli_num_rows(mysqli_query($db,"SELECT cat_name FROM product_cat WHERE cat_name = '$cat_name'"));
    if($check_cat_name > 0){
        $msgArr = array("status" => "exist-error", "msg" => "Category already exists.");
    } else {

        $sql_prod_cat_insert = "INSERT INTO product_cat (cat_img,cat_name,cat_status) values ('$cat_img_new','$cat_name','$cat_status')";
        $query_cat_insert = mysqli_query($db,$sql_prod_cat_insert);
        if($query_cat_insert){
            move_uploaded_file($_FILES['cat_img']['tmp_name'],$cat_img_upload_path);
         $msgArr = array("status" => "cat-success" , "msg" => "Added successfully.");
        } else {
            $msgArr = array("status" => "failed-error", "msg" => "Something went wrong.");
        }

    } 
    } else {
        $msgArr = array("status" => "xtn-error", "msg" => "Only jpg, jpeg & png format allowed.");
    }
    } else {
        $msgArr = array("status" => "empty-error" , "msg" => "Please fill all the required (*) fields."); 
    }

    echo json_encode($msgArr);
}
?>