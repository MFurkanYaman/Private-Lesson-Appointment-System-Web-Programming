function onayKontrol(event) {
    var adInput = document.getElementById("ad");
    var kartNoInput = document.getElementById("kart-no");
    var sonTarihInput = document.getElementById("son-tarih");
    var cvvInput = document.getElementById("cvv");

    if (!adInput.value || !kartNoInput.value || !sonTarihInput.value || !cvvInput.value) {
        alert("Lütfen tüm alanları doldurun.");
        event.preventDefault(); // Form gönderimini engelle
    }
    // Dolu alan varsa form gönderimini engelle, yoksa devam et
}

// Formu seç
var randevuForm = document.getElementById("randevuForm");

// Forma click event listener ekle
randevuForm.addEventListener("submit", function(event) {
    onayKontrol(event);
});
