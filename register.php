<?php
include 'baglanti.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="2110.css">
    <link rel="icon" href="resim/logo.png">
    <title>Yaman Eğitim</title>
</head>
<body>



<div class="giris" id="giris_ekrani">
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                        alt="illustration" class="illustration" />
                    <h1 class="opacity">Giriş Yap</h1>
                    <form method="POST">
                        <input type="text" placeholder="E-Mail" name="kullanici_email"/>
                        <input type="password" placeholder="Şifre" name="kullanici_password"/>
                        <button class="opacity" name="kullanicigiris" type="submit">Giriş</button>

                    </form>
                    <div class="register-forget opacity">
                        <a href="login.php">Kayıt Ol</a>

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
    $email = $_POST["kullanici_email"];
    $girilenSifre = $_POST["kullanici_password"];

    $kullanicisor = "SELECT * FROM ogrenci WHERE mail='$email'";
    $kullaniciSorCalistir = mysqli_query($baglan, $kullanicisor);

    if (!$kullaniciSorCalistir) {
        echo "Veritabanı hatası.";
    }

    $gelenKayitSayi = mysqli_num_rows($kullaniciSorCalistir);

    if ($gelenKayitSayi > 0) {
        $mevcut_kayit = mysqli_fetch_assoc($kullaniciSorCalistir);
        $veritabanindakiHashliSifre = $mevcut_kayit["sifre"];

        // Girilen şifreyi, veritabanından çekilen hashlenmiş şifre ile karşılaştır
        if (password_verify($girilenSifre, $veritabanindakiHashliSifre)) {
            session_start();

            $_SESSION["email"] = $mevcut_kayit["mail"];
            $_SESSION["adsoyad"] = $mevcut_kayit["ogr_ad"] . " " . $mevcut_kayit["ogr_soyad"];

            header("location:anasayfa.php");
            mysqli_close($baglan);
        } else {
            echo "<script>alert('Yanlış şifre.');</script>";
        }
    } else {
        echo "<script>alert('Bu bilgilere sahip bir kullanıcı bulunmamakta.');</script>";
    }
}
?>
