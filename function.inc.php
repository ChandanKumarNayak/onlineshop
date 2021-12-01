<?php
function pr($arr){
  echo '<pre>';
  print_r($arr);
}

function prx($arr){
  echo '<pre>';
  print_r($arr);
  die();
}

function get_safe_value($str){
  global $db;
  $tstr=trim($str);
  $gstr=htmlspecialchars($tstr,ENT_QUOTES);
  $pstr=mysqli_real_escape_string($db,$gstr);
  $secvar = filter_var($pstr, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  return $secvar;
}

function get_safe_email($str){
  global $db;
  $tstr=trim($str);
  $gstr=htmlspecialchars($tstr,ENT_QUOTES);
  $pstr=mysqli_real_escape_string($db,$gstr);
  $secmail = filter_var($pstr, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);
  return $secmail;
}

function dateFormat($date){
  $str=strtotime($date);
  return date('d-m-Y',$str);
}



function redirect($link){
  ?>
  <script>
  window.location.href='<?php echo $link?>';
  </script>
  <?php
  die();
}

function send_email($email,$html,$subject){
  $mail=new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host="smtp.gmail.com";
  $mail->Port=587;
  $mail->SMTPSecure="tls";
  $mail->SMTPAuth=true;
  $mail->Username="EMAIL";
  $mail->Password="PASSWORD";
  $mail->setFrom("EMAIL");
  $mail->addAddress($email);
  $mail->IsHTML(true);
  $mail->Subject=$subject;
  $mail->Body=$html;
  $mail->SMTPOptions=array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  if($mail->send()){
    //echo "done";
  }else{
    //echo "Error occur";
  }
}

function rand_str(){
  $str=str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz");
  return $str=substr($str,0,15);
  
}
?>