<x-dashboard.main title="Laporan">
    <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['tambah'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }} Laporan
                    </h1>

                </div>
                <x-lucide-plus class="{{ $item == 'tambah' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>

    <div class="flex gap-5">
        @foreach (['Laporan Posyandu'] as $item)
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
                                    @foreach (['no', 'nama_posyandu', 'sasaran_balita_perbulan', 'sasaran_ds_perbulan', 'sasaran_ibu_hamil', 'ibu_hamil_yang_dapat_pelayanan', 'sasaran_remaja', 'remaja_yang_dapat_pelayanan_kesehatan', 'sasaran_usia_produktif', 'usia_produktif_yang_dapat_pelayanan_kesehatan', 'sasaran_lansia', 'lansia_yang_dapat_pelayanan_kesehatan', 'jumlah_bayi_yang_di_imunisasi', 'jumlah_kunjungan_rumah', 'created_at'] as $header)
                                        <th class="font-bold text-center uppercase">
                                            {{ ucfirst(str_replace('_', ' ', $header)) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $i => $item)
                                    <tr>
                                        <th class="text-center">{{ $i + 1 }}</th>
                                        <td class="font-semibold text-center capitalize">
                                            {{ $item->nama_posyandu ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->sasaran_balita_perbulan ?? '-' }}</td>
                                        <td class="font-semibold text-center">{{ $item->sasaran_ds_perbulan ?? '-' }}
                                        </td>
                                        <td class="font-semibold text-center">{{ $item->sasaran_ibu_hamil ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->ibu_hamil_yang_dapat_pelayanan ?? '-' }}</td>
                                        <td class="font-semibold text-center">{{ $item->sasaran_remaja ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->remaja_yang_dapat_pelayanan_kesehatan ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->sasaran_usia_produktif ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->usia_produktif_yang_dapat_pelayanan_kesehatan ?? '-' }}</td>
                                        <td class="font-semibold text-center">{{ $item->sasaran_lansia ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->lansia_yang_dapat_pelayanan_kesehatan ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->jumlah_bayi_yang_di_imunisasi ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->jumlah_kunjungan_rumah ?? '-' }}</td>
                                        <td class="font-semibold text-center">
                                            {{ $item->created_at ? $item->created_at : '-' }}</td>
                                        <td class="flex items-center gap-4">

                                            <x-lucide-trash class="cursor-pointer size-5 hover:stroke-red-500"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id }}').showModal();" />

                                            <dialog id="hapus_modal_{{ $item->id }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-base-100">
                                                    <h3 class="text-lg font-bold capitalize">Hapus

                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="font-semibold text-red-800">Perhatian! Anda
                                                            sedang
                                                            mencoba untuk menghapus Laporan
                                                            <span class="text-black">Tindakan ini akan menghapus
                                                                semua data terkait. Apakah Anda yakin ingin
                                                                melanjutkan?</span>
                                                        </p>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button type="button"
                                                            onclick="document.getElementById('hapus_modal_{{ $item->id }}').close()"
                                                            class="btn">Batal</button>
                                                        <form action="{{ route('destroy.laporan', $item->id) }}"
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

    @foreach (['tambah'] as $item)
        <dialog id="{{ $item }}_modal" class="modal modal-bottom sm:modal-middle">
            <form action="{{ route('store.laporan') }}" method="POST" enctype="multipart/form-data"
                class="modal-box bg-neutral">
                @csrf
                <h3 class="modal-title capitalize text-white">{{ str_replace('_', ' ', $item) }} Laporan</h3>

                @foreach ([
        ['label' => 'Sasaran Balita Per Bulan', 'name' => 'sasaran_balita_perbulan', 'type' => 'text'],
        ['label' => 'Sasaran DS Per Bulan', 'name' => 'sasaran_ds_perbulan', 'type' => 'text'],
        ['label' => 'Sasaran Ibu Hamil', 'name' => 'sasaran_ibu_hamil', 'type' => 'text'],
        ['label' => 'Ibu Hamil Yang Dapat Pelayanan', 'name' => 'ibu_hamil_yang_dapat_pelayanan', 'type' => 'text'],
        ['label' => 'Sasaran Remaja', 'name' => 'sasaran_remaja', 'type' => 'text'],
        ['label' => 'Remaja Yang Dapat Pelayanan Kesehatan', 'name' => 'remaja_yang_dapat_pelayanan_kesehatan', 'type' => 'text'],
        ['label' => 'Sasaran Usia Produktif', 'name' => 'sasaran_usia_produktif', 'type' => 'text'],
        ['label' => 'Usia Produktif Yang Dapat Pelayanan Kesehatan', 'name' => 'usia_produktif_yang_dapat_pelayanan_kesehatan', 'type' => 'text'],
        ['label' => 'Sasaran Lansia', 'name' => 'sasaran_lansia', 'type' => 'text'],
        ['label' => 'Lansia Yang Dapat Pelayanan Kesehatan', 'name' => 'lansia_yang_dapat_pelayanan_kesehatan', 'type' => 'text'],
        ['label' => 'Jumlah Bayi Yang Di Imunisasi', 'name' => 'jumlah_bayi_yang_di_imunisasi', 'type' => 'text'],
        ['label' => 'Jumlah Kunjungan Rumah', 'name' => 'jumlah_kunjungan_rumah', 'type' => 'text'],
    ] as $field)
                    <div class="form-group">
                        <label for="{{ $field['name'] }}" class="text-white">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                            class="input input-bordered w-full" required>
                    </div>
                @endforeach

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn"
                        onclick="document.getElementById('{{ $item }}_modal').close()">Batal</button>
                </div>
            </form>
        </dialog>
    @endforeach
</x-dashboard.main>
