function showSelectedAppointmentInfo(selectedDate, selectedTime) {
    var sil_saat = selectedTime;
        var sil_tarih = selectedDate;

        // Form elemanlarını oluştur
        var form = document.createElement("form");
        form.method = "POST";
        form.style.display = "none"; // Formu görünmez yap

        // Input elemanlarını oluştur ve form içine ekle
        var sil_tarih_input = document.createElement("input");
        sil_tarih_input.type = "hidden";
        sil_tarih_input.name = "sil_tarih";
        sil_tarih_input.value = sil_tarih;
        form.appendChild(sil_tarih_input);

        var sil_saat_input = document.createElement("input");
        sil_saat_input.type = "hidden";
        sil_saat_input.name = "sil_saat";
        sil_saat_input.value = sil_saat;
        form.appendChild(sil_saat_input);

        // Formu sayfaya ekle
        document.body.appendChild(form);

        // Formu gönder
        form.submit();
}

function confirmDelete() {
    var confirmDelete = confirm("Bu randevuyu silmek istediğinize emin misiniz?");
    if (confirmDelete) {
        // User clicked "OK", proceed with form submission
        document.getElementById("silRandevuForm").submit();
    } else {
        // User clicked "Cancel", do nothing
    }
}


// function randevuSil() {
//     // Seçilen randevunun tarihini ve saati al
//     var sil_tarih = document.getElementById("appointment-date").value;
//     var sil_saat = document.getElementById("appointment-time").value;

//     console.log("Sil Tarih: " + sil_tarih);
//     console.log("Sil Saat: " + sil_saat);

//     // PHP kodunu içeren bir form oluştur
//     var form = document.createElement("form");
//     form.method = "POST";
//     form.action = "randevu.php";

//     // Input elemanlarını form içine ekle
//     var sil_tarih_input = document.createElement("input");
//     sil_tarih_input.type = "hidden";
//     sil_tarih_input.name = "sil_tarih";
//     sil_tarih_input.value = sil_tarih;
//     form.appendChild(sil_tarih_input);

//     var sil_saat_input = document.createElement("input");
//     sil_saat_input.type = "hidden";
//     sil_saat_input.name = "sil_saat";
//     sil_saat_input.value = sil_saat;
//     form.appendChild(sil_saat_input);

//     // Formu sayfaya ekleyin
//     document.body.appendChild(form);

//     // Formu gönderin
//     form.submit();
// }
