    <x-dashboard.main title="Informasi Ibu Bersalin">
      @foreach (['Daftar_informasi_bayi_baru_lahir'] as $item)
        <div class="flex flex-col border-back rounded-xl w-full">
          <div class="p-5 sm:p-7 bg-white rounded-t-xl">
            <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
              {{ str_replace('_', ' ', $item) }}
            </h1>
            <p class="text-sm opacity-60">
              Jelajahi dan ketahui Informasi seputar Bayi Lahir.
            </p>
          </div>
          <div class="flex flex-col rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
            <div class="overflow-x-auto">
              <table class="table table-zebra w-full">
                <thead>
                  <tr>
                    @foreach (['No', 'Nama Materi', 'Materi'] as $header)
                      <th class="uppercase font-bold text-center">{{ $header }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @php
                    $informasiIbuHamil = [
                        [
                            'id' => 1,
                            'judul' => 'Tanda Awal akan Melahirkan',
                            'gambar' => 'tanda_awal.jpg',
                            'deskripsi' => 'Tanda Awal akan Melahirkan',
                        ],
                        [
                            'id' => 2,
                            'judul' => 'Proses Melahirkan',
                            'gambar' => 'proses_melahirkan.jpg',
                            'deskripsi' => 'Proses Melahirkan',
                        ],
                        [
                            'id' => 3,
                            'judul' => 'Tanda Bahaya',
                            'gambar' => 'tanda_bahaya.jpg',
                            'deskripsi' => 'Tanda Bahaya',
                        ],
                    ];
                  @endphp

                  @foreach ($informasiIbuHamil as $info)
                    <tr>
                      <td class="text-center">{{ $info['id'] }}</td>
                      <td class="text-center font-semibold">{{ $info['judul'] }}</td>
                      <td class="text-center capitalize">
                        <label for="lihat_modal_{{ $info['id'] }}" class="w-full btn btn-neutral flex items-center justify-center gap-2 text-white font-bold">
                          <span>Lihat</span>
                        </label>

                        <input type="checkbox" id="lihat_modal_{{ $info['id'] }}" class="modal-toggle" />
                        <div class="modal" role="dialog">
                          <div class="modal-box">
                            <h3 class="text-lg font-bold">{{ $info['deskripsi'] }}</h3>
                            <div class="flex flex-col w-full gap-3 !h-full mt-3 rounded-lg overflow-hidden">
                              <img id="foto_informasi_preview_{{ $info['id'] }}" src="{{ asset('images/informasi/ibu_bersalin/' . $info['gambar']) }}" class="border size-full"
                                alt="Materi Gambar">
                            </div>
                          </div>
                          <label class="modal-backdrop" for="lihat_modal_{{ $info['id'] }}"></label>
                        </div>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      @endforeach
    </x-dashboard.main>
