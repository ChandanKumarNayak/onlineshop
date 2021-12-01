<?php include $_SERVER['DOCUMENT_ROOT']."/constant.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/db.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/function.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php"; ?>

<?php 
session_start();
if (!isset($_SESSION['ADMIN_ID'])) {
  redirect(ADMIN_LANDING_PATH.'login');
}
?>

<?php 

$type= "";
$html= "";

if(isset($_GET['type']) && $_GET['type'] != ''){

    $type = get_safe_value($_GET['type']);
    if($type == 'download_prod_sub_cat_pdf'){

        $sql = "SELECT psc.sub_cat_img,psc.sub_cat_name,pc.cat_name,psc.sub_cat_status FROM prod_sub_cat as psc INNER JOIN product_cat as pc ON psc.cat_id = pc.cat_id ORDER BY psc.sub_cat_id DESC";
        $sql_query = mysqli_query($db,$sql);
        if(mysqli_num_rows($sql_query)>0){
            $i = 1;
            $html='<html lang="en-IN">
            <head>
  <link rel="stylesheet" href="'.ADMIN_LANDING_PATH.'assets/css/custom.css">
  <style>
#pdf-tbl {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#pdf-tbl td, #pdf-tbl th {
  border: 1px solid #ddd;
  padding: 8px;
}

#pdf-tbl tr:nth-child(even){background-color: #f2f2f2;}

#pdf-tbl tr:hover {background-color: #ddd;}

#pdf-tbl th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #8080ff;
  color: white;
}
</style>
  </head>
  <body>
  <table id="pdf-tbl">
            <thead>
                <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                </tr>
            </thead>';
                while($row=mysqli_fetch_assoc($sql_query)){
                    $html.='<tbody><tr><td>'.$i.'</td><td><img src="'. PROD_SUBCAT_IMAGE_PATH . get_safe_value($row['sub_cat_img']).'" class="tbl-inside-img" /></td><td>'.get_safe_value($row['sub_cat_name']).'</td><td>'.get_safe_value($row['cat_name']).'</td><td>'.get_safe_value($row['sub_cat_status']).'</td></tr></tbody>';
                    $i++;
                }
            $html.='</table></body></html>';
        }else{
            $html="Data not found";
        }
        $mpdf=new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $file= time().'.pdf';
        $mpdf->output($file,'D');

        
    }
}

?>