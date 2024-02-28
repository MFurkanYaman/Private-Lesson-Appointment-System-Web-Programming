<?php
include 'baglanti.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="2110.css">
    <link rel="stylesheet" href="kayitbasarili.css">
    <link rel="icon" href="resim/logo.png">
    <title>Yaman Eğitim</title>
</head>
<body >



<div class="kayit" style="display: block;">
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                        alt="illustration" class="illustration" />
                    <h1 class="opacity">Kayıt Ol</h1>
                    <form  method="POST" onsubmit="return kayitOl()">
                        <input type="text" placeholder="Adınız"name="ad" />
                        <input type="text" placeholder="Soydınız" name="soyad"/>
                        <input type="email" placeholder="ornek@gmail.com" name="mail">
                        <input type="password" placeholder="Şifre" name="sifre" />
                        <button class="opacity">Kayıt Ol</button>
                    </form>
                    <div class="register-forget opacity">
                        <a href="register.php">Giriş Ekranı</a>
                        <a href="anasayfa.php">Ana Menüye Dön</a>
                    </div>
                </div>
                <div class="circle circle-two"></div>
            </div>
            <div class="theme-btn-container"></div>
        </section>
    </div>
    </div>

</body>
</html>

<?php

include "baglanti.php";

if(isset($_POST["ad"],$_POST["soyad"],$_POST["mail"],$_POST["sifre"]))
{
    $name=$_POST["ad"];
    $surname=$_POST["soyad"];
    $email=$_POST["mail"];
    $password=($_POST["sifre"]);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $ekle="INSERT INTO ogrenci (ogr_ad,ogr_soyad,mail,sifre) VALUES('$name','$surname','$email','$hashedPassword')";
    if($baglan->query($ekle)==TRUE)
    {
        header("location:kayitbasarili.php");

    }
    else{
        echo "<script>alert('Bu mail adresine sahip bir kullanıcı bulunmakta.');</script>";
    }
}


?>