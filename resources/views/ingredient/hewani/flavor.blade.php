<div id="flavor-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan Flavor --</b></h2>
    <div id="flavor-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Flavor" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Flavor</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Flavor" name="merk-flavor" placeholder="Merk Flavor">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Flavor</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Flavor" name="kode-e-flavor" placeholder="Kode E Flavor">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Flavor</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Flavor" name="produsen-flavor" placeholder="Produsen Flavor">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Apakah flavor telah bersertifikat halal?</label>
            <select id="is-flavor-certified-select" class="form-control" name="is-flavor-certified">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('is-flavor-certified') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah flavor telah bersertifikat halal?">Iya</option>
                <option value="0" {{ old('is-flavor-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah flavor telah bersertifikat halal?">Tidak</option>
            </select>
        </div>
    </div>
    
    <div id="flavor-certificate-detail" class="main-activity" style="display: none;" 
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal Flavor" 
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
    let isFlavorCertifiedSelectEl = document.querySelector('#is-flavor-certified-select');
    let flavorDetailEl = document.querySelector('#flavor-detail');
    let flavorCertDetailEl = document.querySelector('#flavor-certificate-detail');
    
    isFlavorCertifiedSelectEl.addEventListener('change', function() {
        if (isFlavorCertifiedSelectEl.value === "1") {
            flavorCertDetailEl.style.display = 'block';
            flavorDetailEl.setAttribute('data-value', 'Halal');
            flavorCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            flavorCertDetailEl.style.display = 'none';
            flavorDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(flavorCertDetailEl);
        }
    });
</script>