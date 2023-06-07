<div id="pewarna-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan Pewarna --</b></h2>
    <div id="pewarna-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Pewarna" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label font-medium">Status Pewarna <span class="text-danger">*</span></label>
            <select id="is-pewarna-certified-select" class="form-control" name="is-pewarna-certified">
                <option value="">-- Pilih --</option>
                <option value="alami" {{ old('is-pewarna-certified') == "alami" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Status Pewarna">Jenis pewarna alami</option>
                <option value="sintetik-dengan-sertifikat-halal" {{ old('is-pewarna-certified') == "sintetik-dengan-sertifikat-halal" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Status Pewarna">Jenis pewarna sintetik & telah bersertifikat halal</option>
                <option value="sintetik-tanpa-sertifikat-halal" {{ old('is-pewarna-certified') == 'sintetik-tanpa-sertifikat-halal' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Status Pewarna">Jenis pewarna sintetik & belum bersertifikat halal</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Pewarna</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Pewarna" name="merk-pewarna" placeholder="Merk Pewarna">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Pewarna</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Pewarna" name="kode-e-pewarna" placeholder="Kode E Pewarna">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Pewarna</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Pewarna" name="produsen-pewarna" placeholder="Produsen Pewarna">
        </div>
    </div>
    
    <div id="pewarna-certificate-detail" class="main-activity" style="display: none;"
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal Pewarna" 
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
    let isPewarnaCertifiedSelectEl = document.querySelector('#is-pewarna-certified-select');
    let pewarnaDetailEl = document.querySelector('#pewarna-detail');
    let pewarnaCertDetailEl = document.querySelector('#pewarna-certificate-detail');
    
    isPewarnaCertifiedSelectEl.addEventListener('change', function() {
        if (isPewarnaCertifiedSelectEl.value === "alami") {
            hideElements(pewarnaCertDetailEl);
            pewarnaDetailEl.setAttribute('data-value', 'Halal');
            removeActivityValue(pewarnaCertDetailEl);
        } else if (isPewarnaCertifiedSelectEl.value === "sintetik-dengan-sertifikat-halal") {
            displayElements(pewarnaCertDetailEl);
            pewarnaDetailEl.setAttribute('data-value', 'Halal');
            pewarnaCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            hideElements(pewarnaCertDetailEl);
            pewarnaDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(pewarnaCertDetailEl);
        }
    });
</script>