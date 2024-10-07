<x-dashboard.main title="Perkembangan Anak">
    <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['tambah_perkembangan_anak'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'tambah_perkembangan_anak' ? '🌱 Lihat bagaimana si kecil tumbuh dan berkembang setiap harinya! Fitur ini memudahkan Anda untuk menambahkan informasi tentang perkembangan anak, dari tanggal lahir hingga milestone penting. Buat catatan pribadi untuk setiap langkah, karena setiap momen tumbuh kembangnya adalah investasi masa depan mereka! 💫' : '' }}
                    </p>
                </div>
                <x-lucide-plus
                    class="{{ $item == 'tambah_perkembangan_anak' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['identitas_perkembangan_anak'] as $item)
            <div class="flex flex-col w-full border-back rounded-xl">
                <div class="p-5 bg-white sm:p-7 rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        Dapatkan informasi lengkap dan akurat tentang identitas serta perkembangan anak Anda. Setiap
                        data yang dicatat membantu memantau pertumbuhan dan kesehatannya secara menyeluruh.
                    </p>
                </div>
                <div class="flex flex-col gap-3 p-5 pt-0 divide-y rounded-b-xl sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table w-full table-zebra">
                            <thead>
                                <tr>
                                    @foreach (['No', 'tanggal pemeriksaan', 'Nama Bayi/Balita', 'tanggal lahir', 'Berat Badan Lahir', 'Nama Ayah', 'Nama Ibu', 'tinggi badan', 'berat badan', 'pemberian asi', 'pelayanan', 'pemberian imunisasi', 'catatan', 'kategori status gizi'] as $header)
                                        <th class="font-bold text-center uppercase">{{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="capitalize">
                                @foreach ($pemeriksaan as $i => $item)
                                    @php
                                        // Menghitung usia anak berdasarkan tanggal lahir
                                        $usia_bulan = \Carbon\Carbon::parse($item->anak->tanggal)->diffInMonths(now());

                                        // Data berat dan panjang lahir
                                        $berat_lahir = $item->anak->berat; // Berat badan lahir
                                        $panjang_lahir = $item->anak->panjang; // Panjang badan lahir

                                        $berat_saat_ini = $item->berat_badan; // Berat badan saat pemeriksaan
                                        $tinggi_saat_ini = $item->tinggi_badan; // Tinggi badan saat pemeriksaan

                                        $status_gizi = 'Data tidak lengkap';

                                        // Perhitungan status gizi berdasarkan BB/U (Berat Badan menurut Umur)
                                        if ($usia_bulan <= 60 && $berat_saat_ini > 0 && $tinggi_saat_ini > 0) {
                                            // Ensure non-zero values
                                            // BB/U
                                            if ($berat_saat_ini < -3) {
                                                $status_gizi = 'Berat badan sangat kurang (Severely Underweight)';
                                            } elseif ($berat_saat_ini >= -3 && $berat_saat_ini < -2) {
                                                $status_gizi = 'Berat badan kurang (Underweight)';
                                            } elseif ($berat_saat_ini >= -2 && $berat_saat_ini <= 1) {
                                                $status_gizi = 'Berat badan normal (Normal)';
                                            } elseif ($berat_saat_ini > 1 && $berat_saat_ini <= 2) {
                                                $status_gizi = 'Risiko berat badan lebih (Possible Risk of Overweight)';
                                            } else {
                                                $status_gizi = 'Obesitas (Obese)';
                                            }

                                            // PB/U
                                            if ($usia_bulan <= 24) {
                                                if ($tinggi_saat_ini < -3) {
                                                    $status_gizi = 'Sangat pendek (Severely Stunted)';
                                                } elseif ($tinggi_saat_ini >= -3 && $tinggi_saat_ini < -2) {
                                                    $status_gizi = 'Pendek (Stunted)';
                                                } elseif ($tinggi_saat_ini >= -2 && $tinggi_saat_ini <= 3) {
                                                    $status_gizi = 'Normal';
                                                } elseif ($tinggi_saat_ini > 3) {
                                                    $status_gizi = 'Tinggi (Tall)';
                                                }
                                            } else {
                                                if ($tinggi_saat_ini < -3) {
                                                    $status_gizi = 'Sangat pendek (Severely Stunted)';
                                                } elseif ($tinggi_saat_ini >= -3 && $tinggi_saat_ini < -2) {
                                                    $status_gizi = 'Pendek (Stunted)';
                                                } elseif ($tinggi_saat_ini >= -2 && $tinggi_saat_ini <= 3) {
                                                    $status_gizi = 'Normal';
                                                } elseif ($tinggi_saat_ini > 3) {
                                                    $status_gizi = 'Tinggi (Tall)';
                                                }
                                            }

                                            // BB/TB
                                            if ($tinggi_saat_ini > 0) {
                                                $z_score_bb_tb = ($berat_saat_ini - $panjang_lahir) / $tinggi_saat_ini;

                                                if ($z_score_bb_tb < -3) {
                                                    $status_gizi = 'Gizi buruk (Severely Wasted)';
                                                } elseif ($z_score_bb_tb >= -3 && $z_score_bb_tb < -2) {
                                                    $status_gizi = 'Gizi kurang (Wasted)';
                                                } elseif ($z_score_bb_tb >= -2 && $z_score_bb_tb <= 1) {
                                                    $status_gizi = 'Gizi baik (Normal)';
                                                } elseif ($z_score_bb_tb > 1 && $z_score_bb_tb <= 2) {
                                                    $status_gizi = 'Berisiko gizi lebih (Possible Risk of Overweight)';
                                                } else {
                                                    $status_gizi = 'Gizi lebih (Overweight) atau Obesitas';
                                                }
                                            }

                                            // IMT/U
                                            $imt = $berat_saat_ini / ($tinggi_saat_ini / 100) ** 2; // Menghitung IMT

                                            if ($imt < -3) {
                                                $status_gizi = 'Gizi buruk (Severely Thinness)';
                                            } elseif ($imt >= -3 && $imt < -2) {
                                                $status_gizi = 'Gizi kurang (Thinness)';
                                            } elseif ($imt >= -2 && $imt <= 1) {
                                                $status_gizi = 'Gizi baik (Normal)';
                                            } elseif ($imt > 1 && $imt <= 2) {
                                                $status_gizi = 'Gizi lebih (Overweight)';
                                            } else {
                                                $status_gizi = 'Obesitas (Obese)';
                                            }
                                        } else {
                                            // Jika usia anak lebih dari 60 bulan atau data tidak lengkap
                                            $status_gizi =
                                                'Z-Score tidak tersedia untuk usia > 60 bulan atau data tidak lengkap';
                                        }
                                    @endphp

                                    <tr>
                                        <th class="font-bold">{{ $i + 1 }}</th>
                                        <td class="font-semibold capitalize text-center">{{ $item->pemeriksaan }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->anak->nama }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->anak->tanggal }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $berat_lahir }}</td>
                                        <td class="font-semibold capitalize text-center">
                                            {{ $item->ibu->pendamping->nama ?? '-' }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->ibu->user->nama }}
                                        </td>
                                        <td class="font-semibold capitalize text-center">{{ $tinggi_saat_ini }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $berat_saat_ini }}</td>
                                        <td class="font-semibold capitalize text-center">
                                            {{ $item->pemberian_asi ?? '-' }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->pelayanan ?? '-' }}
                                        </td>
                                        <td class="font-semibold capitalize text-center">
                                            {{ $item->pemberian_imunisasi ?? '-' }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->catatan ?? '-' }}
                                        </td>
                                        <td class="font-semibold capitalize text-center">{{ $status_gizi }}</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-trash class="size-5 hover:stroke-red-500 cursor-pointer"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id }}').showModal();" />
                                            <dialog id="hapus_modal_{{ $item->id }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-base-100">
                                                    <h3 class="text-lg font-bold capitalize">Hapus
                                                        {{ $item->anak->nama }}
                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="text-red-800 font-semibold">Perhatian! Anda
                                                            sedang
                                                            mencoba untuk menghapus data anak
                                                            <strong
                                                                class="text-red-800 font-bold">{{ $item->anak->nama }}</strong>.
                                                            <span class="text-black">Tindakan ini akan menghapus
                                                                semua data terkait. Apakah Anda yakin ingin
                                                                melanjutkan?</span>
                                                        </p>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button type="button"
                                                            onclick="document.getElementById('hapus_modal_{{ $item->id }}').close()"
                                                            class="btn">Batal</button>
                                                        <form action="{{ route('delete.perkembangan', $item->id) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </dialog>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @foreach (['tambah_perkembangan_anak'] as $item)
        @php
            $type = explode('_', $item)[0];
        @endphp
        <dialog id="{{ $item }}_modal" class="modal modal-bottom sm:modal-middle">
            <form action="{{ route('store.perkembangan') }}" method="POST" enctype="multipart/form-data"
                class="modal-box bg-neutral">
                @csrf
                <h3 class="modal-title capitalize text-white">
                    {{ str_replace('_', ' ', $item) }}
                </h3>
                <div class="modal-body">
                    <!-- Pertemuan Select Box -->
                    <div>
                        <label for="id_ibu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ibu</label>
                        <select id="id_ibu" name="id_ibu"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            {{ Auth::user()->role === 'user' ? 'readonly' : '' }}>
                            <option value="">Pilih Ibu</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id_ibu }}" {{ ($user->id_ibu === $id_ibu) ? 'selected' : '' }}>
                                    {{ $user->user->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_ibu')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>                    
                    <div>
                        <label for="id_anak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            anak</label>
                        <select id="id_anak" name="id_anak"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih anak</option>
                            @foreach ($anaks as $anak)
                                <option value="{{ $anak->id_anak }}">{{ $anak->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_anak')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    @foreach (['pemeriksaan', 'tinggi_badan', 'berat_badan', 'pemberian_asi', 'pelayanan', 'pemberian_imunisasi', 'catatan'] as $field)
                        <div>
                            <label for="{{ $field }}"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $field) }}</label>
                            @if ($field == 'catatan')
                                <textarea id="{{ $field }}" name="{{ $field }}"
                                    class="capitalize bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="masukan {{ $field }}..."></textarea>
                            @else
                                <input type="{{ $field == 'pemeriksaan' ? 'date' : 'text' }}" id="{{ $field }}"
                                    name="{{ $field }}"
                                    class="capitalize bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="masukan {{ str_replace('_', ' ', $field) }}...">
                            @endif
                            @error($field)
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <div class="modal-action">
                    <button type="button" onclick="document.getElementById('{{ $item }}_modal').close()"
                        class="btn">Tutup</button>
                    <button type="submit" class="btn btn-neutral-700 capitalize">Tambah</button>
                </div>
            </form>
        </dialog>
    @endforeach
</x-dashboard.main>
