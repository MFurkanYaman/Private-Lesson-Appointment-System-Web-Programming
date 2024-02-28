<?php
include "baglanti.php";
session_start();

if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    header("Location: register.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Radyo düğmesinin seçilip seçilmediğini kontrol et
    if (isset($_POST["selected_appointment"])) {
        $selectedAppointmentId = $_POST["selected_appointment"];
        
        // Oturumdan öğrenci ID'sini al
        $email = $_SESSION["email"];
        $ogrenci_sorgu = mysqli_query($baglan, "SELECT `ogr_id` FROM `ogrenci` WHERE `mail`='$email'");
        
        if (!$ogrenci_sorgu) {
            die("Öğrenci bilgileri çekilemedi: " . mysqli_error($baglan));
        }

        $ogrenci_bilgisi = mysqli_fetch_assoc($ogrenci_sorgu);
        $ogr_id = $ogrenci_bilgisi["ogr_id"];

        // Veritabanından seçilen randevuyu sil
        $deleteQuery = mysqli_query($baglan, "DELETE FROM `randevu` WHERE `randevu_id`='$selectedAppointmentId' AND `ogr_id`='$ogr_id'");

        if (!$deleteQuery) {
            die("Randevu iptali başarısız: " . mysqli_error($baglan));
        } else {
            echo "<script>alert('Randevunuz iptal edilmişti. Para iadeniz 10 İŞ günü içerisinde gerçekleşecektir.');</script>";
            echo '<script>
                setTimeout(function(){ window.location.href = "randevusil.php"; }, 0);
            </script>';
        }
    } else {
        echo '<script>
        window.location.href = "randevusil.php"; 
        
      </script>';

        
    }
} else {
    // Form POST ile gönderilmediyse, ana sayfaya yönlendir
    header("Location: randevu.php");
    exit();
}
?>
