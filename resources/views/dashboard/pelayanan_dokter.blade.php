<x-dashboard.main title="Pelayanan Dokter">
  @if (Auth::user()->role === 'admin')
    <div class="flex flex-col gap-5">
      @foreach (['PELAYANAN_DOKTER'] as $item)
        <div class="flex flex-col w-full border-back rounded-xl overflow-hidden">
          <div class="p-5 bg-white sm:p-7 rounded-t-xl">
            <div class="flex items-center">

              <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                {{ str_replace('_', ' ', $item) }}
              </h1>
            </div>
            <p class="text-sm opacity-60">
              Jelajahi dan ketahui pelayanan dokter.
            </p>
          </div>
        </div>
      @endforeach
      <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-3">
        @foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $item)
          <label for="add_data_{{ $item }}" class="flex flex-row items-center gap-3 cursor-pointer card rounded-xl py-4 px-6 border border-primary">
            <x-lucide-scroll-text class="size-6 stroke-[1]" />
            <h1 class="font-semibold">{{ $item }}</h1>
          </label>
        @endforeach
      </div>
    </div>
  @else
  @endif
  <div class="w-full min-h-[100vh]" id="cl1"></div>
</x-dashboard.main>

<input type="checkbox" id="add_data_PELAYANAN_DOKTER_EVALUASI_v1" class="modal-toggle" />
<div class="modal" role="dialog" id="PELAYANAN_DOKTER_EVALUASI">
  <form onsubmit="setupFormGenerate(this, 'PELAYANAN_DOKTER_EVALUASI', 'bkiabi-pelayanan-dokter.pdf')" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Pelayanan Dokter v1</h3>
    <div id="container" class="flex flex-col w-full gap-2 mt-5">
    </div>
    <div class="modal-action">
      <label for="add_data_PELAYANAN_DOKTER_EVALUASI_v1" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>

<input type="checkbox" id="add_data_PELAYANAN_DOKTER_EVALUASI_v2" class="modal-toggle" />
<div class="modal" role="dialog" id="PELAYANAN_DOKTER_EVALUASI">
  <form onsubmit="generateOutputForm()" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Pelayanan Dokter v2</h3>
    <div id="pdf_form_PELAYANAN_DOKTER_EVALUASI" class="w-full mt-5 rounded-lg overflow-hidden">
    </div>
    <div class="modal-action">
      <label for="add_data_PELAYANAN_DOKTER_EVALUASI_v2" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>

<script>
  window.onload = async () => {
    // setupRenderListing({
    //   id: 'PELAYANAN_DOKTER_EVALUASI'
    // })

    const setupForm = await setupPDFDesign({
      file: 'bkiabi-pelayanan-dokter.pdf',
      schemas: 'PELAYANAN_DOKTER_EVALUASI',
    //   id: 'pdf_form_PELAYANAN_DOKTER_EVALUASI',
      id: 'cl1'
    })

    // console.log(setupForm.getInputs()[0])

    // window.generateOutputForm = () => {
    //   generatePDF({
    //     template: setupForm.getTemplate(),
    //     inputs: setupForm.getInputs()[0]
    //   })
    // }
  }
</script>
