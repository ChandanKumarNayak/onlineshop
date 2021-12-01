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

    if($type == 'sub_cat_edit'){
        $sql_sub_cat_edit = mysqli_query($db, "SELECT psc.sub_cat_img,psc.sub_cat_name,pc.cat_name,psc.sub_cat_id,psc.cat_id FROM prod_sub_cat as psc INNER JOIN product_cat as pc ON psc.cat_id = pc.cat_id WHERE psc.sub_cat_id = '$id'");
        if (mysqli_num_rows($sql_sub_cat_edit) > 0) {
            while ($row = mysqli_fetch_assoc($sql_sub_cat_edit)) {?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control-file" id="sub_cat_img" name="sub_cat_img" accept="image/*" />
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Name <span style="color: red;">*</span> </label>
            <input type="text" class="form-control" id="sub_cat_name" placeholder="Example: Atta, Flours and Sooji" name="sub_cat_name"
                value="<?php echo get_safe_value($row['sub_cat_name']) ?>">
            <input type="hidden" class="form-control" id="sub_cat_id" name="sub_cat_id"
                value="<?php echo get_safe_value($row['sub_cat_id']) ?>" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Category <span style="color: red;">*</span> </label>
            <select class="form-control" name="cat_id">
                <option value="<?php echo get_safe_value($row['cat_id']) ?>" selected><?php echo get_safe_value($row['cat_name']) ?></option>
                <?php 
                                $sql_show_cat = "SELECT * FROM product_cat WHERE cat_id !={$row['cat_id']} ORDER BY cat_name ASC";
                                $query_show_cat = mysqli_query($db,$sql_show_cat);  
                                if(mysqli_num_rows($query_show_cat) > 0)
                                while($row = mysqli_fetch_assoc($query_show_cat)) { ?>
                <option value="<?php echo get_safe_value($row['cat_id']) ?>">
                    <?php echo get_safe_value($row['cat_name']) ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<?php  } } } } ?>