<x-dashboard.main title="Identitas Ibu Hamil">
  @if (Auth::user()->role === 'admin')
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-2 md:gap-6">
      @foreach (['ibu_terbaru', 'jumlah_ibu'] as $type)
        <div class="flex items-center px-4 py-3 border shadow-sm bg-neutral rounded-xl">
          <span
            class="
                    {{ $type == 'ibu_terbaru' ? 'bg-pink-300' : '' }}
                    {{ $type == 'jumlah_ibu' ? 'bg-pink-300' : '' }}
                    p-3 mr-4 rounded-full">
          </span>
          <div>
            <p class="text-sm font-medium text-white capitalize">
              {{ str_replace('_', ' ', $type) }}
            </p>
            <p id="{{ $type }}" class="text-lg font-semibold text-white capitalize">
              {{ $type == 'ibu_terbaru' ? $ibu_terbaru ?? 'Tidak ada ibu terbaru' : '' }}
              {{ $type == 'jumlah_ibu' ? $jumlah_ibu ?? '0' : '' }}
            </p>
          </div>
        </div>
      @endforeach
    </div>
    <div class="flex gap-5">
      @foreach (['Daftar_ibu_hamil'] as $item)
        <div class="flex flex-col w-full border-back rounded-xl">
          <div class="p-5 bg-white sm:p-7 rounded-t-xl">
            <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
              {{ str_replace('_', ' ', $item) }}
            </h1>
            <p class="text-sm opacity-60">
              Jelajahi dan ketahui ibu terbaru.
            </p>
          </div>
          <div class="flex flex-col gap-3 p-5 pt-0 divide-y rounded-b-xl sm:p-7">
            <div class="overflow-x-auto">
              <table class="table w-full table-zebra">
                <thead>
                  <tr>
                    @foreach (['No', 'Foto Profil', 'Nama', 'No Handphone', 'Nik', 'tempat/tanggal lahir', 'No Kohort'] as $header)
                      <th class="font-bold text-center uppercase">{{ $header }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody class="capitalize">
                  @forelse ($ibu as $i => $item)
                    <tr>
                      <th class="text-center">{{ $i + 1 }}</th>
                      <td class="font-semibold text-center capitalize">
                        <label for="lihat_modal_{{ $item->id_user }}" class="flex items-center justify-center w-full gap-2 font-bold text-white btn btn-neutral">
                          <span>Lihat</span>
                        </label>

                        <input type="checkbox" id="lihat_modal_{{ $item->id_user }}" class="modal-toggle" />
                        <div class="modal" role="dialog">
                          <div class="modal-box">
                            <h3 class="text-lg font-bold">Foto Profil
                              {{ $item->user->nama }}
                            </h3>
                            <div class="flex flex-col w-full gap-3 !h-full mt-3 rounded-lg overflow-hidden">
                              @php
                                $imagePath = $item->foto_profil
                                    ? asset('storage/foto_profil/' . $item->user->foto_profil)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($item->user->nama);
                              @endphp
                              <img id="foto_profil_preview_{{ $item->id_user }}" src="{{ $imagePath }}" class="border size-full" alt="Profile Picture">

                              <form action="{{ route('photo.update', $item->id_user) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" accept="image/*" id="foto_profil_file_{{ $item->id_user }}" class="hidden" name="foto_profil">
                                <label for="foto_profil_file_{{ $item->id_user }}" class="w-full cursor-pointer btn btn-sm btn-accent">Ganti</label>
                                <button type="submit" class="w-full mt-3 cursor-pointer btn btn-sm btn-accent">Simpan</button>
                              </form>
                            </div>
                          </div>
                          <label class="modal-backdrop" for="lihat_modal_{{ $item->id_user }}"></label>
                        </div>

                        <script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const userId = "{{ $item->id_user }}";
                            const fotoInput = document.getElementById('foto_profil_file_' + userId);
                            const previewImage = document.getElementById('foto_profil_preview_' + userId);

                            fotoInput.addEventListener('change', function() {
                              const file = this.files[0];
                              if (file) {
                                const blob = URL.createObjectURL(file);
                                previewImage.style.display = 'block';
                                previewImage.src = blob;
                              }
                            });
                          });
                        </script>

                      </td>
                      <td class="font-semibold text-center capitalize">{{ $item->user->nama }}
                      </td>
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
                      <td class="font-semibold text-center">{{ $item->nik }}</td>
                      <td class="font-semibold text-center">
                        {{ $item->tempat_lahir . '/' . $item->tanggal_lahir }}</td>
                      <td class="font-semibold text-center">{{ $item->no_register_kohort }}</td>
                      <td class="flex items-center gap-4">
                        <!-- Trigger Button -->
                        <x-lucide-book-user class="cursor-pointer size-5 hover:stroke-green-500"
                          onclick="document.getElementById('detail_modal_{{ $item->id_user }}').showModal();" />

                        <!-- Modal -->
                        <dialog id="detail_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
                          <div class="max-w-6xl p-8 transition-all duration-300 ease-in-out transform scale-95 bg-white shadow-xl modal-box rounded-xl hover:scale-100">

                            <div class="flex items-center justify-between mb-6">
                              <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  class="w-8 h-8 mr-3 text-pink-500">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                <h3 class="font-semibold text-pink-600">
                                  Detail Ibu {{ $item->user->nama }}
                                </h3>
                              </div>
                              <button class="transition-colors btn btn-sm btn-circle btn-neutral hover:bg-red-500 hover:text-white"
                                onclick="document.getElementById('detail_modal_{{ $item->id_user }}').close();">
                                ✕
                              </button>
                            </div>

                            <div class="flex justify-center mb-6">
                              @php
                                $imagePath = $item->foto_profil
                                    ? asset('storage/foto_profil/' . $item->foto_profil)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($item->user->nama);
                              @endphp
                              <div class="w-40 h-40 overflow-hidden bg-pink-100 border-4 border-pink-300 rounded-full shadow-lg">
                                <img id="foto_profil_preview_{{ $item->id_user }}" src="{{ $imagePath }}" alt="Profile Picture" class="object-cover w-full h-full">
                              </div>
                            </div>

                            <div class="overflow-x-auto">
                              <table class="min-w-full text-sm text-left bg-white border-separate border-spacing-y-2">
                                <thead>
                                  <tr class="text-gray-700 bg-pink-100">
                                    <th class="px-4 py-3 text-center rounded-tl-lg">
                                      IBU
                                    </th>
                                    <th class="px-4 py-3 text-center rounded-tr-lg">
                                      SUAMI/KELUARGA</th>
                                  </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <div><strong>Nama:</strong>
                                        {{ $item->user->nama }}</div>
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <div><strong>Nama:</strong>
                                        {{ $item->pendamping->nama ?? 'Tidak Ada' }}
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>NIK:</strong> {{ $item->nik }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>NIK:</strong>
                                      {{ $item->pendamping->nik ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Pembiayaan:</strong>
                                      {{ $item->pembiayaan }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Pembiayaan:</strong>
                                      {{ $item->pendamping->pembiayaan ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>No. JKN:</strong>
                                      {{ $item->no_jkn }}<br>
                                      <strong>Faskes TK 1:</strong>
                                      {{ $item->faskes_tk_1 }}<br>
                                      <strong>Faskes Rujukan:</strong>
                                      {{ $item->faskes_rujukan }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>No. JKN:</strong>
                                      {{ $item->pendamping->nomor_jkn ?? 'Tidak Ada' }}<br>
                                      <strong>Faskes TK 1:</strong>
                                      {{ $item->pendamping->faskes_tk_1 ?? 'Tidak Ada' }}<br>
                                      <strong>Faskes Rujukan:</strong>
                                      {{ $item->pendamping->faskes_rujukan ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Gol.
                                        Darah:</strong>
                                      {{ $item->golongan_darah }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Gol.
                                        Darah:</strong>
                                      {{ $item->pendamping->golongan_darah ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Tempat:</strong>
                                      {{ $item->tempat_lahir }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Tempat:</strong>
                                      {{ $item->pendamping->tempat_lahir ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Tanggal Lahir:</strong>
                                      {{ $item->tanggal_lahir }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Tanggal Lahir:</strong>
                                      {{ $item->pendamping->tanggal_lahir ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Pendidikan:</strong>
                                      {{ $item->pendidikan }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Pendidikan:</strong>
                                      {{ $item->pendamping->pendidikan ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Pekerjaan:</strong>
                                      {{ $item->pekerjaan }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Pekerjaan:</strong>
                                      {{ $item->pendamping->pekerjaan ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Alamat Rumah:</strong>
                                      {{ $item->alamat }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Alamat Rumah:</strong>
                                      {{ $item->pendamping->alamat ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Telepon:</strong>
                                      {{ $item->user->no_hp }}
                                    </td>
                                    <td class="px-4 py-2 border rounded-lg">
                                      <strong>Telepon:</strong>
                                      {{ $item->pendamping->no_hp ?? 'Tidak Ada' }}
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                            <div class="mt-6">
                              <p><strong>Puskesmas Domisili:</strong>
                                {{ $item->puskesmas_domisili }}</p>
                              <p><strong>No. Register Kohort Ibu:</strong>
                                {{ $item->no_register_kohort }}</p>
                            </div>

                            <div class="flex justify-between mt-6 modal-action">
                              <button class="px-6 py-3 text-white transition-all bg-pink-500 rounded-md shadow-md btn hover:bg-pink-600"
                                onclick="document.getElementById('detail_modal_{{ $item->id_user }}').close();">
                                Tutup
                              </button>
                              <button class="px-6 py-3 text-white transition-all bg-gray-500 rounded-md shadow-md btn hover:bg-gray-600" onclick="window.print();">
                                Print
                              </button>
                            </div>
                          </div>
                        </dialog>

                        <x-lucide-trash class="cursor-pointer size-5 hover:stroke-red-500" onclick="document.getElementById('hapus_modal_{{ $item->id_user }}').showModal();" />
                        <dialog id="hapus_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
                          <div class="modal-box bg-base-100">
                            <h3 class="text-lg font-bold capitalize">Hapus
                              {{ $item->user->nama }}
                            </h3>
                            <div class="mt-3">
                              <p class="font-semibold text-red-800">Perhatian! Anda
                                sedang
                                mencoba untuk menghapus Pengguna
                                <strong class="font-bold text-red-800">{{ $item->user->nama }}</strong>.
                                <span class="text-black">Tindakan ini akan menghapus
                                  semua data terkait. Apakah Anda yakin ingin
                                  melanjutkan?</span>
                              </p>
                            </div>
                            <div class="modal-action">
                              <button type="button" onclick="document.getElementById('hapus_modal_{{ $item->id_user }}').close()" class="btn">Batal</button>
                              <form action="{{ route('delete.pengguna', $item->id_user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </dialog>
                      </td>
                    </tr>
                  @empty
                    <td colspan="7" class="text-center text-gray-700">Tidak ada Data Ibu</td>
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
</x-dashboard.main>
