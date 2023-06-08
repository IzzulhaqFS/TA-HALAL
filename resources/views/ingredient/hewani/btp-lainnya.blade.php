<div id="btp-lainnya-container" class="mt-6">
    <hr>
    <h2 class="mt-4"><b>-- Pengecekan BTP Lainnya --</b></h2>
    <div id="btp-lainnya-detail" class="main-activity" 
    data-pos="" 
    data-label="Cek Sertifikat Halal BTP Lainnya" 
    data-value="">
        <div class="mt-3">
            <label for="regular-form-1" class="form-label font-medium">Apakah BTP lain telah bersertifikat halal? <span class="text-danger">*</span></label>
            <select id="is-btp-lainnya-certified-select" class="form-control" name="is-btp-lainnya-certified">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('is-btp-lainnya-certified') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah BTP lain telah bersertifikat halal?">Iya</option>
                <option value="0" {{ old('is-btp-lainnya-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="" data-label="Apakah BTP lain telah bersertifikat halal?">Belum</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Merk BTP Lain</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Merk BTP Lain" name="merk-btp-lainnya" placeholder="Merk BTP Lain">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Kode E BTP Lain</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Kode E BTP Lain" name="kode-e-btp-lainnya" placeholder="Kode E BTP Lain">
        </div>
        <div class="mt-3">
            <label for="regular-form-1" class="form-label">Produsen BTP Lain</label>
            <input type="text" class="form-control sub-activity" data-pos="" data-label="Produsen BTP Lain" name="produsen-btp-lainnya" placeholder="Produsen BTP Lain">
        </div>
    </div>
    
    <div id="btp-lainnya-certificate-detail" class="main-activity" style="display: none;"
        data-pos="" 
        data-label="Cek Informasi Sertifikat Halal BTP Lainnya" 
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
    let isBTPLainnyaCertifiedSelectEl = document.querySelector('#is-btp-lainnya-certified-select');
    let btpLainnyaDetailEl = document.querySelector('#btp-lainnya-detail');
    let btpLainnyaCertDetailEl = document.querySelector('#btp-lainnya-certificate-detail');
    
    isBTPLainnyaCertifiedSelectEl.addEventListener('change', function() {
        if (isBTPLainnyaCertifiedSelectEl.value === "1") {
            displayElements(btpLainnyaCertDetailEl);
            btpLainnyaDetailEl.setAttribute('data-value', 'Halal');
            btpLainnyaCertDetailEl.setAttribute('data-value', 'Halal');
        } else {
            hideElements(btpLainnyaCertDetailEl);
            btpLainnyaDetailEl.setAttribute('data-value', 'Haram');
            removeActivityValue(btpLainnyaCertDetailEl);
        }
    });
</script>