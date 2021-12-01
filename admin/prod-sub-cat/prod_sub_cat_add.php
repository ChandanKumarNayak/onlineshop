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
    $sub_cat_img_new ="";
    $sub_cat_img_xtn ="";
    $sub_cat_img_valid_xtn = array();
    $sub_cat_img_upload_path ="";
    
    $action_type = get_safe_value($_POST['type']);

    if($action_type == 'add_sub_cat'){

    $sub_cat_img = get_safe_value($_FILES['sub_cat_img']['name']);
    $sub_cat_name = get_safe_value($_POST['sub_cat_name']);
    $cat_id = get_safe_value($_POST['cat_id']);
    $sub_cat_status = get_safe_value($_POST['sub_cat_status']);

    if(!empty($sub_cat_img) && !empty($sub_cat_name) && !empty($cat_id) && !empty($sub_cat_status)){

        $sub_cat_img_xtn = pathinfo($sub_cat_img,PATHINFO_EXTENSION);
    $sub_cat_img_valid_xtn = array('jpg','jpeg','png');
    if(in_array($sub_cat_img_xtn,$sub_cat_img_valid_xtn)){
        $sub_cat_img_new = rand().'.'.$sub_cat_img_xtn;
        $sub_cat_img_upload_path = 'images/' . $sub_cat_img_new;

        $check_sub_cat_name = mysqli_num_rows(mysqli_query($db,"SELECT sub_cat_name FROM prod_sub_cat WHERE sub_cat_name = '$sub_cat_name'"));
    if($check_sub_cat_name > 0){
        $msgArr = array("status" => "exist-error", "msg" => "Sub-Category already exists.");
    } else {

        $sql_prod_sub_cat_insert = "INSERT INTO prod_sub_cat (sub_cat_img,sub_cat_name,cat_id,sub_cat_status) values ('$sub_cat_img_new','$sub_cat_name','$cat_id','$sub_cat_status')";
        $query_sub_cat_insert = mysqli_query($db,$sql_prod_sub_cat_insert);
        if($query_sub_cat_insert){
            move_uploaded_file($_FILES['sub_cat_img']['tmp_name'],$sub_cat_img_upload_path);
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