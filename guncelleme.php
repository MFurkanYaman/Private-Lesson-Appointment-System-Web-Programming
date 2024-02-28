<?php
include 'baglanti.php';
session_start();
if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    header("Location: register.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="2110.css">
    <title>Yaman Eğitim</title>
    <link rel="icon" href="resim/logo.png">
</head>
<body>



<div class="giris" id="giris_ekrani">
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                        alt="illustration" class="illustration" />
                        <h1 class="opacity" style="opacity: 0.85;">Şifre Yenileme</h1>
                    <form method="POST">
                        <input type="password" placeholder="Eski Şifrenizi Giriniz" name="eski_sifre"/>
                        <input type="password" placeholder="Yeni  Şifrenizi Giriniz" name="yeni_sifre"/>
                        <button class="opacity" name="kullanicigiris" type="submit">Şifreyi Güncelle</button>

                    </form>
                    <div class="register-forget opacity">
                        <a href="anasayfa.php">Ana Menüye Dön</a>
                    </div>
                </div>
                <div class="circle circle-two"></div>
            </div>
            <div class="theme-btn-container"></div>
        </section>
    </div>






</body>
</html>


<?php
include 'baglanti.php';

if (isset($_POST['kullanicigiris'])) {
    session_start();
    $email = $_SESSION["email"]; // Session'dan e-posta alındı
    $eskiSifre = $_POST["eski_sifre"]; // Formdan eski şifre alındı
    $yeniSifre = $_POST["yeni_sifre"]; // Formdan yeni şifre alındı

    // Eski şifreyi kontrol et
    $kullanicisor = "SELECT * FROM ogrenci WHERE mail='$email'";
    $kullaniciSorCalistir = mysqli_query($baglan, $kullanicisor);

    if (!$kullaniciSorCalistir) {
        echo "Veritabanı hatası.";
    }

    $gelenKayitSayi = mysqli_num_rows($kullaniciSorCalistir);

    if ($gelenKayitSayi > 0) {
        $mevcut_kayit = mysqli_fetch_assoc($kullaniciSorCalistir);
        $veritabanindakiHashliSifre = $mevcut_kayit["sifre"];

        // Girilen eski şifreyi, veritabanından çekilen hashlenmiş şifre ile karşılaştır
        if (password_verify($eskiSifre, $veritabanindakiHashliSifre)) {
            // Eğer eski şifre doğru ise, yeni şifreyi güncelle
            $yeniHashliSifre = password_hash($yeniSifre, PASSWORD_DEFAULT);
            $guncelleSorgu = "UPDATE ogrenci SET sifre='$yeniHashliSifre' WHERE mail='$email'";
            $guncelleCalistir = mysqli_query($baglan, $guncelleSorgu);

            if (!$guncelleCalistir) {
                echo "Şifre güncellenirken hata oluştu: " . mysqli_error($baglan);
            } else {
                echo "<script>alert('Şifreniz başarıyla güncellendi.Lütfen yeniden giriş yapınız.'); setTimeout(function(){ window.location.href = 'register.php'; }, 0000);</script>";
            }
        } else {
            echo "<script>alert('Eski şifrenizi yanlış girdiniz güncelleme işlemi gerçekleştirilemedi.');</script>";
           
        }
    }
}


?>
