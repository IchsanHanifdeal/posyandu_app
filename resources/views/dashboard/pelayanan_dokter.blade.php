<x-dashboard.main title="Amanat Persalinan Ibu">
  @if (Auth::user()->role === 'admin')
    <div class="flex gap-5 w-full">
      <div class="flex flex-col gap-5 w-full h-fit sticky top-[5.5rem]">
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
        <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-5">
          @foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $item)
            <label for="add_data_{{ str_replace(' ', '_', $item) }}" class="flex flex-row items-center gap-3 cursor-pointer card rounded-xl py-3 px-6 border border-primary">
              <x-lucide-scroll-text class="size-6 stroke-[1]" />
              <h1 class="font-semibold">{{ $item }}</h1>
            </label>
          @endforeach
        </div>
      </div>

      <div class="w-full hidden" id="container_surat">
        <div class="flex items-center ml-auto gap-3 drop-shadow-md border sticky top-[5.4rem] bg-[#FCE7F3] z-10 p-4 rounded-xl mb-3">
          <h1 class="btn btn-sm" onclick="cetak('preview_surat_amanat_persalinan')">Tutup</h1>
          <h1 class="btn btn-sm btn-primary ml-auto" onclick="print()">Cetak Surat</h1>
        </div>
        <div id="preview_surat_amanat_persalinan" class="[&_section]:!h-fit !w-max !max-w-1/2 border  rounded-xl !p-0 [&>div]:!p-0 [&>div]:overflow-hidden [&>div]:rounded-lg">
        </div>
      </div>
    </div>
  @else
  @endif
  @foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $item)
    <dialog id="add_data_{{ str_replace(' ', '_', $item) }}" class="modal modal-bottom sm:modal-middle">
      <form onsubmit="saveData(this)" action="javascript:void();"S class="modal-box">
        <h3 class="text-lg font-bold">Lengkapi Dokumen</h3>
        <div class="flex flex-col py-4" id="input_render_{{ str_replace('_', ' ', $item) }}"></div>
        <div class="modal-action">
          <button type="submit" class="btn btn-primary">
            Simpan
          </button>
          <button class="btn" type="button" onclick="document.getElementById(`add_data_{{ $item }}`).close();">
            Tutup
          </button>
        </div>
      </form>
    </dialog>
  @endforeach
</x-dashboard.main>


<script>
  let file = '/docx/bkiabi-amanat-persalinan.docx';
  document.addEventListener('DOMContentLoaded', async () => {
    const data = await extractDocx({
      file
    })

    const keys = await extractDocxKeys(data)
    const filter = keys.original().filter(x => !x.startsWith('%'));

    @foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $item)
      renderFormInputs(filter, "input_render_{{ $item }}")
    @endforeach

  });
</script>
