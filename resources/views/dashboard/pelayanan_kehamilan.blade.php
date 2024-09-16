<x-dashboard.main title="Amanat Persalinan Ibu">
  @if (Auth::user()->role === 'admin')
    <div class="flex flex-col gap-5">
      @foreach (['PELAYANAN_KEHAMILAN'] as $item)
        <div class="flex flex-col w-full border-back rounded-xl">
          <div class="p-5 bg-white sm:p-7 rounded-t-xl">
            <div class="flex items-center">

              <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                {{ str_replace('_', ' ', $item) }}
              </h1>
              <div class="flex ml-auto gap-3">
                <label for="add_data_PELAYANAN_DOKTER_v1" class="btn">Tambah Data v1</label>
                <label for="add_data_PELAYANAN_DOKTER_v2" class="btn">Tambah Data v2</label>
              </div>
            </div>
            <p class="text-sm opacity-60">
              Jelajahi dan ketahui pelayanan dokter.
            </p>
          </div>
        </div>
      @endforeach
      <div class="w-full min-h-[100vh]" id="cl1"></div>
    </div>
  @else
  @endif
</x-dashboard.main>

<input type="checkbox" id="add_data_PELAYANAN_DOKTER_v1" class="modal-toggle" />
<div class="modal" role="dialog" id="PELAYANAN_DOKTER">
  <form onsubmit="setupFormGenerate(this, 'PELAYANAN_DOKTER', 'bkiabi-pelayanan-dokter.pdf')" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Pelayanan Kehamilan v1</h3>
    <div id="container" class="flex flex-col w-full gap-2 mt-5">
    </div>
    <div class="modal-action">
      <label for="add_data_PELAYANAN_DOKTER_v1" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>

<input type="checkbox" id="add_data_PELAYANAN_DOKTER_v2" class="modal-toggle" />
<div class="modal" role="dialog" id="PELAYANAN_DOKTER">
  <form onsubmit="generateOutputForm()" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Pelayanan Kehamilan v2</h3>
    <div id="pdf_form_PELAYANAN_DOKTER" class="w-full mt-5 rounded-lg overflow-hidden">
    </div>
    <div class="modal-action">
      <label for="add_data_PELAYANAN_DOKTER_v2" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>

<script>
  window.onload = async () => {
    setupRenderListing({
      id: 'PELAYANAN_DOKTER'
    })

    const setupForm = await setupPDFForm({
      file: 'bkiabi-pelayanan-dokter.pdf',
      schemas: 'PELAYANAN_DOKTER',
      id: 'pdf_form_PELAYANAN_DOKTER',
    // id: 'cl1'
    })

    window.generateOutputForm = () => {
      generatePDF({
        template: setupForm.getTemplate(),
        inputs: setupForm.getInputs()[0]
      })
    }
  }
</script>
