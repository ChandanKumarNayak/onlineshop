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

    if(isset($_POST['id']) && $_POST['id'] != 0 && isset($_POST['type']) && $_POST['type'] != ''){

    $id = get_safe_value($_POST['id']);    
    $type = get_safe_value($_POST['type']);

    if($type == 'cat_edit'){
        $sql_cat_edit = mysqli_query($db, "SELECT * FROM product_cat WHERE cat_id = '$id'");
        if (mysqli_num_rows($sql_cat_edit) > 0) {
            while ($row = mysqli_fetch_assoc($sql_cat_edit)) {?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control-file" id="cat_img" name="cat_img" accept="image/*" />
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Name <span style="color: red;">*</span> </label>
            <input type="text" class="form-control" id="cat_name" placeholder="Example: Grocery" name="cat_name"
                value="<?php echo get_safe_value($row['cat_name']) ?>" >
            <input type="hidden" class="form-control" id="cat_id" name="cat_id"
                value="<?php echo get_safe_value($row['cat_id']) ?>" required>    
        </div>
    </div>
</div>
<?php  } } } } ?>