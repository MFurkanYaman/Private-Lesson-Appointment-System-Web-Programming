<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "baglanti.php";
include 'bar.php';

$ogretmenler = [];

// Session değişkenlerine erişmek için session başlat
session_start();

// Kullanıcı giriş yapmamışsa veya oturumu başlatılmamışsa, giriş sayfasına yönlendir
if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    header("Location: register.php");
    exit();
}

// Dersleri veritabanından çek
$ders_sorgu = mysqli_query($baglan, "SELECT * FROM ders");

if (!$ders_sorgu) {
    print_r(mysqli_error($baglan));
} else {
    $dersler = mysqli_fetch_all($ders_sorgu, MYSQLI_ASSOC);
}

// Ders seçtikten sonra o dersin öğretmenlerini getir
if (isset($_POST["ders_secim"])) {
    $dersAd = $_POST["ders_secim"];

    // Ders ID'sini al
    $ders_id_sorgu = mysqli_query($baglan, "SELECT ders_id FROM ders WHERE ders_ad = '$dersAd'");

    if (!$ders_id_sorgu) {
        die("Ders ID'si bulunamadı: " . mysqli_error($baglan));
    }

    $ders_id_row = mysqli_fetch_assoc($ders_id_sorgu);
    $ders_id = $ders_id_row['ders_id'];

    // Öğretmenleri seç
    $ogretmen_sorgu = mysqli_query($baglan, "SELECT `ogretmen_id`, `ogretmen_ad`, `ogretmen_soyad` FROM `ogretmen` WHERE ders_id = $ders_id");

    if (!$ogretmen_sorgu) {
        die("Öğretmenler bulunamadı: " . mysqli_error($baglan));
    } else {
        $ogretmenler = mysqli_fetch_all($ogretmen_sorgu, MYSQLI_ASSOC);
    }
}



