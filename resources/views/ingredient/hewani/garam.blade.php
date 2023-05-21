<div id="garam-container" class="mt-6">
    <h2 class="mt-4"><b>-- Pengecekan Garam --</b></h2>
    <div id="garam-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Garam" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Garam</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Garam" name="merk-garam" placeholder="Merk Garam">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Garam</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Garam" name="kode-e-garam" placeholder="Kode E Garam">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Garam</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Garam" name="produsen-garam" placeholder="Produsen Garam">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Apakah garam telah bersertifikat halal?</label>
            <select id="is-garam-certified-select" class="form-control" name="is-garam-certified">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('is-garam-certified') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah garam telah bersertifikat halal?">Iya</option>
                <option value="0" {{ old('is-garam-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah garam telah bersertifikat halal?">Tidak</option>
            </select>
        </div>
    </div>
    
    <div id="garam-certificate-detail" class="main-activity" 
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal Garam" 
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
    let isGaramCertifiedSelectEl = document.querySelector('#is-garam-certified-select');
    let garamDetailEl = document.querySelector('#garam-detail');
    let garamCertDetailEl = document.querySelector('#garam-certificate-detail');
    
    isGaramCertifiedSelectEl.addEventListener('change', function() {
        if (isGaramCertifiedSelectEl.value === "1") {
            garamCertDetailEl.style.display = 'block';
            garamDetailEl.setAttribute('data-value', 'Halal');
            garamCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            garamCertDetailEl.style.display = 'none';
            garamDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(garamCertDetailEl);
        }
    });
</script>