<x-dashboard.main title="Identitas Anak">
    @if (Auth::user()->role === 'admin')
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-2 md:gap-6">
            @foreach (['Anak_baru_lahir', 'jumlah_anak_terdaftar'] as $type)
                <div class="flex items-center px-4 py-3 border shadow-sm bg-neutral rounded-xl">
                    <span
                        class="
                      {{ $type == 'Anak_baru_lahir' ? 'bg-pink-300' : '' }}
                      {{ $type == 'jumlah_anak_terdaftar' ? 'bg-pink-300' : '' }}
                      p-3 mr-4 rounded-full">
                    </span>
                    <div>
                        <p class="text-sm font-medium text-white capitalize">
                            {{ str_replace('_', ' ', $type) }}
                        </p>
                        <p id="{{ $type }}" class="text-lg font-semibold text-white capitalize">
                            {{ $type == 'Anak_baru_lahir' ? $Anak_baru_lahir ?? 'Tidak ada Anak terbaru' : '' }}
                            {{ $type == 'jumlah_anak_terdaftar' ? $jumlah_anak_terdaftar ?? '0' : '' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col lg:flex-row gap-5">
            @foreach (['tambah'] as $item)
                <div onclick="{{ $item . '_modal' }}.showModal()"
                    class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                    <div>
                        <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }} Identitas Anak
                        </h1>
                        <p class="text-sm opacity-60">
                            {{ $item == 'tambah' ? '✨ Tambah identitas anak dengan mudah dan cepat! Fitur ini memungkinkan Anda untuk menyimpan dan mengelola informasi penting tentang anak Anda, termasuk nama, tanggal lahir, dan data lainnya. Pastikan setiap anak mendapatkan perhatian dan catatan yang mereka butuhkan untuk masa depan yang cerah! 🌟' : '' }}
                        </p>
                    </div>
                    <x-lucide-plus class="{{ $item == 'tambah' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
                </div>
            @endforeach
        </div>
        <div class="flex gap-5">
            @foreach (['Identitas_anak_terdaftar'] as $item)
                <div class="flex flex-col w-full border-back rounded-xl">
                    <div class="p-5 bg-white sm:p-7 rounded-t-xl">
                        <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                        <p class="text-sm opacity-60">
                            Ketahui Identitas Anak Anda.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 p-5 pt-0 divide-y rounded-b-xl sm:p-7">
                        <div class="overflow-x-auto">
                            <table class="table w-full table-zebra">
                                <thead>
                                    <tr>
                                        @foreach (['No', 'No Surat', 'Nama Anak', 'Nama Ibu', 'Hari', 'Tanggal', 'Pukul', 'Jenis Kelamin', 'Jenis Kelahiran', 'Kelahiran Ke', 'Berat Badan Lahir', 'Panjang Badan Lahir', 'Tempat Kelahiran'] as $header)
                                            <th class="font-bold text-center uppercase">{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="capitalize">
                                    @forelse ($anak as $i => $item)
                                        <tr>
                                            <th class="text-center">{{ $i + 1 }}</th>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->no_surat ?? '-' }}</td>
                                            <td class="font-semibold text-center capitalize">{{ $item->nama ?? '-' }}
                                            </td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->ibu->user->nama ?? '-' }}</td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') ?? '-' }}
                                            </td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') ?? '-' }}
                                            </td>
                                            <td class="font-semibold text-center capitalize">{{ $item->pukul ?? '-' }}
                                            </td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->jenis_kelamin ?? '-' }}
                                            </td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->jenis_kelahiran ?? '-' }}</td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->kelahiran_ke ?? '-' }}
                                            </td>
                                            <td class="font-semibold text-center capitalize">{{ $item->berat ?? '-' }}
                                                Kg
                                            </td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->panjang ?? '-' }} Cm
                                            </td>
                                            <td class="font-semibold text-center capitalize">
                                                {{ $item->tempat_kelahiran ?? '-' }}</td>
                                            <td class="flex items-center gap-4">
                                                <x-lucide-trash class="size-5 hover:stroke-red-500 cursor-pointer"
                                                    onclick="document.getElementById('hapus_modal_{{ $item->id_anak }}').showModal();" />
                                                <dialog id="hapus_modal_{{ $item->id_anak }}"
                                                    class="modal modal-bottom sm:modal-middle">
                                                    <div class="modal-box bg-base-100">
                                                        <h3 class="text-lg font-bold capitalize">Hapus
                                                            {{ $item->nama }}
                                                        </h3>
                                                        <div class="mt-3">
                                                            <p class="text-red-800 font-semibold">Perhatian! Anda
                                                                sedang
                                                                mencoba untuk menghapus data anak
                                                                <strong
                                                                    class="text-red-800 font-bold">{{ $item->nama_posyandu }}</strong>.
                                                                <span class="text-black">Tindakan ini akan menghapus
                                                                    semua data terkait. Apakah Anda yakin ingin
                                                                    melanjutkan?</span>
                                                            </p>
                                                        </div>
                                                        <div class="modal-action">
                                                            <button type="button"
                                                                onclick="document.getElementById('hapus_modal_{{ $item->id_anak }}').close()"
                                                                class="btn">Batal</button>
                                                            <form
                                                                action="{{ route('delete.anak', $item->id_anak) }}"
                                                                method="POST" class="inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="14" class="text-gray-500 text-center">Tidak Ada Anak
                                                Terdaftar
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @foreach (['tambah'] as $item)
            @php
                $type = explode('_', $item)[0];
            @endphp
            <dialog id="{{ $item }}_modal" class="modal modal-bottom sm:modal-middle">
                <form action="{{ route('store.anak') }}" method="POST" enctype="multipart/form-data"
                    class="modal-box bg-neutral">
                    @csrf
                    <h3 class="modal-title capitalize text-white">
                        {{ str_replace('_', ' ', $item) }} Anak
                    </h3>
                    <div class="modal-body">
                        <!-- Pertemuan Select Box -->
                        <div>
                            <label for="id_ibu"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ibu</label>
                            <select id="id_ibu" name="id_ibu"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Pilih Ibu</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id_ibu }}">{{ $user->user->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_ibu')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $fields = [
                                ['name' => 'no_surat', 'label' => 'No. Surat', 'type' => 'text'],
                                ['name' => 'hari', 'label' => 'Hari', 'type' => 'text'],
                                ['name' => 'tanggal', 'label' => 'Tanggal', 'type' => 'date'],
                                ['name' => 'pukul', 'label' => 'Pukul', 'type' => 'time'],
                                [
                                    'name' => 'jenis_kelamin',
                                    'label' => 'Jenis Kelamin',
                                    'type' => 'select',
                                    'options' => ['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan'],
                                ],
                                [
                                    'name' => 'jenis_kelahiran',
                                    'label' => 'Jenis Kelahiran',
                                    'type' => 'select',
                                    'options' => [
                                        'tunggal' => 'Tunggal',
                                        'kembar 2' => 'Kembar 2',
                                        'kembar 3' => 'Kembar 3',
                                        'lainnya' => 'Lainnya',
                                    ],
                                ],
                                ['name' => 'kelahiran_ke', 'label' => 'Kelahiran Ke', 'type' => 'text'],
                                ['name' => 'berat', 'label' => 'Berat (kg)', 'type' => 'text'],
                                ['name' => 'panjang', 'label' => 'Panjang (cm)', 'type' => 'text'],
                                ['name' => 'tempat_kelahiran', 'label' => 'Tempat Kelahiran', 'type' => 'text'],
                                ['name' => 'nama', 'label' => 'Nama Anak', 'type' => 'text'],
                                // ['name' => 'ttd_saksi1', 'label' => 'Tanda Tangan Saksi 1', 'type' => 'text'],
                                ['name' => 'nama_saksi1', 'label' => 'Nama Saksi 1', 'type' => 'text'],
                                // ['name' => 'ttd_saksi2', 'label' => 'Tanda Tangan Saksi 2', 'type' => 'text'],
                                ['name' => 'nama_saksi2', 'label' => 'Nama Saksi 2', 'type' => 'text'],
                                // [
                                //     'name' => 'ttd_penolong_persalinan',
                                //     'label' => 'Tanda Tangan Penolong Persalinan',
                                //     'type' => 'text',
                                // ],
                                [
                                    'name' => 'nama_penolong_persalinan',
                                    'label' => 'Nama Penolong Persalinan',
                                    'type' => 'text',
                                ],
                            ];
                        @endphp
                        @foreach ($fields as $field)
                            <div class="mt-4">
                                <label for="{{ $field['name'] }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $field['label'] }}</label>
                                @if ($field['type'] === 'select')
                                    <select id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Pilih {{ $field['label'] }}</option>
                                        @foreach ($field['options'] as $value => $optionLabel)
                                            <option value="{{ $value }}">{{ $optionLabel }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="{{ $field['type'] }}" id="{{ $field['name'] }}"
                                        name="{{ $field['name'] }}"
                                        placeholder="Masukan {{ str_replace('_', ' ', $field['name']) }}..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ old($field['name']) }}">
                                @endif
                                @error($field['name'])
                                    <p class="text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-action">
                        <button type="button" onclick="document.getElementById('{{ $item }}_modal').close()"
                            class="btn">Tutup</button>
                        <button type="submit" class="btn btn-neutral-700 capitalize">Tambah Anak</button>
                    </div>
                </form>
            </dialog>
        @endforeach
    @elseif(Auth::user()->role === 'user')
    @endif
</x-dashboard.main>
