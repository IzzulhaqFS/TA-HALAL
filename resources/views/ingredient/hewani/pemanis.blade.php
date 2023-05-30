<div id="pemanis-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan Pemanis --</b></h2>
    <div id="pemanis-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal Pemanis" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label font-medium">Apakah pemanis telah bersertifikat halal? <span class="text-danger">*</span></label>
            <select id="is-pemanis-certified-select" class="form-control" name="is-pemanis-certified">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('is-pemanis-certified') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah pemanis telah bersertifikat halal?">Iya</option>
                <option value="0" {{ old('is-pemanis-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah pemanis telah bersertifikat halal?">Tidak</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk Pemanis</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk Pemanis" name="merk-pemanis" placeholder="Merk Pemanis">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E Pemanis</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E Pemanis" name="kode-e-pemanis" placeholder="Kode E Pemanis">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen Pemanis</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen Pemanis" name="produsen-pemanis" placeholder="Produsen Pemanis">
        </div>
    </div>
    
    <div id="pemanis-certificate-detail" class="main-activity" style="display: none;"
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal Pemanis" 
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
    let isPemanisCertifiedSelectEl = document.querySelector('#is-pemanis-certified-select');
    let pemanisDetailEl = document.querySelector('#pemanis-detail');
    let pemanisCertDetailEl = document.querySelector('#pemanis-certificate-detail');
    
    isPemanisCertifiedSelectEl.addEventListener('change', function() {
        if (isPemanisCertifiedSelectEl.value === "1") {
            pemanisCertDetailEl.style.display = 'block';
            pemanisDetailEl.setAttribute('data-value', 'Halal');
            pemanisCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            pemanisCertDetailEl.style.display = 'none';
            pemanisDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(pemanisCertDetailEl);
        }
    });
</script>