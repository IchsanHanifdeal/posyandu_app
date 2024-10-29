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
                                    <tr>
                                        <th class="font-bold">{{ $i + 1 }}</th>
                                        <td class="font-semibold capitalize text-center">{{ $item->pemeriksaan }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->anak->nama }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->anak->tanggal }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->anak->berat }}</td>
                                        <td class="font-semibold capitalize text-center">
                                            {{ $item->ibu->pendamping->nama ?? '-' }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->ibu->user->nama }}
                                        </td>
                                        <td class="font-semibold capitalize text-center">{{ $item->tinggi_badan }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->berat_badan }}</td>
                                        <td class="font-semibold capitalize text-center">
                                            {{ $item->pemberian_asi ?? '-' }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->pelayanan ?? '-' }}
                                        </td>
                                        <td class="font-semibold capitalize text-center">
                                            {{ $item->pemberian_imunisasi ?? '-' }}</td>
                                        <td class="font-semibold capitalize text-center">{{ $item->catatan ?? '-' }}
                                        </td>
                                        <td class="font-semibold capitalize text-center">{{ $item->status_gizi }}</td>
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
                        <label for="id_ibu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Ibu</label>
                        <select id="id_ibu" name="id_ibu"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            {{ Auth::user()->role === 'user' ? 'readonly' : '' }}>
                            <option value="">Pilih Ibu</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id_ibu }}" {{ $user->id_ibu === $id_ibu ? 'selected' : '' }}>
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
                            @elseif ($field == 'pemberian_imunisasi')
                                <select id="{{ $field }}" name="{{ $field }}"
                                    class="capitalize bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Pilih Vaksin</option>
                                    <option value="HB 0 (0-7 Hari)">HB 0 (0-7 Hari)</option>
                                    <option value="BCG">BCG</option>
                                    <option value="Polio 1">Polio 1</option>
                                    <option value="DPT/HB 1">DPT/HB 1</option>
                                    <option value="Polio 2">Polio 2</option>
                                    <option value="DPT/HB 2">DPT/HB 2</option>
                                    <option value="Polio 3">Polio 3</option>
                                    <option value="DPT/HB 3">DPT/HB 3</option>
                                    <option value="Polio 4">Polio 4</option>
                                    <option value="Campak">Campak</option>
                                </select>
                            @elseif ($field == 'pemberian_asi')
                                <select id="{{ $field }}" name="{{ $field }}"
                                    class="capitalize bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Pilih Status Pemberian ASI</option>
                                    <option value="E0">E0</option>
                                    <option value="E1">E1</option>
                                    <option value="E2">E2</option>
                                    <option value="E3">E3</option>
                                    <option value="E4">E4</option>
                                    <option value="E5">E5</option>
                                </select>
                            @else
                                <input type="{{ $field == 'pemeriksaan' ? 'date' : 'text' }}"
                                    id="{{ $field }}" name="{{ $field }}"
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
