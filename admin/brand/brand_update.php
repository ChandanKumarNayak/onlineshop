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

    $sub_cat_id = get_safe_value($_POST['sub_cat_id']);
    $sub_cat_img = get_safe_value($_FILES['sub_cat_img']['name']);
    $sub_cat_name = get_safe_value($_POST['sub_cat_name']);
    $cat_id = get_safe_value($_POST['cat_id']);
    if(!empty($sub_cat_name) && !empty($cat_id)){

        $check_sub_cat_img = "SELECT sub_cat_img FROM prod_sub_cat WHERE sub_cat_id = '$sub_cat_id' ";
    $qresult=mysqli_query($db, $check_sub_cat_img);
    while ($row = mysqli_fetch_assoc($qresult)) {
        $sub_cat_img_fetch = get_safe_value($row['sub_cat_img']);
    }
    if($sub_cat_img != ''){
    
        $sub_cat_img_xtn = pathinfo($sub_cat_img,PATHINFO_EXTENSION);
        $sub_cat_img_valid_xtn = array('jpg','jpeg','png');
        if(in_array($sub_cat_img_xtn,$sub_cat_img_valid_xtn)){
            $sub_cat_img_new = rand().'.'.$sub_cat_img_xtn;
            $sub_cat_img_upload_path = 'images/'. $sub_cat_img_new;
            
            $check_sub_cat_name = mysqli_num_rows(mysqli_query($db,"SELECT sub_cat_name FROM prod_sub_cat WHERE sub_cat_name = '$sub_cat_name' AND sub_cat_id != '$sub_cat_id' "));
            if($check_sub_cat_name > 0){
                $msgArr = array("status" => "cat-error", "msg" => "Sub-Category already exists.");
            } else {
                $sql_prod_sub_cat_update = "UPDATE prod_sub_cat SET sub_cat_img ='$sub_cat_img_new',sub_cat_name = '$sub_cat_name',cat_id = '$cat_id' WHERE sub_cat_id = '$sub_cat_id'";
                $query_sub_cat_update = mysqli_query($db,$sql_prod_sub_cat_update);
                if($query_sub_cat_update){
                move_uploaded_file($_FILES['sub_cat_img']['tmp_name'],$sub_cat_img_upload_path);
                unlink('images/'.$sub_cat_img_fetch);
                $msgArr = array("status" => "cat-success" , "msg" => "Updated successfully."); 
            } else {
                $msgArr = array("status" => "failed-error", "msg" => "Something went wrong.");
            }  
            }
        } else {
            $msgArr = array("status" => "xtn-error", "msg" => "Only jpg, jpeg & png format allowed.");
        }
    } else {
        $sub_cat_img_new = $sub_cat_img_fetch;

        $check_sub_cat_name = mysqli_num_rows(mysqli_query($db,"SELECT sub_cat_name FROM prod_sub_cat WHERE sub_cat_name = '$sub_cat_name' AND sub_cat_id != '$sub_cat_id' "));
            if($check_sub_cat_name > 0){
                $msgArr = array("status" => "cat-error", "msg" => "Sub-Category already exists.");
            } else {
                $sql_prod_sub_cat_update = "UPDATE prod_sub_cat SET sub_cat_img ='$sub_cat_img_new',sub_cat_name = '$sub_cat_name',cat_id = '$cat_id' WHERE sub_cat_id = '$sub_cat_id'";
                $query_sub_cat_update = mysqli_query($db,$sql_prod_sub_cat_update);
                if($query_sub_cat_update){
                $msgArr = array("status" => "cat-success" , "msg" => "Updated successfully."); 
            } else {
                $msgArr = array("status" => "failed-error", "msg" => "Something went wrong.");
            }  
    }

        }
        
    } else {
        $msgArr = array("status" => "empty-error" , "msg" => "Please fill all the required (*) fields."); 
    }

    echo json_encode($msgArr);
?>