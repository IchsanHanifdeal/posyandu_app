<x-dashboard.main title="Amanat Persalinan Ibu">
  @if (Auth::user()->role === 'admin')
    <div class="flex gap-5 w-full">
      <div class="flex gap-5 w-full h-fit sticky top-[5.5rem]">
        @foreach (['daftar_amanat_persalinan_ibu_hamil'] as $item)
          <div class="flex flex-col w-full border-back rounded-xl">
            <div class="p-5 bg-white sm:p-7 rounded-t-xl">
              <div class="flex items-center">

                <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                  {{ str_replace('_', ' ', $item) }}
                </h1>
              </div>
              <p class="text-sm opacity-60">
                Jelajahi dan ketahui amanat persalinan pada ibu hamil.
              </p>
            </div>
            <div class="flex flex-col gap-3 p-5 pt-0 divide-y rounded-b-xl sm:p-7">
              <div class="overflow-x-auto">
                <table class="table w-full table-zebra">
                  <thead>
                    <tr>
                      @foreach (['No', 'NIK', 'Nama', 'No Handphone', 'No Kohort'] as $header)
                        <th class="font-bold text-center uppercase">{{ $header }}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($ibu as $i => $item)
                      <tr>
                        <td class="font-semibold text-center">{{ $i + 1 }}</td>
                        <td class="font-semibold text-center">{{ $item->nik }}</td>
                        <td class="font-bold text-center">{{ $item->user->nama }}</td>
                        @php
                          $phoneNumber = $item->user->no_hp;
                          if (substr($phoneNumber, 0, 2) === '08') {
                              $phoneNumber = '+628' . substr($phoneNumber, 2);
                          }
                          $waLink = 'https://wa.me/' . $phoneNumber;
                        @endphp

                        <td class="font-semibold text-center text-blue-700">
                          <a href="{{ $waLink }}" target="_blank">{{ $item->user->no_hp }}</a>
                        </td>
                        <td class="text-center">{{ $item->no_register_kohort }}</td>
                        <td class="flex items-center gap-4">
                          <x-lucide-pen-square class="cursor-pointer size-5 hover:stroke-blue-500"
                            onclick="document.getElementById('input_modal_{{ $item->id_user }}').showModal();" />

                          <x-lucide-printer onclick="cetak()" class="cursor-pointer size-5 hover:stroke-blue-500" />

                          @if (Auth::user()->role === 'admin')
                            <div class="tooltip tooltip-top" data-tip="Tanda Tangan Dokter/Bidan">
                              <x-lucide-signature class="size-5 hover:stroke-black cursor-pointer"
                                onclick="document.getElementById('sign_modal_{{ $item->id_user }}').showModal();" />
                            </div>
                          @elseif (Auth::user()->role === 'user')
                            <div class="tooltip tooltip-bottom" data-tip="Tanda Tangan Ibu">
                              <x-lucide-signature class="size-5 hover:stroke-black cursor-pointer"
                                onclick="document.getElementById('sign_modal_{{ $item->id_user }}_ibu').showModal();" />
                            </div>
                            <div class="tooltip tooltip-bottom" data-tip="Tanda Tangan pendamping">
                              <x-lucide-signature class="size-5 hover:stroke-black cursor-pointer"
                                onclick="document.getElementById('sign_modal_{{ $item->id_user }}_pendamping').showModal();" />
                            </div>
                          @endif


                          <dialog id="sign_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
                            <div class="modal-box">
                              <h3 class="font-bold text-lg">Tanda Tangan Digital</h3>
                              <p class="py-4">Silakan tanda tangan di bawah ini:</p>

                              <canvas id="signature_pad_{{ $item->id_user }}" style="border: 1px solid #000; width: 100%; height: 200px;"></canvas>

                              <div class="modal-action">
                                <button id="save_signature_{{ $item->id_user }}" class="btn btn-primary">Simpan</button>
                                <button id="clear_signature_{{ $item->id_user }}" class="btn">Bersihkan</button>
                                <button class="btn" onclick="document.getElementById('sign_modal_{{ $item->id_user }}').close();">Tutup</button>
                              </div>
                            </div>
                          </dialog>
                        </td>

                      </tr>
                    @empty
                      <tr>
                        <td class="text-center text-gray-700 capitalize" colspan="5">Tidak ada
                          data
                          amanat persalinain</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="flex-col gap-3 w-full hidden" id="container_surat">
        <div class="flex items-center ml-auto gap-3 sticky top-[5.4rem] z-10 mr-5">
          <h1 class="btn btn-sm btn-error text-white">Tutup</h1>
          <h1 class="btn btn-sm" onclick="closeSurat()">Cetak Surat</h1>
        </div>
        <div id="preview_surat_amanat_persalinan"
          class="[&_section]:!h-fit !w-max !max-w-1/2 border rounded-xl !p-0 !aspect-[4/16] [&>div]:!p-0 [&>div]:overflow-hidden [&>div]:rounded-lg">
        </div>
      </div>
    </div>
  @endif
