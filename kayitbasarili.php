<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaman Eğitim</title>
    <link rel="stylesheet" href="onay.css">
</head>

<body class="onay">
    <div id="successContainer" class="success-container">
        <div class="success-icon">✔</div>
        <div class="success-message">
           Ailemize Hoşgeldin! Kayıt işlemi başarıyla gerçekleştirildi. <br>
           
        </div>
        <div id="loadingContainer" class="loading-container">
            <div class="loading-message">Giriş ekranına yönlendiriliyorsunuz...</div>
            <img src="https://www.superiorlawncareusa.com/wp-content/uploads/2020/05/loading-gif-png-5.gif" alt="Yükleniyor" class="loading-gif">
        </div>
    </div>

    <script>
        // Sayfa yüklendiğinde çalışacak fonksiyon
        window.onload = function() {
            // 5000 milisaniye (5 saniye) bekleyip sonra belirtilen sayfaya yönlendir
            setTimeout(function() {
                window.location.href = 'register.php';
            }, 5000);
        };
    </script>
</body>
</html>
