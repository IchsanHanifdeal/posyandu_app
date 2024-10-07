<x-dashboard.main title="Imunisasi Anak">
    <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['tambah'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }} Imunisasi Anak
                    </h1>

                </div>
                <x-lucide-plus class="{{ $item == 'tambah' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>

    <div class="flex gap-5">
        @foreach (['imunisasi_anak'] as $item)
            <div class="flex flex-col w-full border-back rounded-xl">
                <div class="p-5 bg-white sm:p-7 rounded-t-xl">
                    <div class="flex items-center">

                        <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                    </div>
                </div>
                <div class="flex flex-col gap-3 p-5 pt-0 divide-y rounded-b-xl sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table w-full table-zebra">
                            <thead>
                                <tr>
                                    @foreach (['No', 'Nama Anak', 'Nama Ibu', 'Jenis Vaksin', 'Tanggal'] as $header)
                                        <th class="font-bold text-center uppercase">{{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imunisasianak as $i => $item)
                                    <tr>
                                        <th class="text-center">{{ $i + 1 }}</th>
                                        <td class="font-semibold text-center capitalize">{{ $item->anak->nama }}</td>
                                        <td class="font-semibold text-center capitalize">{{ $item->ibu->user->nama }}
                                        </td>
                                        <td class="font-semibold text-center capitalize">{{ $item->jenis_vaksin }}</td>
                                        <td class="font-semibold text-center capitalize">{{ $item->tanggal }}</td>
                                        <td class="flex items-center gap-4">

                                            <x-lucide-trash class="cursor-pointer size-5 hover:stroke-red-500"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id_ibu }}').showModal();" />

                                            <dialog id="hapus_modal_{{ $item->id_ibu }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-base-100">
                                                    <h3 class="text-lg font-bold capitalize">Hapus
                                                        Imunisasi Anak
                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="font-semibold text-red-800">Perhatian! Anda
                                                            sedang
                                                            mencoba untuk menghapus Imunisasi Anak
                                                            <span class="text-black">Tindakan ini akan menghapus
                                                                semua data terkait. Apakah Anda yakin ingin
                                                                melanjutkan?</span>
                                                        </p>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button type="button"
                                                            onclick="document.getElementById('hapus_modal_{{ $item->id_ibu }}').close()"
                                                            class="btn">Batal</button>
                                                        <form
                                                            action="{{ route('destroy.imunisasi', $item->id_ibu) }}"
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

    <!-- Modal for 'Tambah Imunisasi Anak' -->
    @foreach (['tambah'] as $item)
        @php
            $type = explode('_', $item)[0];
        @endphp
        <dialog id="{{ $item }}_modal" class="modal modal-bottom sm:modal-middle">
            <form action="{{ route('store.imunisasi') }}" method="POST" enctype="multipart/form-data"
                class="modal-box bg-neutral">
                @csrf
                <h3 class="modal-title capitalize text-white">
                    {{ str_replace('_', ' ', $item) }} Imunisasi Anak
                </h3>
                <div class="modal-body">
                    <!-- Nama Ibu -->
                    <div class="mt-4">
                        <label for="id_ibu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Ibu</label>
                        <select id="id_ibu" name="id_ibu"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Ibu</option>
                            @foreach ($ibu as $ibu)
                                <option value="{{ $ibu->id_ibu }}">{{ $ibu->user->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_ibu')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Anak -->
                    <div class="mt-4">
                        <label for="id_anak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Anak</label>
                        <select id="id_anak" name="id_anak"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Anak</option>
                            @foreach ($anak as $item)
                                <option value="{{ $item->id_anak }}">{{ $item->nama_anak }}</option>
                            @endforeach
                        </select>
                        @error('id_anak')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Vaksin -->
                    <div class="mt-4">
                        <label for="jenis_vaksin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Vaksin</label>
                        <select id="jenis_vaksin" name="jenis_vaksin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Vaksin</option>
                            <option value="Hepatitis B (<24 Jam)">Hepatitis B (<24 Jam)</option>
                            <option value="BCG">BCG</option>
                            <option value="Polio tetes 1">Polio tetes 1</option>
                            <option value="DPT-HB-Hib 1">DPT-HB-Hib 1</option>
                            <!-- Add more options as needed -->
                        </select>
                        @error('jenis_vaksin')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="mt-4">
                        <label for="tanggal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                            Imunisasi</label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" onclick="document.getElementById('{{ $item }}_modal').close()"
                        class="btn">Tutup</button>
                    <button type="submit" class="btn btn-neutral-700 capitalize">Tambah Imunisasi</button>
                </div>
            </form>
        </dialog>
    @endforeach

</x-dashboard.main>
