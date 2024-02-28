<?php

$host="localhost";
$kullanici="root";
$parola="2002galata";
$vt="vt_kurs";

$baglan=mysqli_connect($host,$kullanici,$parola,$vt);

if(!$baglan)
{
    die("Veritabanı bağlantı işlemi başarısız".mysqli_connect_error());

}else{
   // echo "Success";
   //$response['status'] = 'success';
    //echo json_encode($response);
}

?>
