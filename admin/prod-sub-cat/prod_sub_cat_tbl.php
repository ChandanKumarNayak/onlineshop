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
        $sql_sub_cat = mysqli_query($db, "SELECT psc.sub_cat_img,psc.sub_cat_name,pc.cat_name,psc.sub_cat_status,psc.sub_cat_id FROM prod_sub_cat as psc INNER JOIN product_cat as pc ON psc.cat_id = pc.cat_id ORDER BY psc.sub_cat_id DESC");
        if (mysqli_num_rows($sql_sub_cat) > 0) {
        $i = 1;
        while ($row_sub_cat = mysqli_fetch_assoc($sql_sub_cat)) { ?>
        <tr><td><?php echo $i ?></td>
                            <td><a target="_blank" href="<?php echo PROD_SUBCAT_IMAGE_PATH . get_safe_value($row_sub_cat['sub_cat_img']) ?>"><img src="<?php echo PROD_SUBCAT_IMAGE_PATH . get_safe_value($row_sub_cat['sub_cat_img']) ?>"
                                    class="tbl-inside-img" /></a></td>
                            <td><?php echo get_safe_value($row_sub_cat['sub_cat_name']) ?></td>
                            <td><?php echo get_safe_value($row_sub_cat['cat_name']) ?></td>
                            <?php
                                    $status_clr = "";
                                    if ($row_sub_cat['sub_cat_status'] == 'Active') {
                                        $status_clr = "bg-gradient-success";
                                    } else {
                                        $status_clr = "bg-gradient-secondary";
                                    }

                                    ?>
                            <td><a type="button" class="btn btn-block <?php echo $status_clr ?> btn-sm btn-sub-cat-status" data-id="<?php echo get_safe_value($row_sub_cat['sub_cat_id']) ?>" data-type="sub_cat_status"><?php echo get_safe_value($row_sub_cat['sub_cat_status']) ?></a>
                            </td>
                            <td><a type="button" class="btn btn-block bg-gradient-primary btn-sm btn-sub-cat-edit" data-toggle="modal" data-target="#modal-edit-sub-cat" data-id="<?php echo get_safe_value($row_sub_cat['sub_cat_id']) ?>" data-type="sub_cat_edit"><i
                                        class="fa fa-edit"></i>&nbsp;Edit</a></td>
                            <td><a type="button" class="btn btn-block bg-gradient-danger btn-sm btn-sub-cat-dlt"
                                    data-id="<?php echo get_safe_value($row_sub_cat['sub_cat_id']) ?>" data-type="sub_cat_dlt"><i
                                        class="fa fa-trash-alt"></i>&nbsp;Delete</a></td></tr>
                                        <?php $i++;  } } ?>
        