if (isset($_POST["randevu_al"])) {
    $email = $_SESSION["email"];
    $sifre = $_SESSION["sifre"]; // Bu satırı kullanmıyorsunuz gibi görünüyor

    $ogrenci_sorgu = mysqli_query($baglan, "SELECT * FROM ogrenci WHERE mail='$email'");

    if (!$ogrenci_sorgu) {
        die("Öğrenci bilgileri çekilemedi: " . mysqli_error($baglan));
    }


    $ogrenci_bilgisi = mysqli_fetch_assoc($ogrenci_sorgu);
    $ogr_id = $ogrenci_bilgisi["ogr_id"];

    // Formdan gelen verileri al
    $ders_secim = $_POST["ders_secim"];
    $ogretmen_secim = $_POST["ogretmen_secim"];
    $saat = $_POST["appointment-time"];
    $gun = $_POST["appointment-date"];

    // Öğrenci ID'sini session'dan al
    // $ogr_id = $_SESSION["ogr_id"];

    // Öğretmen adı ve soyadını ayır
    $ogretmen_ad_soyad = explode(" ", $ogretmen_secim);
    $ogretmen_ad = $ogretmen_ad_soyad[0];
    $ogretmen_soyad = $ogretmen_ad_soyad[1];

    // Ders ID'sini al
    $ders_id_sorgu = mysqli_query($baglan, "SELECT ders_id FROM ders WHERE ders_ad = '$ders_secim'");
    $ders_id_row = mysqli_fetch_assoc($ders_id_sorgu);
    $ders_id = $ders_id_row['ders_id'];

    // Öğretmen ID'sini al
    $ogretmen_id_sorgu = mysqli_query($baglan, "SELECT ogretmen_id FROM ogretmen WHERE ogretmen_ad = '$ogretmen_ad' AND ogretmen_soyad = '$ogretmen_soyad'");
    $ogretmen_id_row = mysqli_fetch_assoc($ogretmen_id_sorgu);
    $ogretmen_id = $ogretmen_id_row['ogretmen_id'];

    //kontrol

    $kontrol="SELECT * FROM randevu WHERE (saat='$saat' AND gun='$gun' AND ogretmen_id='$ogretmen_id')";
    $kontrolCalistir = mysqli_query($baglan, $kontrol);
    $durum=mysqli_num_rows($kontrolCalistir);

    $kontrol2="SELECT * FROM randevu WHERE (saat='$saat' AND gun='$gun' AND ogr_id='$ogr_id')";
    $kontrolCalistir2 = mysqli_query($baglan, $kontrol2);
    $durum2=mysqli_num_rows($kontrolCalistir2);


    // Randevu bilgilerini veritabanına ekle
    $randevu_ekle_query = "INSERT INTO randevu (ogr_id, ders_id, ogretmen_id, saat, gun) VALUES ('$ogr_id', '$ders_id', '$ogretmen_id', '$saat', '$gun')";

    echo $durum;
    if($durum==0 && $durum2==0)
    {
        if (mysqli_query($baglan, $randevu_ekle_query)) {
            header("location:randevuonay.php");
            
            
        } else {
            echo "Randevu alınamadı: " . mysqli_error($baglan);
        }

    }
    else if($durum!=0 and $durum2==0){
        echo "<script>alert('Bu saatte eğitmenimizin başka bir randevusu bulunmaktadır.');</script>";
    }
    else if($durum2!=0){
        echo "<script>alert('Bu tarih ve saatte başka bir eğitmenimizine randevunuz bulunmaktadır.');</script>";

    }
    

   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaman Eğitim</title>
    <link rel="stylesheet" href="bar.css">
    <link rel="stylesheet" href="randevu.css">
    <link rel="stylesheet" href="odeme.css">
</head>

<body class="randevu" stylesheet>
    <div class="adsoyad" id="adsoyad_id">
        <h3>Sn. <?php echo $_SESSION["adsoyad"]; ?> Hoşgeldiniz.</h3>
    </div>

    <div class="orta_div" id="randevu_div">

    
 



        <form method="POST" id="randevuForm">
            <label for="ders_secim">Ders Seç:</label>
            <select name="ders_secim" id="ders_secim">
                <option value="" selected disabled>Ders Seçin</option>
                <?php foreach ($dersler as $ders): ?>
                    <option value="<?php echo $ders['ders_ad']; ?>" class="ders"><?php echo $ders['ders_ad']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="ogretmen_secim">Öğretmen Seçin:</label>
            <select name="ogretmen_secim" id="ogretmen_secim">
                <option value="" selected disabled>Öğretmen</option>
                <?php foreach ($ogretmenler as $ogretmen): ?>
                    <option value="<?php echo $ogretmen['ogretmen_ad'] . " " . $ogretmen['ogretmen_soyad']; ?>">
                        <?php echo $ogretmen['ogretmen_ad'] . " " . $ogretmen['ogretmen_soyad']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="appointment-date">Tarih Seçin:</label>
            <input type="date" id="appointment-date" name="appointment-date" min="">

            <label for="ogretmen_secim">Saat Seçin:</label>
            <select id="appointment-time" name="appointment-time" class="form-control">
                <option disabled selected value="">Saat Seçin</option>
                <?php foreach (range(9, 17) as $hour): ?>
                    <?php foreach ([0] as $minute): ?>
                        <?php
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        if ($time !== "12:00") :
                        ?>
                            <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>

       

            <button type="submit" name="randevu_al"onclick="onayKontrol()" id="randevubutonu" >Randevu Al</button>
        </form>
    </div>







    <div class="orta_div" id="resim_div" >
 
    <form id="odeme" class="arka">
        <label for="ad">Ad Soyad:</label>
        <input type="text" id="ad" name="ad" class="a" >

        <label for="kart-no">Kart No:</label>
        <input type="number" id="kart-no" name="kart-no" class="a" required>

        <label for="son-tarih">Son Kullanma Tarihi (MM/YY):</label>
        <input type="text" id="son-tarih" name="son-tarih" placeholder="MM/YY" class="a" pattern="(0[1-9]|1[0-2])\/([0-9]{2})" title="Geçerli bir tarih formatı girin (MM/YY)" required>


        <label for="cvv">CVV:</label>
        <input type="number" id="cvv" name="cvv" class="a" required>

        <label for="fiyat">Ücret:</label>
        <input type="text" id="cvv" name="cvv" class="a" value="300" readonly required>


        
    </form>


      



       
    </div>
    <div id="selectedAppointmentInfo"></div>
    
    
   

    <script src="getOgr.js"></script>
    <script src="iptal.js"></script>
    <script src="onay.js"></script>
</body>

</html>
<script>
    // Bugünün tarihini al
    var today = new Date().toISOString().split('T')[0];
    
    // input elementinin min özelliğine bugünün tarihini atayarak geçmiş tarih seçimini engelle
    document.getElementById('appointment-date').setAttribute('min', today);



</script>

