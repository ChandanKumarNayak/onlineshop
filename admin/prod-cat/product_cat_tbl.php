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
        $sql_cat = mysqli_query($db, "SELECT * FROM product_cat ORDER BY cat_id DESC");
        if (mysqli_num_rows($sql_cat) > 0) {
        $i = 1;
        while ($row_cat = mysqli_fetch_assoc($sql_cat)) { ?>
        <tr><td><?php echo $i ?></td>
                            <td><a target="_blank" href="<?php echo PROD_CAT_IMAGE_PATH . get_safe_value($row_cat['cat_img']) ?>"><img src="<?php echo PROD_CAT_IMAGE_PATH . get_safe_value($row_cat['cat_img']) ?>"
                                    class="tbl-inside-img" /></a></td>
                            <td><?php echo get_safe_value($row_cat['cat_name']) ?></td>
                            <?php
                                    $status_clr = "";
                                    if ($row_cat['cat_status'] == 'Active') {
                                        $status_clr = "bg-gradient-success";
                                    } else {
                                        $status_clr = "bg-gradient-secondary";
                                    }

                                    ?>
                            <td><a type="button" class="btn btn-block <?php echo $status_clr ?> btn-sm btn-cat-status" data-id="<?php echo get_safe_value($row_cat['cat_id']) ?>" data-type="cat_status"><?php echo get_safe_value($row_cat['cat_status']) ?></a>
                            </td>
                            <td><a type="button" class="btn btn-block bg-gradient-primary btn-sm btn-cat-edit" data-toggle="modal" data-target="#modal-edit-cat" data-id="<?php echo get_safe_value($row_cat['cat_id']) ?>" data-type="cat_edit"><i
                                        class="fa fa-edit"></i>&nbsp;Edit</a></td>
                            <td><a type="button" class="btn btn-block bg-gradient-danger btn-sm btn-cat-dlt"
                                    data-id="<?php echo get_safe_value($row_cat['cat_id']) ?>" data-type="cat_dlt"><i
                                        class="fa fa-trash-alt"></i>&nbsp;Delete</a></td></tr>
                                        <?php $i++;  } } ?>
        