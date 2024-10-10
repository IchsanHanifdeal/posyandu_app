<x-dashboard.main title="Evaluasi Kesehatan">
    <div class="grid grid-cols-1 gap-6">
        @foreach (['evaluasi_kesehatan'] as $item)
            <div
                class="flex flex-col w-full rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200">
                <div class="p-6 bg-gradient-to-r from-purple-400 to-pink-300 rounded-t-xl">
                    <div class="flex items-center justify-between">
                        <h1 class="text-lg font-semibold capitalize">{{ str_replace('_', ' ', $item) }}</h1>
                        <x-lucide-stethoscope class="w-6 h-6 text-white" />
                    </div>
                    <p class="text-sm mt-1 opacity-80">
                        Jelajahi dan ketahui amanat persalinan pada ibu hamil.
                    </p>
                </div>
                <div class="flex flex-col gap-4 p-6 bg-white rounded-b-xl">
                    <div class="overflow-x-auto">
                        <table class="table w-full table-zebra">
                            <thead class="bg-gray-100">
                                <tr>
                                    @foreach (['No', 'NIK', 'Nama', 'No Handphone', 'No Kohort'] as $header)
                                        <th class="font-bold text-center uppercase text-sm py-2">{{ $header }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ibu as $i => $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="text-center py-2">{{ $i + 1 }}</td>
                                        <td class="text-center">{{ $item->nik }}</td>
                                        <td class="text-center font-bold">{{ $item->user->nama }}</td>
                                        @php
                                            $phoneNumber = $item->user->no_hp;
                                            if (substr($phoneNumber, 0, 2) === '08') {
                                                $phoneNumber = '+628' . substr($phoneNumber, 2);
                                            }
                                            $waLink = 'https://wa.me/' . $phoneNumber;
                                        @endphp
                                        <td class="text-center text-blue-600 hover:underline">
                                            <a href="{{ $waLink }}" target="_blank">{{ $item->user->no_hp }}</a>
                                        </td>
                                        <td class="text-center">{{ $item->no_register_kohort }}</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-circle-plus class="cursor-pointer size-5 hover:stroke-blue-500"
                                                onclick="document.getElementById('store_modal_{{ $item->id_ibu }}').showModal();" />

                                            <dialog id="store_modal_{{ $item->id_ibu }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div
                                                    class="max-w-6xl p-8 transition-all duration-300 ease-in-out transform scale-95 bg-white shadow-xl modal-box rounded-xl hover:scale-100">
                                                    <form action="{{ route('store.evaluasi_kesehatan') }}"
                                                        method="POST">
                                                        @csrf
                                                        <h2
                                                            class="text-3xl font-semibold mb-6 text-center text-pink-600">
                                                            Amanat Persalinan</h2>
                                                        <input type="hidden" name="id_ibu"
                                                            value="{{ $item->id_ibu }}">
                                                        @php
                                                            $fields = [
                                                                [
                                                                    'label' => 'Tanggal',
                                                                    'name' => 'tanggal',
                                                                    'type' => 'date',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan tanggal',
                                                                ],
                                                                [
                                                                    'label' => 'Tinggi Badan',
                                                                    'name' => 'tb',
                                                                    'type' => 'number',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan Tinggi Badan',
                                                                ],
                                                                [
                                                                    'label' => 'Berat Badan',
                                                                    'name' => 'berat_badan',
                                                                    'type' => 'number',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan Berat Badan',
                                                                ],
                                                                [
                                                                    'label' => 'Lila',
                                                                    'name' => 'lila',
                                                                    'type' => 'number',
                                                                    'required' => true,
                                                                    'placeholder' => 'Masukkan Lila',
                                                                ],
                                                            ];
                                                        @endphp
                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">Kondisi
                                                            Kesehatan</h3>
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
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
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">IMT</label>
                                                                <select name="imt"
                                                                    class="input input-bordered w-full">
                                                                    <option value="kurus">Kurus</option>
                                                                    <option value="normal">Normal</option>
                                                                    <option value="obesitas">Obesitas</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">Riwayat
                                                            Kesehatan</h3>
                                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                                                            @php
                                                                $conditions = [
                                                                    'jantung' => 'Jantung',
                                                                    'hipertensi' => 'Hipertensi',
                                                                    'tyroid' => 'Tyroid',
                                                                    'alergi' => 'Alergi',
                                                                    'autoimun' => 'Autoimun',
                                                                    'asma' => 'Asma',
                                                                    'tb' => 'Tuberkulosis (TB)',
                                                                    'hepasitis_b' => 'Hepatitis B',
                                                                    'jiwa' => 'Gangguan Jiwa',
                                                                    'sifilis' => 'Sifilis',
                                                                    'diabetes' => 'Diabetes',
                                                                ];
                                                            @endphp
                                                            @foreach ($conditions as $name => $label)
                                                                <div class="form-control">
                                                                    <label class="label cursor-pointer">
                                                                        <span
                                                                            class="label-text">{{ $label }}</span>
                                                                        <input type="checkbox"
                                                                            name="{{ $name }}" value="1"
                                                                            class="checkbox checkbox-primary" />
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-control">
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Lainnya</label>
                                                                <input type="text" name="lainnya"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Tulis riwayat kesehatan lain jika ada">
                                                            </div>
                                                        </div>

                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">Status
                                                            Imunisasi</h3>
                                                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                                                            @php
                                                                $immunizations = [
                                                                    '1_bulan' => 'Imunisasi 1 Bulan',
                                                                    '6_bulan' => 'Imunisasi 6 Bulan',
                                                                    '12_bulan10' => 'Imunisasi 12 Bulan (Dosis 10)',
                                                                    '12_bulan25' => 'Imunisasi 12 Bulan (Dosis 25)',
                                                                ];
                                                            @endphp
                                                            @foreach ($immunizations as $name => $label)
                                                                <div class="form-control">
                                                                    <label class="label cursor-pointer">
                                                                        <span
                                                                            class="label-text">{{ $label }}</span>
                                                                        <input type="checkbox"
                                                                            name="{{ $name }}" value="1"
                                                                            class="checkbox checkbox-primary" />
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">Riwayat
                                                            Perilaku Berisiko</h3>
                                                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                                                            @php
                                                                $riskBehaviors = [
                                                                    'merokok' => 'Merokok',
                                                                    'pola_makan_beresiko' => 'Pola Makan Berisiko',
                                                                    'alkohol' => 'Mengonsumsi Alkohol',
                                                                    'obat-obatan' => 'Penggunaan Obat-obatan Terlarang',
                                                                    'kosmetik' => 'Penggunaan Kosmetik Berbahaya',
                                                                ];
                                                            @endphp
                                                            @foreach ($riskBehaviors as $name => $label)
                                                                <div class="form-control">
                                                                    <label class="label cursor-pointer">
                                                                        <span
                                                                            class="label-text">{{ $label }}</span>
                                                                        <input type="checkbox"
                                                                            name="{{ $name }}" value="1"
                                                                            class="checkbox checkbox-primary" />
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-control">
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Lainnya</label>
                                                                <input type="text" name="lainnya_perilaku"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Tulis perilaku berisiko lain jika ada">
                                                            </div>
                                                        </div>

                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">Riwayat
                                                            Kehamilan Terakhir</h3>
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Tahun</label>
                                                                <input type="number" name="tahun"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Masukkan tahun" required />
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Berat
                                                                    Lahir (gram)</label>
                                                                <input type="number" name="berat_lahir"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Masukkan berat lahir" required />
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Persalinan</label>
                                                                <input type="text" name="persalinan"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Masukkan jenis persalinan" />
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Penolong
                                                                    Persalinan</label>
                                                                <input type="text" name="penolong_persalinan"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Masukkan penolong persalinan" />
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Komplikasi</label>
                                                                <input type="text" name="komplikasi"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Masukkan komplikasi" />
                                                            </div>
                                                        </div>

                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">Riwayat
                                                            Penyakit Keluarga</h3>
                                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                                                            @php
                                                                $familyDiseases = [
                                                                    'hipertensi' => 'Hipertensi',
                                                                    'diabetes' => 'Diabetes',
                                                                    'sesak_nafas' => 'Sesak Nafas',
                                                                    'jantung' => 'Penyakit Jantung',
                                                                    'tb' => 'Tubercolosis',
                                                                    'alergi' => 'Alergi',
                                                                    'jiwa' => 'Penyakit Jiwa',
                                                                    'kelainan_darah' => 'Kelainan Darah',
                                                                    'hepasitis_b' => 'Hepatitis B',
                                                                ];
                                                            @endphp
                                                            @foreach ($familyDiseases as $name => $label)
                                                                <div class="form-control">
                                                                    <label class="label cursor-pointer">
                                                                        <span
                                                                            class="label-text">{{ $label }}</span>
                                                                        <input type="checkbox"
                                                                            name="{{ $name }}" value="1"
                                                                            class="checkbox checkbox-primary" />
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-control">
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Lainnya</label>
                                                                <input type="text" name="lainnya_penyakit"
                                                                    class="input input-bordered w-full"
                                                                    placeholder="Tulis penyakit keluarga lain jika ada">
                                                            </div>
                                                        </div>

                                                        <h3 class="text-2xl font-semibold mb-4 text-pink-500">
                                                            Pemeriksaan Khusus</h3>
                                                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Vulva</label>
                                                                <select name="vulva"
                                                                    class="input input-bordered w-full">
                                                                    <option value="normal">Normal</option>
                                                                    <option value="tidak_normal">Tidak Normal</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Uretra</label>
                                                                <select name="uretra"
                                                                    class="input input-bordered w-full">
                                                                    <option value="normal">Normal</option>
                                                                    <option value="tidak_normal">Tidak Normal</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Vagina</label>
                                                                <select name="vagina"
                                                                    class="input input-bordered w-full">
                                                                    <option value="normal">Normal</option>
                                                                    <option value="tidak_normal">Tidak Normal</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Porsio</label>
                                                                <select name="porsio"
                                                                    class="input input-bordered w-full">
                                                                    <option value="normal">Normal</option>
                                                                    <option value="tidak_normal">Tidak Normal</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="flex justify-between mt-6">
                                                            <button type="button" class="btn btn-outline btn-pink"
                                                                onclick="document.getElementById('store_modal_{{ $item->id_ibu }}').close();">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-pink">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </dialog>

                                            <x-lucide-trash class="cursor-pointer size-5 hover:stroke-red-500"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id_ibu }}').showModal();" />

                                            <dialog id="hapus_modal_{{ $item->id_ibu }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-base-100">
                                                    <h3 class="text-lg font-bold capitalize">Hapus
                                                        Evaluasi Kesehatan
                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="font-semibold text-red-800">Perhatian! Anda
                                                            sedang
                                                            mencoba untuk menghapus Evaluasi Kesehatan
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
                                                            action="{{ route('destroy.evaluasi_kesehatan', $item->id_ibu) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </dialog>

                                            <x-lucide-book-open-text
                                                class="cursor-pointer size-5 hover:stroke-blue-500"
                                                onclick="window.location.href='{{ route('show.evaluasi_kesehatan', $item->id_ibu) }}';" />

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
</x-dashboard.main>
