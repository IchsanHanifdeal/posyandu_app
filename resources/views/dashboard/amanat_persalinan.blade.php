<x-dashboard.main title="Amanat Persalinan Ibu">
    <div class="flex gap-5">
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
                                            <!-- Trigger Button -->
                                            <div class="relative inline-block" data-tip="Tambah Data"
                                                data-tip-position="top">
                                                <x-lucide-circle-plus
                                                    class="cursor-pointer size-5 hover:stroke-blue-500"
                                                    onclick="document.getElementById('amanat_modal_{{ $item->id_user }}').showModal();" />
                                            </div>

                                            <!-- Modal for Amanat Persalinan -->
                                            <dialog id="amanat_modal_{{ $item->id_user }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div
                                                    class="max-w-6xl p-8 transition-all duration-300 ease-in-out transform scale-95 bg-white shadow-xl modal-box rounded-xl hover:scale-100">
                                                    <form action="{{ route('amanat.store') }}" method="POST">
                                                        @csrf
                                                        <h2 class="text-2xl font-semibold mb-4">Amanat Persalinan
                                                        </h2>
                                                        <input type="hidden" name="id_ibu"
                                                            value="{{ $item->id_ibu }}">

                                                        {{-- Define the fields in an array --}}
                                                        @php
                                                            $fields = [
                                                                [
                                                                    'label' => 'Bulan',
                                                                    'name' => 'bulan',
                                                                    'type' => 'text',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan bulan',
                                                                ],
                                                                [
                                                                    'label' => 'Tahun',
                                                                    'name' => 'tahun',
                                                                    'type' => 'number',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan tahun',
                                                                ],
                                                                [
                                                                    'label' => 'Dokter 1',
                                                                    'name' => 'dokter_1',
                                                                    'type' => 'text',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan nama dokter 1',
                                                                ],
                                                                [
                                                                    'label' => 'Dokter 2',
                                                                    'name' => 'dokter_2',
                                                                    'type' => 'text',
                                                                    'required' => false,
                                                                    'placeholder' =>
                                                                        'Masukkan nama dokter 2 (opsional)',
                                                                ],
                                                                [
                                                                    'label' => 'Dana Persalinan',
                                                                    'name' => 'dana_persalinan',
                                                                    'type' => 'text',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan dana persalinan',
                                                                ],
                                                                [
                                                                    'label' => 'Metode Persalinan',
                                                                    'name' => 'metode_persalinan',
                                                                    'type' => 'text',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan metode persalinan',
                                                                ],
                                                                [
                                                                    'label' => 'Golongan Darah',
                                                                    'name' => 'golongan_darah',
                                                                    'type' => 'text',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan golongan darah',
                                                                ],
                                                                [
                                                                    'label' => 'Rhesus',
                                                                    'name' => 'rhesus',
                                                                    'type' => 'text',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan rhesus',
                                                                ],
                                                            ];
                                                        @endphp

                                                        {{-- Generate fields dynamically --}}
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                            @foreach ($fields as $field)
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                                                                    <input type="{{ $field['type'] }}"
                                                                        name="{{ $field['name'] }}"
                                                                        class="input input-bordered w-full"
                                                                        placeholder="{{ $field['placeholder'] }}"
                                                                        @if ($field['required']) required @endif>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <h3 class="text-lg font-semibold mb-2">Kendaraan</h3>
                                                        @php
                                                            $kendaraanFields = [
                                                                [
                                                                    'label' => 'Kendaraan 1',
                                                                    'name' => 'kendaraan_1',
                                                                    'hp' => 'hp_kendaraan_1',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan kendaraan 1',
                                                                    'hp_placeholder' => 'Masukkan HP kendaraan 1',
                                                                ],
                                                                [
                                                                    'label' => 'Kendaraan 2',
                                                                    'name' => 'kendaraan_2',
                                                                    'hp' => 'hp_kendaraan_2',
                                                                    'required' => false,
                                                                    'placeholder' => 'Masukkan kendaraan 2 (opsional)',
                                                                    'hp_placeholder' =>
                                                                        'Masukkan HP kendaraan 2 (opsional)',
                                                                ],
                                                                [
                                                                    'label' => 'Kendaraan 3',
                                                                    'name' => 'kendaraan_3',
                                                                    'hp' => 'hp_kendaraan_3',
                                                                    'required' => false,
                                                                    'placeholder' => 'Masukkan kendaraan 3 (opsional)',
                                                                    'hp_placeholder' =>
                                                                        'Masukkan HP kendaraan 3 (opsional)',
                                                                ],
                                                            ];
                                                        @endphp
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                            @foreach ($kendaraanFields as $kendaraan)
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">{{ $kendaraan['label'] }}</label>
                                                                    <input type="text"
                                                                        name="{{ $kendaraan['name'] }}"
                                                                        class="input input-bordered w-full"
                                                                        placeholder="{{ $kendaraan['placeholder'] }}"
                                                                        @if ($kendaraan['required']) required @endif>
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">No
                                                                        HP {{ $kendaraan['label'] }}</label>
                                                                    <input type="text" name="{{ $kendaraan['hp'] }}"
                                                                        class="input input-bordered w-full"
                                                                        placeholder="{{ $kendaraan['hp_placeholder'] }}">
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <h3 class="text-lg font-semibold mb-2">Bantuan</h3>
                                                        @php
                                                            $bantuanFields = [
                                                                [
                                                                    'label' => 'Bantuan 1',
                                                                    'name' => 'bantuan_1',
                                                                    'hp' => 'hp_bantuan_1',
                                                                    'placeholder' => 'Masukkan bantuan 1',
                                                                    'hp_placeholder' => 'Masukkan HP bantuan 1',
                                                                ],
                                                                [
                                                                    'label' => 'Bantuan 2',
                                                                    'name' => 'bantuan_2',
                                                                    'hp' => 'hp_bantuan_2',
                                                                    'placeholder' => 'Masukkan bantuan 2 (opsional)',
                                                                    'hp_placeholder' =>
                                                                        'Masukkan HP bantuan 2 (opsional)',
                                                                ],
                                                                [
                                                                    'label' => 'Bantuan 3',
                                                                    'name' => 'bantuan_3',
                                                                    'hp' => 'hp_bantuan_3',
                                                                    'placeholder' => 'Masukkan bantuan 3 (opsional)',
                                                                    'hp_placeholder' =>
                                                                        'Masukkan HP bantuan 3 (opsional)',
                                                                ],
                                                                [
                                                                    'label' => 'Bantuan 4',
                                                                    'name' => 'bantuan_4',
                                                                    'hp' => 'hp_bantuan_4',
                                                                    'placeholder' => 'Masukkan bantuan 4 (opsional)',
                                                                    'hp_placeholder' =>
                                                                        'Masukkan HP bantuan 4 (opsional)',
                                                                ],
                                                            ];
                                                        @endphp
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                            @foreach ($bantuanFields as $bantuan)
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">{{ $bantuan['label'] }}</label>
                                                                    <input type="text" name="{{ $bantuan['name'] }}"
                                                                        class="input input-bordered w-full"
                                                                        placeholder="{{ $bantuan['placeholder'] }}">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">No
                                                                        HP {{ $bantuan['label'] }}</label>
                                                                    <input type="text" name="{{ $bantuan['hp'] }}"
                                                                        class="input input-bordered w-full"
                                                                        placeholder="{{ $bantuan['hp_placeholder'] }}">
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="flex justify-between mt-6">
                                                            <button type="button" class="btn btn-outline"
                                                                onclick="document.getElementById('amanat_modal_{{ $item->id_user }}').close();">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </dialog>

                                            <div class="relative inline-block" data-tip="Edit Data"
                                                data-tip-position="top">
                                                <x-lucide-pencil class="cursor-pointer size-5 hover:stroke-blue-500"
                                                    onclick="document.getElementById('edit_amanat_modal_{{ $item->id_ibu }}').showModal();" />
                                            </div>

                                            <!-- Changed variable name for clarity -->
                                            @foreach ($amanat as $amanatItem)
                                                <!-- Iterate through each amanat item -->
                                                <dialog id="edit_amanat_modal_{{ $amanatItem->id_ibu }}"
                                                    class="modal modal-bottom sm:modal-middle">
                                                    <div
                                                        class="max-w-6xl p-8 transition-all duration-300 ease-in-out transform scale-95 bg-white shadow-xl modal-box rounded-xl hover:scale-100">
                                                        <form
                                                            action="{{ route('amanat.update', $amanatItem->id_ibu) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT') <!-- Use PUT method for updating -->
                                                            <h2 class="text-2xl font-semibold mb-4">Edit Amanat
                                                                Persalinan</h2>
                                                            <input type="hidden" name="id_ibu"
                                                                value="{{ $amanatItem->id_ibu }}">

                                                            {{-- Define the fields in an array --}}
                                                            @php
                                                                $fields = [
                                                                    [
                                                                        'label' => 'Bulan',
                                                                        'name' => 'bulan',
                                                                        'type' => 'text',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan bulan',
                                                                    ],
                                                                    [
                                                                        'label' => 'Tahun',
                                                                        'name' => 'tahun',
                                                                        'type' => 'number',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan tahun',
                                                                    ],
                                                                    [
                                                                        'label' => 'Dokter 1',
                                                                        'name' => 'dokter_1',
                                                                        'type' => 'text',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan nama dokter 1',
                                                                    ],
                                                                    [
                                                                        'label' => 'Dokter 2',
                                                                        'name' => 'dokter_2',
                                                                        'type' => 'text',
                                                                        'required' => false,
                                                                        'placeholder' =>
                                                                            'Masukkan nama dokter 2 (opsional)',
                                                                    ],
                                                                    [
                                                                        'label' => 'Dana Persalinan',
                                                                        'name' => 'dana_persalinan',
                                                                        'type' => 'text',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan dana persalinan',
                                                                    ],
                                                                    [
                                                                        'label' => 'Metode Persalinan',
                                                                        'name' => 'metode_persalinan',
                                                                        'type' => 'text',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan metode persalinan',
                                                                    ],
                                                                    [
                                                                        'label' => 'Golongan Darah',
                                                                        'name' => 'golongan_darah',
                                                                        'type' => 'text',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan golongan darah',
                                                                    ],
                                                                    [
                                                                        'label' => 'Rhesus',
                                                                        'name' => 'rhesus',
                                                                        'type' => 'text',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan rhesus',
                                                                    ],
                                                                ];
                                                            @endphp

                                                            {{-- Generate fields dynamically --}}
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                                @foreach ($fields as $field)
                                                                    <div>
                                                                        <label
                                                                            class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                                                                        <input type="{{ $field['type'] }}"
                                                                            name="{{ $field['name'] }}"
                                                                            class="input input-bordered w-full"
                                                                            placeholder="{{ $field['placeholder'] }}"
                                                                            value="{{ old($field['name'], $amanatItem->{$field['name']}) }}"
                                                                            @if ($field['required']) required @endif>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <h3 class="text-lg font-semibold mb-2">Kendaraan</h3>
                                                            @php
                                                                $kendaraanFields = [
                                                                    [
                                                                        'label' => 'Kendaraan 1',
                                                                        'name' => 'kendaraan_1',
                                                                        'hp' => 'hp_kendaraan_1',
                                                                        'required' => true,
                                                                        'placeholder' => 'Masukkan kendaraan 1',
                                                                        'hp_placeholder' => 'Masukkan HP kendaraan 1',
                                                                    ],
                                                                    [
                                                                        'label' => 'Kendaraan 2',
                                                                        'name' => 'kendaraan_2',
                                                                        'hp' => 'hp_kendaraan_2',
                                                                        'required' => false,
                                                                        'placeholder' =>
                                                                            'Masukkan kendaraan 2 (opsional)',
                                                                        'hp_placeholder' =>
                                                                            'Masukkan HP kendaraan 2 (opsional)',
                                                                    ],
                                                                    [
                                                                        'label' => 'Kendaraan 3',
                                                                        'name' => 'kendaraan_3',
                                                                        'hp' => 'hp_kendaraan_3',
                                                                        'required' => false,
                                                                        'placeholder' =>
                                                                            'Masukkan kendaraan 3 (opsional)',
                                                                        'hp_placeholder' =>
                                                                            'Masukkan HP kendaraan 3 (opsional)',
                                                                    ],
                                                                ];
                                                            @endphp

                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                                @foreach ($kendaraanFields as $kendaraan)
                                                                    <div>
                                                                        <label
                                                                            class="block text-sm font-medium text-gray-700">{{ $kendaraan['label'] }}</label>
                                                                        <input type="text"
                                                                            name="{{ $kendaraan['name'] }}"
                                                                            class="input input-bordered w-full"
                                                                            placeholder="{{ $kendaraan['placeholder'] }}"
                                                                            value="{{ old($kendaraan['name'], $amanatItem->{$kendaraan['name']}) }}">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block text-sm font-medium text-gray-700">No
                                                                            HP {{ $kendaraan['label'] }}</label>
                                                                        <input type="text"
                                                                            name="{{ $kendaraan['hp'] }}"
                                                                            class="input input-bordered w-full"
                                                                            placeholder="{{ $kendaraan['hp_placeholder'] }}"
                                                                            value="{{ old($kendaraan['hp'], $amanatItem->{$kendaraan['hp']}) }}">
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <h3 class="text-lg font-semibold mb-2">Bantuan</h3>
                                                            @php
                                                                $bantuanFields = [
                                                                    [
                                                                        'label' => 'Bantuan 1',
                                                                        'name' => 'bantuan_1',
                                                                        'hp' => 'hp_bantuan_1',
                                                                        'placeholder' => 'Masukkan bantuan 1',
                                                                        'hp_placeholder' => 'Masukkan HP bantuan 1',
                                                                    ],
                                                                    [
                                                                        'label' => 'Bantuan 2',
                                                                        'name' => 'bantuan_2',
                                                                        'hp' => 'hp_bantuan_2',
                                                                        'placeholder' =>
                                                                            'Masukkan bantuan 2 (opsional)',
                                                                        'hp_placeholder' =>
                                                                            'Masukkan HP bantuan 2 (opsional)',
                                                                    ],
                                                                    [
                                                                        'label' => 'Bantuan 3',
                                                                        'name' => 'bantuan_3',
                                                                        'hp' => 'hp_bantuan_3',
                                                                        'placeholder' =>
                                                                            'Masukkan bantuan 3 (opsional)',
                                                                        'hp_placeholder' =>
                                                                            'Masukkan HP bantuan 3 (opsional)',
                                                                    ],
                                                                    [
                                                                        'label' => 'Bantuan 4',
                                                                        'name' => 'bantuan_4',
                                                                        'hp' => 'hp_bantuan_4',
                                                                        'placeholder' =>
                                                                            'Masukkan bantuan 4 (opsional)',
                                                                        'hp_placeholder' =>
                                                                            'Masukkan HP bantuan 4 (opsional)',
                                                                    ],
                                                                ];
                                                            @endphp

                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                                @foreach ($bantuanFields as $bantuan)
                                                                    <div>
                                                                        <label
                                                                            class="block text-sm font-medium text-gray-700">{{ $bantuan['label'] }}</label>
                                                                        <input type="text"
                                                                            name="{{ $bantuan['name'] }}"
                                                                            class="input input-bordered w-full"
                                                                            placeholder="{{ $bantuan['placeholder'] }}"
                                                                            value="{{ old($bantuan['name'], $amanatItem->{$bantuan['name']}) }}">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block text-sm font-medium text-gray-700">No
                                                                            HP {{ $bantuan['label'] }}</label>
                                                                        <input type="text"
                                                                            name="{{ $bantuan['hp'] }}"
                                                                            class="input input-bordered w-full"
                                                                            placeholder="{{ $bantuan['hp_placeholder'] }}"
                                                                            value="{{ old($bantuan['hp'], $amanatItem->{$bantuan['hp']}) }}">
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <div class="flex justify-between mt-6">
                                                                <button type="button" class="btn btn-outline"
                                                                    onclick="document.getElementById('edit_amanat_modal_{{ $amanatItem->id_ibu }}').close();">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </dialog>
                                            @endforeach

                                            <x-lucide-printer class="cursor-pointer size-5 hover:stroke-blue-500"
                                                onclick="document.getElementById('detail_modal_{{ $item->id_user }}').showModal();" />

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
</x-dashboard.main>

