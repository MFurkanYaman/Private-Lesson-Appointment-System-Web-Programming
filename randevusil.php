<?php
include "baglanti.php";
include 'bar.php';
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
    <title>Yaman Eğitim</title>
    <link rel="stylesheet" href="randevusil.css">
</head>

<body class="sil_ekrani">

<div class="outer-container">
    <div class="container">
        
        
        <form action="secilen-randevu-islem.php" method="post">
            <div>
                <?php
                // Öğrenci bilgilerini al
                $email = $_SESSION["email"];
                $ogrenci_sorgu = mysqli_query($baglan, "SELECT `ogr_id`, `ogr_ad`, `ogr_soyad` FROM `ogrenci` WHERE `mail`='$email' ");
                
                if (!$ogrenci_sorgu) {
                    die("Öğrenci bilgileri çekilemedi: " . mysqli_error($baglan));
                }

                $ogrenci_bilgisi = mysqli_fetch_assoc($ogrenci_sorgu);
                $ogr_id = $ogrenci_bilgisi["ogr_id"];

                // Öğrencinin randevularını çek
                $randevu_sorgu = mysqli_query($baglan, "
                SELECT r.*, d.ders_ad, o.ogretmen_ad, o.ogretmen_soyad
                FROM randevu r
                JOIN ders d ON r.ders_id = d.ders_id
                JOIN ogretmen o ON r.ogretmen_id = o.ogretmen_id
                WHERE r.ogr_id = '$ogr_id'
            ");
            
            $randevu_sayi = mysqli_num_rows($randevu_sorgu);
            
            if (!$randevu_sorgu) {
                die("Randevu bilgileri çekilemedi: " . mysqli_error($baglan));
            }
            
            if ($randevu_sayi > 0) {
                echo"<h2>Randevu Bilgileri</h2><br/>";
                while ($randevu = mysqli_fetch_assoc($randevu_sorgu)) {
                    
                    echo '<div>
                            <label>
                                <input type="radio" name="selected_appointment" value="' . $randevu['randevu_id'] . '"
                                    onclick="showSelectedAppointmentInfo(\'' . $randevu['gun'] . '\', \'' . $randevu['saat'] . '\')">
                                ' . date("d.m.Y", strtotime($randevu['gun'])) . " tarihinde saat " . date("H.i", strtotime($randevu['saat'])) . " - " . $randevu['ders_ad'] . " dersinden " . $randevu['ogretmen_ad'] . " " . $randevu['ogretmen_soyad'] . " Hoca'ya randevunuz bulunmaktadır.
                            </label>
                        </div>";
                }
                echo"<br/>";
            } else {
                echo"<h2>Randevu Bilgileri</h2><br/>";
                echo "Aktif Randevunuz Bulunmamaktadır!<br><br>";
                echo"<br/>";

                
              
            }
            
                ?>
            </div>

            <input type="submit" value="Randevuyu İptal Et">
        </form>
    </div>
    
</div>





</body>
</html>
