document.addEventListener("DOMContentLoaded", function () {
    var dersSecim = document.getElementById("ders_secim");

    // localStorage'den daha önce kaydedilen ders bilgisini al
    var savedDersValue = localStorage.getItem('selectedDersValue');

    // Eğer kaydedilmiş bir ders bilgisi varsa, seçim alanında o değeri seçili yap
    if (savedDersValue) {
        dersSecim.value = savedDersValue;
        
    }

    // Ders seçim alanında değişiklik olduğunda çalışacak olan fonksiyon
    function handleDersChange() {
        var selectedDersValue = dersSecim.value;

        // localStorage'e kaydedilmiş ders değeri ile seçili ders değeri aynı değilse kaydet ve formu submit et
        if (selectedDersValue !== savedDersValue) {
            // Seçilen dersin değerini localStorage'e kaydet
            localStorage.setItem('selectedDersValue', selectedDersValue);

            var form = dersSecim.closest("form");

            // Check if the form has already been submitted to avoid a loop
            if (!form.hasAttribute('data-submitted')) {
                // Mark the form as submitted
                form.setAttribute('data-submitted', 'true');

                // Submit the form
                form.submit();
            }
        }
    }

    // Ders seçim alanındaki değişiklikleri dinle
    dersSecim.addEventListener("change", handleDersChange);

    // Sayfa ilk yüklendiğinde ders seçim alanını kontrol et
    handleDersChange();
});

function localStorageClear() {
    localStorage.clear();
}


