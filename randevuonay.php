<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaman Eğitim</title>
    <link rel="stylesheet" href="onay.css">
</head>

<body>
    <div id="successContainer" class="success-container">
        <div class="success-icon">✔</div>
        <div class="success-message">
            Tebrikler! Randevunuz başarı ile alınmıştır.<br>
            Gerekli bilgiler, belirttiğiniz e-mail adresinize en kısa sürede gönderilecektir. <br>
            İlginiz ve güveniniz için teşekkür ederiz.
        </div>
        <div id="loadingContainer" class="loading-container">
            <div class="loading-message">Lütfen bekleyin...</div>
            <img src="https://www.superiorlawncareusa.com/wp-content/uploads/2020/05/loading-gif-png-5.gif" alt="Yükleniyor" class="loading-gif">
        </div>
    </div>

    <script>
        // Sayfa yüklendiğinde çalışacak fonksiyon
        window.onload = function() {
            // 5000 milisaniye (5 saniye) bekleyip sonra belirtilen sayfaya yönlendir
            setTimeout(function() {
                window.location.href = 'anasayfa.php';
            }, 2000);
        };
    </script>
</body>
</html>