{{-- <input type="checkbox" id="add_data_AMANAT_PERSALINAN_IBU_v1" class="modal-toggle" />
<div class="modal" role="dialog" id="AMANAT_PERSALINAN_IBU">
    <form onsubmit="setupFormGenerate(this, 'AMANAT_PERSALINAN_IBU', 'bkiabi-amanat-kesehatan.pdf')"
        action="javascript:void();" class="modal-box">
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
    <form onsubmit="parseForm(this)" action="javascript:void();"S class="modal-box">
        <h3 class="text-lg font-bold">Lengkapi Dokumen</h3>
        <div class="flex flex-col py-4" id="input_render_amanat_persalinan">

        </div>

        <div class="modal-action">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
            <button class="btn" type="button"
                onclick="document.getElementById('input_modal_{{ $item->id_user }}').close();">
                Tutup
            </button>
        </div>
    </form>
</dialog> --}}

{{-- <dialog id="detail_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Detail Amanat Persalinan</h3>
        <p class="py-4">Apakah Anda ingin mencetak dokumen Amanat
            Persalinan?</p>

        <div class="modal-action">
            <button onclick="generate()" class="btn btn-primary">
                Cetak
            </button>
            <button class="btn" onclick="document.getElementById('detail_modal_{{ $item->id_user }}').close();">
                Tutup
            </button>
        </div>
    </div>
</dialog> --}}

<script>
    let TEMP_STORE;

    window.onload = async () => {
        const data = await extractDocx({
            file: '/docx/bkiabi-amanat-persalinan.docx'
        })

        const keys = await extractDocxKeys(data)
        const filter = keys.original().filter(x => !x.startsWith('%'));

        renderFormInputs(filter, 'input_render_amanat_persalinan');
    }

    document.addEventListener('DOMContentLoaded', function() {
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
