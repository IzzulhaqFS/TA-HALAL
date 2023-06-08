<div id="emulsifier-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan Emulsifier --</b></h2>
    <div id="emulsifier-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Emulsifier" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label font-medium">Apakah emulsifier telah bersertifikat halal? <span class="text-danger">*</span></label>
            <select id="is-emulsifier-certified-select" class="form-control" name="is-emulsifier-certified">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('is-emulsifier-certified') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah emulsifier telah bersertifikat halal?">Iya</option>
                <option value="0" {{ old('is-emulsifier-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah emulsifier telah bersertifikat halal?">Belum</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Emulsifier</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Emulsifier" name="merk-emulsifier" placeholder="Merk Emulsifier">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Emulsifier</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Emulsifier" name="kode-e-emulsifier" placeholder="Kode E Emulsifier">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Emulsifier</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Emulsifier" name="produsen-emulsifier" placeholder="Produsen Emulsifier">
        </div>
    </div>
    
    <div id="emulsifier-certificate-detail" class="main-activity" style="display: none;" 
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal Emulsifier" 
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
    let isEmulsifierCertifiedSelectEl = document.querySelector('#is-emulsifier-certified-select');
    let emulsifierDetailEl = document.querySelector('#emulsifier-detail');
    let emulsifierCertDetailEl = document.querySelector('#emulsifier-certificate-detail');
    
    isEmulsifierCertifiedSelectEl.addEventListener('change', function() {
        if (isEmulsifierCertifiedSelectEl.value === "1") {
            displayElements(emulsifierCertDetailEl)
            emulsifierDetailEl.setAttribute('data-value', 'Halal');
            emulsifierCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            hideElements(emulsifierCertDetailEl);
            emulsifierDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(emulsifierCertDetailEl);
        }
    });
</script>