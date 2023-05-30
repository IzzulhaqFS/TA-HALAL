<div id="pengawet-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan Pengawet --</b></h2>
    <div id="pengawet-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Pengawet" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label font-medium">Apakah pengawet telah bersertifikat halal? <span class="text-danger">*</span></label>
            <select id="is-pengawet-certified-select" class="form-control" name="is-pengawet-certified">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('is-pengawet-certified') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah pengawet telah bersertifikat halal?">Iya</option>
                <option value="0" {{ old('is-pengawet-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah pengawet telah bersertifikat halal?">Tidak</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Pengawet</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Pengawet" name="merk-pengawet" placeholder="Merk Pengawet">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Pengawet</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Pengawet" name="kode-e-pengawet" placeholder="Kode E Pengawet">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Pengawet</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Pengawet" name="produsen-pengawet" placeholder="Produsen Pengawet">
        </div>
    </div>
    
    <div id="pengawet-certificate-detail" class="main-activity" style="display: none;"
        data-pos="" 
        data-label="Cek Informasi Halal Pengawet" 
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
    let isPengawetCertifiedSelectEl = document.querySelector('#is-pengawet-certified-select');
    let pengawetDetailEl = document.querySelector('#pengawet-detail');
    let pengawetCertDetailEl = document.querySelector('#pengawet-certificate-detail');
    
    isPengawetCertifiedSelectEl.addEventListener('change', function() {
        if (isPengawetCertifiedSelectEl.value === "1") {
            pengawetCertDetailEl.style.display = 'block';
            pengawetDetailEl.setAttribute('data-value', 'Halal');
            pengawetCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            pengawetCertDetailEl.style.display = 'none';
            pengawetDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(pengawetCertDetailEl);
        }
    });
</script>