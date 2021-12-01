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

    $cat_id = get_safe_value($_POST['cat_id']);
    $cat_img = get_safe_value($_FILES['cat_img']['name']);
    $cat_name = get_safe_value($_POST['cat_name']);
    if(!empty($cat_name)){

        $check_cat_img = "SELECT cat_img FROM product_cat WHERE cat_id = '$cat_id' ";
    $qresult=mysqli_query($db, $check_cat_img);
    while ($row = mysqli_fetch_assoc($qresult)) {
        $cat_img_fetch = get_safe_value($row['cat_img']);
    }
    if($cat_img != ''){
    
        $cat_img_xtn = pathinfo($cat_img,PATHINFO_EXTENSION);
        $cat_img_valid_xtn = array('jpg','jpeg','png');
        if(in_array($cat_img_xtn,$cat_img_valid_xtn)){
            $cat_img_new = rand().'.'.$cat_img_xtn;
            $cat_img_upload_path = 'images/'. $cat_img_new;
            
            $check_cat_name = mysqli_num_rows(mysqli_query($db,"SELECT cat_name FROM product_cat WHERE cat_name = '$cat_name' AND cat_id != '$cat_id' "));
            if($check_cat_name > 0){
                $msgArr = array("status" => "cat-error", "msg" => "Category already exists.");
            } else {
                $sql_prod_cat_update = "UPDATE product_cat SET cat_img ='$cat_img_new',cat_name = '$cat_name' WHERE cat_id = '$cat_id'";
                $query_cat_update = mysqli_query($db,$sql_prod_cat_update);
                if($query_cat_update){
                move_uploaded_file($_FILES['cat_img']['tmp_name'],$cat_img_upload_path);
                unlink('images/'.$cat_img_fetch);
                $msgArr = array("status" => "cat-success" , "msg" => "Updated successfully."); 
            } else {
                $msgArr = array("status" => "failed-error", "msg" => "Something went wrong.");
            }  
            }
        } else {
            $msgArr = array("status" => "xtn-error", "msg" => "Only jpg, jpeg & png format allowed.");
        }
    } else {
        $cat_img_new = $cat_img_fetch;

        $check_cat_name = mysqli_num_rows(mysqli_query($db,"SELECT cat_name FROM product_cat WHERE cat_name = '$cat_name' AND cat_id != '$cat_id' "));
            if($check_cat_name > 0){
                $msgArr = array("status" => "cat-error", "msg" => "Category already exists.");
            } else {
                $sql_prod_cat_update = "UPDATE product_cat SET cat_img ='$cat_img_new',cat_name = '$cat_name' WHERE cat_id = '$cat_id'";
                $query_cat_update = mysqli_query($db,$sql_prod_cat_update);
                if($query_cat_update){
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