<?php

include 'db.php';

function encode_gpu($xvid,$xdevid,$xhash){
 
    include 'db.php';  
   
    switch($xvid){

    case "8086":
    $mname="intel";
    break;
    case "10de":
    $mname="nvidia";
    break;
    case "5533":
    $mname="s3";
    break;
    case "121a":
    $mname="3dfx";
    break; 
    case "18ca":
    $mname="XGI Technology";
    break;
    case "1023":
    $mname="Trident Microsystems";
    break; 
    case "1092":
    $mname="Diamond Multimedia Systems";
    break;
    case "1002":
    $mname="amd";
    break;  
    case "1022":
    $mname="amd";
    break;
    case "1412":
    $mname="via";
    break;
    case "1106":
    $mname="via";
    break;
    case "15ad":
    $mname="vmware";
    break;
    case "fffe":
    $mname="vmware";
    break;
    case "1013":
    $mname="cirrus logic";
    break;
    case "1039":
    $mname="sis";
    break;
    case "102b":
    $mname="matrox";
    break;
    case "10c8":
    $mname="neomagic";
    break;
    case "100c":
    $mname="tseng electronics";
    break;
    case "1a03":
    $mname="ASPEED Technology";
    break;
    case "1142":
    $mname="Alliance Semiconductor";
    break;
    case "edd8":
    $mname="Ark Logic";
    break;
    case "102c":
    $mname="Chips and Technologies";
    break;
    case "105d":
    $mname="Number 9 Computer Company";
    break;
    case "126f":
    $mname="Silicon Motion";
    break;
    case "1011":
    $mname="digital equipment corp.";
    break;
    case "1078":
    $mname="Cyrix";
    break;
    case "10a9":
    $mname="Silicon Graphics";
    break;
    case "100b":
    $mname="national semiconductor";
    break;
    case "1163":
    $mname="rendition";
    break;
    case "80ee":
    $mname="virtual box";
    break;
    case "10e0":
    $mname="Integrated Micro Solutions";
    break;
    case "104e":
    $mname="Oak Technology";
    break;
    case "003d":
    $mname="Lockheed Martin-Marietta";
    break;
    case "10b4":
    $mname="STB Systems";
    break;
    case "1179":
    $mname="Toshiba";
    break;
    case "1115":
    $mname="3D Labs";
    break;
    case "3d3d":
    $mname="3D Labs";
    break; 
    case "104c":
    $mname="Texas Instruments";
    break;
    default:
    $mname="unknown";

    }

    $sql = "INSERT INTO tbl_gpu_log (vendor, device, manufacturer, hash, date_) VALUES ('" . $xvid . "', '" . $xdevid . "', '" . $mname . "', '" . $xhash . "','". date('Y-m-d') ."')";

    if ($conexec->query($sql) == TRUE) {
     echo "New record created successfully";
    }

    $conexec->close();

}


if ($conexec->connect_error) {
  die("Connection failed");
} 

if (! isset($_GET['vid']) || ! isset($_GET['devid']) || ! isset($_GET['hash'])) {
 echo "Forbidden";
 exit;
}

$xvid=addslashes(strtolower($_GET['vid']));
$xdevid=addslashes(strtolower($_GET['devid']));
$xhash=addslashes(strtolower($_GET['hash']));

if (strlen($xvid)>6 ) {
 echo "Invalid vendor id";
 exit;
}

if (strlen($xdevid)>6) {
 echo "Invalid device id";
 exit;
}

if (strlen($xhash)>32) {
 echo "Invalid hash";
 exit;
}

if (! ctype_xdigit($xvid)) {
 echo "Invalid vendor id";
 exit;
}

if (! ctype_xdigit($xdevid)) {
 echo "Invalid device id";
 exit;
}

if (! ctype_xdigit($xhash)) {
 echo "Invalid hash";
 exit;
}

$xsql="select * from tbl_gpu_log where vendor='". $xvid . "' and device='" . $xdevid .  "' and hash='" . $xhash . "'";

if ($result=mysqli_query($con,$xsql))
{
  $rowcount=mysqli_num_rows($result);
  if ($rowcount==0){
   encode_gpu($xvid,$xdevid,$xhash);
  } 
  else 
  {
   echo "Already registered";
  } 
}

mysqli_free_result($result);
mysqli_close($con);

?>