<!-- BEGIN: More -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 text-2xs ml-auto">
        <a href="javascript:;" class="underline" data-tw-toggle="modal" data-tw-target="#predict-confirmation-modal">Simpulkan sekarang</a>
        <span class="explanation">
            <i data-lucide="help-circle" class="tooltip w-3" style="margin-bottom: 0.1rem" 
                title="Memprediksi kesimpulan dengan pendekatan Machine Learning (SVM).">
            </i>
        </span> 
    </div>
    <!-- BEGIN: Predict Confirmation Modal -->
    <div id="predict-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Apakah anda yakin?</div>
                        <div class="text-slate-500 mt-2">Apakah Anda ingin mendapatkan prediksi kesimpulan sekarang dengan melewatkan form yang masih ada?
                            <br><br>
                            Proses ini tidak dapat dibatalkan. Keakuratan prediksi bergantung pada kelengkapan isian anda.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                        <button id="predict-btn" type="button" class="btn btn-danger w-24">Yakin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const predictBtnEl = document.getElementById('predict-btn');
        predictBtnEl.addEventListener('click', async function(e) {
            storeDataToSession(document.getElementById('predict-btn'))
            await processActivity('{{ csrf_token() }}', 'prediction');
        })
    </script>
    <!-- END: Predict Confirmation Modal -->
</div>
<!-- END: More -->