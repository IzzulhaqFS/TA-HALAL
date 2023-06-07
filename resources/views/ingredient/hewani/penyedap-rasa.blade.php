<div id="penyedap-rasa-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan Penyedap Rasa --</b></h2>
    <div id="penyedap-rasa-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Penyedap Rasa" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label font-medium">Status Penyedap Rasa <span class="text-danger">*</span></label>
            <select id="is-penyedap-rasa-certified-select" class="form-control" name="is-penyedap-rasa-certified">
                <option value="">-- Pilih --</option>
                <option value="alami" {{ old('is-penyedap-rasa-certified') == "alami" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Status Penyedap Rasa">Jenis penyedap rasa alami</option>
                <option value="sintetik-dengan-sertifikat-halal" {{ old('is-penyedap-rasa-certified') == "sintetik-dengan-sertifikat-halal" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Status Penyedap Rasa">Jenis penyedap rasa sintetik & telah bersertifikat halal</option>
                <option value="sintetik-tanpa-sertifikat-halal" {{ old('is-penyedap-rasa-certified') == 'sintetik-tanpa-sertifikat-halal' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Status Penyedap Rasa">Jenis penyedap rasa sintetik & belum bersertifikat halal</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Penyedap Rasa</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Penyedap Rasa" name="merk-penyedap-rasa" placeholder="Merk Penyedap Rasa">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Penyedap Rasa</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Penyedap Rasa" name="kode-e-penyedap-rasa" placeholder="Kode E Penyedap Rasa">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Penyedap Rasa</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Penyedap Rasa" name="produsen-penyedap-rasa" placeholder="Produsen Penyedap Rasa">
        </div>
    </div>
    
    <div id="penyedap-rasa-certificate-detail" class="main-activity" style="display: none;"
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal Penyedap Rasa" 
        data-value="">
        <div class="mt-4">
            <label for="regular-form-1" class="form-label">Nomor Sertifikat</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Nomor Sertifikat" name="certificate-number" placeholder="Nomor Sertifikat">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Lembaga Penerbit Sertifikat</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Lembaga Penerbit Sertifikat" name="certificate-institution" placeholder="Lembaga Penerbit Sertifikat">
        </div>
        <div style="display: flex; flex-wrap: wrap;" class="mt-1">
            <div class="mt-3">
                <label for="regular-form-1" class="form-label">Akhir Masa Berlaku</label>
                <input type="date" class="form-control sub-activity" data-pos="" data-label="Akhir Masa Berlaku" name="certificate-end-date" placeholder="Akhir Masa Berlaku">
            </div>
        </div>
    </div>
</div>

<script>
    let isPenyedapRasaCertifiedSelectEl = document.querySelector('#is-penyedap-rasa-certified-select');
    let penyedapRasaDetailEl = document.querySelector('#penyedap-rasa-detail');
    let penyedapRasaCertDetailEl = document.querySelector('#penyedap-rasa-certificate-detail');
    
    isPenyedapRasaCertifiedSelectEl.addEventListener('change', function() {
        if (isPenyedapRasaCertifiedSelectEl.value === "alami") {
            hideElements(penyedapRasaCertDetailEl);
            penyedapRasaDetailEl.setAttribute('data-value', 'Halal');
            removeActivityValue(penyedapRasaCertDetailEl);
        } else if (isPenyedapRasaCertifiedSelectEl.value === "sintetik-dengan-sertifikat-halal") {
            displayElements(penyedapRasaCertDetailEl);
            penyedapRasaDetailEl.setAttribute('data-value', 'Halal');
            penyedapRasaCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            hideElements(penyedapRasaCertDetailEl);
            penyedapRasaDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(penyedapRasaCertDetailEl);
        }
    });
</script>