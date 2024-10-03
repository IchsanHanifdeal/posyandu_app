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
          @foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $i => $item)
            <label onclick="add_data_{{ str_replace(' ', '_', $item) }}.showModal();initInput('{{ $item }}', '{{ $i }}')"
              class="flex flex-row items-center gap-3 cursor-pointer card rounded-xl py-3 px-6 border border-primary">
              <x-lucide-scroll-text class="size-6 stroke-[1]" />
              <h1 class="font-semibold">{{ $item }}</h1>
            </label>
          @endforeach
        </div>
      </div>
    </div>
  @else
  @endif
</x-dashboard.main>

@foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $item)
  <dialog id="add_data_{{ str_replace(' ', '_', $item) }}" class="modal modal-bottom sm:modal-middle">
    <form onsubmit="saveData(this)" action="javascript:void();"S class="modal-box">
      <h3 class="text-lg font-bold">Lengkapi Dokumen</h3>
      <div class="flex flex-col py-4" id="input_render_{{ str_replace('_', ' ', $item) }}"></div>
      <div class="modal-action">
        <button type="submit" class="btn btn-primary">
          Simpan
        </button>
        <button type="submit" class="btn btn-accent">
          Cetak
        </button>
        <button class="btn" type="button" onclick="document.getElementById(`add_data_{{ str_replace(' ', '_', $item) }}`).close();">
          Tutup
        </button>
      </div>
    </form>
  </dialog>
@endforeach

<script>
  let init_file = '';
  let files = [
    '/docx/bkiabi-evaluasi-kesehatan-ibu.docx',
    '/docx/bkiabi-skrining-preeklampsia.docx',
    '/docx/bkiabi-pemeriksaan-dokter-trimester-1.docx',
    '/docx/bkiabi-pemeriksaan-dokter-trimester-3.docx',
  ]

  async function initInput(item, i) {
    init_file = files[i];
    let data = await extractDocx({
      file: files[i]
    })

    let keys = await extractDocxKeys(data)
    let filter = keys.original().filter(x => !x.startsWith('%'));

    renderFormInputs(filter, "input_render_" + item);
  }
</script>
