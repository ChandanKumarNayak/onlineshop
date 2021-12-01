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
    $brand_exporter_of = array();
    $brand_logo_new ="";
    $brand_logo_xtn ="";
    $brand_logo_valid_xtn = array();
    $brand_logo_upload_path ="";
    
    $action_type = get_safe_value($_POST['type']);

    if($action_type == 'add_brand'){

    $brand_logo = get_safe_value($_FILES['brand_logo']['name']);
    $brand_name = get_safe_value($_POST['brand_name']);
    $brand_exporter_of = $_POST['brand_exporter_of'];
    $brand_exporter_off = implode(',', $brand_exporter_of);
    $brand_status = get_safe_value($_POST['brand_status']);

    if(!empty($brand_logo) && !empty($brand_name) && !empty($brand_exporter_of) && !empty($brand_status)){

        $brand_logo_xtn = pathinfo($brand_logo,PATHINFO_EXTENSION);
    $brand_logo_valid_xtn = array('jpg','jpeg','png');
    if(in_array($brand_logo_xtn,$brand_logo_valid_xtn)){
        $brand_logo_new = rand().'.'.$brand_logo_xtn;
        $brand_logo_upload_path = 'images/' . $brand_logo_new;

        $check_brand_name = mysqli_num_rows(mysqli_query($db,"SELECT brand_name FROM brand WHERE brand_name = '$brand_name'"));
    if($check_brand_name > 0){
        $msgArr = array("status" => "exist-error", "msg" => "Brand already exists.");
    } else {

        $sql_brand_insert = "INSERT INTO brand (brand_logo,brand_name,brand_exporter_of,brand_status) values ('$brand_logo_new','$brand_name','$brand_exporter_off','$brand_status')";
        $query_brand_insert = mysqli_query($db,$sql_brand_insert);
        if($query_brand_insert){
            move_uploaded_file($_FILES['brand_logo']['tmp_name'],$brand_logo_upload_path);
         $msgArr = array("status" => "brand-success" , "msg" => "Added successfully.");
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