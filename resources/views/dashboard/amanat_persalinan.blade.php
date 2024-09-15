<x-dashboard.main title="Amanat Persalinan Ibu">
  @if (Auth::user()->role === 'admin')
    <div class="flex gap-5">
      @foreach (['daftar_amanat_persalinan_ibu_hamil'] as $item)
        <div class="flex flex-col w-full border-back rounded-xl">
          <div class="p-5 bg-white sm:p-7 rounded-t-xl">
            <div class="flex items-center">

              <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                {{ str_replace('_', ' ', $item) }}
              </h1>
              <label for="add_data_AMANAT_PERSALINAN_IBU" class="ml-auto btn">Tambah Data</label>
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
                        <!-- Icon Book User that triggers the modal -->
                        <x-lucide-book-user class="cursor-pointer size-5 hover:stroke-blue-500"
                          onclick="document.getElementById('detail_modal_{{ $item->id_user }}').showModal();" />

                        <dialog id="detail_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
                          <div class="modal-box">
                            <h3 class="text-lg font-bold">Detail Amanat Persalinan</h3>
                            <p class="py-4">Apakah Anda ingin mencetak dokumen Amanat Persalinan?</p>

                            <div class="modal-action">
                              <a href="{{ route('print.amanat_persalinan') }}" target="_blank" class="btn btn-primary">
                                Cetak
                              </a>
                              <button class="btn" onclick="document.getElementById('detail_modal_{{ $item->id_user }}').close();">
                                Tutup
                              </button>
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
  @else
  @endif
  <div class="w-full min-h-screen" id="container"></div>
</x-dashboard.main>

<input type="checkbox" id="add_data_AMANAT_PERSALINAN_IBU" class="modal-toggle" />
<div class="modal" role="dialog" id="AMANAT_PERSALINAN_IBU">
  <form onsubmit="setupFormGenerate(this, 'AMANAT_PERSALINAN_IBU', 'bkiabi-amanat-kesehatan.pdf')" action="javascript:void();" class="modal-box">
    <h3 class="text-lg font-bold">Tambah Amanat Persalinan Ibu</h3>
    <div id="container" class="flex flex-col w-full gap-2 mt-5">
    </div>
    <div class="modal-action">
      <label for="add_data_AMANAT_PERSALINAN_IBU" class="btn">Tutup</label>
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
  </form>
</div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    setupRenderListing({
      id: 'AMANAT_PERSALINAN_IBU'
    })
  });
</script>