</x-dashboard.main>

<input type="checkbox" id="add_data_AMANAT_PERSALINAN_IBU_v1" class="modal-toggle" />
<div class="modal" role="dialog" id="AMANAT_PERSALINAN_IBU">
  <form onsubmit="setupFormGenerate(this, 'AMANAT_PERSALINAN_IBU', 'bkiabi-amanat-kesehatan.pdf')" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Amanat Persalinan Ibu v1</h3>
    <div id="container" class="flex flex-col w-full gap-2 mt-5">
    </div>
    <div class="modal-action">
      <label for="add_data_AMANAT_PERSALINAN_IBU_v1" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>

<input type="checkbox" id="add_data_AMANAT_PERSALINAN_IBU_v2" class="modal-toggle" />
<div class="modal" role="dialog" id="AMANAT_PERSALINAN_IBU">
  <form onsubmit="generateOutputForm()" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Amanat Persalinan Ibu v2</h3>
    <div id="pdf_form_AMANAT_PERSALINAN_IBU" class="w-full mt-5 rounded-lg overflow-hidden">
    </div>
    <div class="modal-action">
      <label for="add_data_AMANAT_PERSALINAN_IBU_v2" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>

<dialog id="input_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
  <form onsubmit="saveData(this)" action="javascript:void();"S class="modal-box">
    <h3 class="text-lg font-bold">Lengkapi Dokumen</h3>
    <div class="flex flex-col py-4" id="input_render_amanat_persalinan">

    </div>

    <div class="modal-action">
      <button type="submit" class="btn btn-primary">
        Simpan
      </button>
      <button class="btn" type="button" onclick="document.getElementById('input_modal_{{ $item->id_user }}').close();">
        Tutup
      </button>
    </div>
  </form>
</dialog>

<script>
  let TEMP_STORE;
  let file = '/docx/bkiabi-amanat-persalinan.docx';
  const containerSurat = document.getElementById('container_surat');

  async function cetak() {
    containerSurat.style.display = 'block';
    const data = await extractDocx({
      file
    })
    const base64 = await extractDocxBase64(data, TEMP_STORE)
    docx.renderAsync(base64, document.getElementById("preview_surat_amanat_persalinan"))
  }

  function saveData(form) {
    const data = parseForm(form);
    TEMP_STORE = data;
    showToast('Data tersimpan!', 'success');
  }

  function  () {
    containerSurat.style.display = 'none';
  }

  document.addEventListener('DOMContentLoaded', async () => {



    const data = await extractDocx({
      file
    })

    const keys = await extractDocxKeys(data)
    const filter = keys.original().filter(x => !x.startsWith('%'));

    renderFormInputs(filter, 'input_render_amanat_persalinan');

    @foreach ($ibu as $item)
      let canvas = document.getElementById('signature_pad_{{ $item->id_user }}');
      let signaturePad = new SignaturePad(canvas);

      const signModal = document.getElementById('sign_modal_{{ $item->id_user }}');
      signModal.addEventListener('show', function() {
        resetSignaturePad(signaturePad);
      });

      window.addEventListener('resize', function() {
        resizeCanvas(canvas, signaturePad);
      });

      resizeCanvas(canvas, signaturePad);

      document.getElementById('clear_signature_{{ $item->id_user }}').addEventListener('click',
        function() {
          signaturePad.clear();
        });

      document.getElementById('save_signature_{{ $item->id_user }}').addEventListener('click',
        function() {
          saveSignature(signaturePad, '{{ $item->id_user }}');
        });
    @endforeach
  });

  function resetSignaturePad(signaturePad) {
    signaturePad.clear();
  }

  function resizeCanvas(canvas, signaturePad) {
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext('2d').scale(ratio, ratio);
    signaturePad.clear();
  }

  function saveSignature(signaturePad, id) {
    if (signaturePad.isEmpty()) {
      alert('Tanda tangan kosong, silakan buat tanda tangan.');
      return;
    }

    const signatureImage = signaturePad.toDataURL();
    console.log(signatureImage);
    alert('Tanda tangan berhasil disimpan!');
  }
</script>