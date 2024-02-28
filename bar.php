<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaman Eğitim</title>
    <link rel="icon" href="resim/logo.png">
    <link rel="stylesheet" href="bar.css">
    
</head>



<body >
    <div class="ana_menu" style="heigth: 200%" >
      
    <ul>
        <li><a href="anasayfa.php">Ana Sayfa</a></li>
        <li><a href="randevu.php" onclick=" localStorageClear()">Randevu Al</a></li>
        <li><a href="randevusil.php">Randevu Sil</a></li>
        <li><a href="register.php" class="giris/kayit" >Giriş Yap</a></li>
        <li><a href="login.php" class="giris/kayit" onclick="giris_kayit(event)">Kayıt Yap</a></li>
        <li><a href="guncelleme.php" class="giris/kayit">Şifre Güncelle</a></li>
        <li><a href="cikis.php" class="giris/kayit" onclick="giris_kayit(event)">Çıkış Yap</a></li>

        </ul>
        
    </div>

</body>
<script src="getOgr.js"></script>

</html>


