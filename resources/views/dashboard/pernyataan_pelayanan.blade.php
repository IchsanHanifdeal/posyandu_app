<x-dashboard.main title="Identitas Ibu Hamil">
  <div class="flex flex-col gap-5 p-5">
      <div class="flex gap-5">
            @if (Auth::user()->role === 'admin')
                @foreach (['pernyataan_ibu/keluarga_tentang_pelayanan_kesehatan_ibu_yang_sudah_diterima'] as $headerItem)
                    <div class="flex flex-col border-back rounded-xl w-full">
                        <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                            <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                                {{ str_replace('_', ' ', $headerItem) }}
                            </h1>
                            <p class="text-sm opacity-60">
                                Ibu menulis tanggal, tempat pelayanan; dan tenaga kesehatan membubuhkan paraf sesuai
                                jenis pelayanan.
                            </p>
                        </div>
                        <div class="flex flex-col rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                            <div class="overflow-x-auto">
                                <table class="table table-zebra w-full">
                                    <thead>
                                        <tr>
                                            @foreach (['No', 'NIK', 'Nama', 'No Handphone', 'No Kohort'] as $header)
                                                <th class="uppercase font-bold text-center">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="capitalize">
                                        @forelse ($ibu as $index => $ibuItem)
                                            <tr>
                                                <th class="font-semibold text-center">{{ $index + 1 }}</th>
                                                <td class="text-center">{{ $ibuItem->nik }}</td>
                                                <td class="font-bold text-center">{{ $ibuItem->user->nama }}</td>
                                                @php
                                                    $phoneNumber = $ibuItem->user->no_hp;
                                                    if (substr($phoneNumber, 0, 2) === '08') {
                                                        $phoneNumber = '+628' . substr($phoneNumber, 2);
                                                    }
                                                    $waLink = 'https://wa.me/' . $phoneNumber;
                                                @endphp
                                                <td class="font-semibold text-blue-700 text-center">
                                                    <a href="{{ $waLink }}"
                                                        target="_blank">{{ $ibuItem->user->no_hp }}</a>
                                                </td>
                                                <td class="text-center">{{ $ibuItem->no_register_kohort }}</td>
                                                <td class="flex items-center gap-4">
                                                    <!-- Trigger Button -->
                                                    <x-lucide-book-user
                                                        class="size-5 hover:stroke-green-500 cursor-pointer"
                                                        onclick="document.getElementById('detail_modal_{{ $ibuItem->id_user }}').showModal();" />
                                                    <dialog id="detail_modal_{{ $ibuItem->id_user }}"
                                                        class="modal modal-bottom sm:modal-middle">
                                                        <div
                                                            class="modal-box bg-white rounded-xl p-8 shadow-xl transform transition-all duration-300 ease-in-out scale-95 hover:scale-100 max-w-6xl">
                                                            <div class="flex justify-between items-center mb-6">
                                                                <div class="flex items-center">
                                                                    <div
                                                                        class="card bg-base-100 shadow-xl rounded-lg border border-base-300">
                                                                        <div
                                                                            class="card-header p-5 border-b border-base-200">
                                                                            <h1
                                                                                class="text-2xl font-semibold text-base-content uppercase">
                                                                                {{ str_replace('_', ' ', $headerItem) }}
                                                                            </h1>
                                                                            <p class="text-sm text-base-content mt-2">
                                                                            </p>
                                                                        </div>
                                                                        <div class="card-body p-5">
                                                                            <div class="overflow-x-auto">
                                                                                <table
                                                                                    class="table w-full border-separate border-spacing-2 bg-base-200 rounded-lg">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="bg-base-300 text-base-content font-semibold p-3 border rounded-tl-lg"
                                                                                                rowspan="2">
                                                                                                Ibu Hamil<br> HPHT: <br>
                                                                                                BB: TB: IMT:
                                                                                            </th>
                                                                                            <th class="bg-base-300 text-base-content font-semibold p-4 border"
                                                                                                colspan="2">Trimester
                                                                                                I</th>
                                                                                            <th class="bg-base-300 text-base-content font-semibold p-4 border"
                                                                                                colspan="1">Trimester
                                                                                                II</th>
                                                                                            <th class="bg-base-300 text-base-content font-semibold p-4 border"
                                                                                                colspan="3">Trimester
                                                                                                III</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th
                                                                                                class="bg-base-200 text-base-content font-semibold p-4 border">
                                                                                                Periksa</th>
                                                                                            <th
                                                                                                class="bg-base-200 text-base-content font-semibold p-4 border">
                                                                                                Periksa</th>
                                                                                            <th
                                                                                                class="bg-base-200 text-base-content font-semibold p-4 border">
                                                                                                Periksa</th>
                                                                                            <th
                                                                                                class="bg-base-200 text-base-content font-semibold p-4 border">
                                                                                                Periksa</th>
                                                                                            <th
                                                                                                class="bg-base-200 text-base-content font-semibold p-4 border">
                                                                                                Periksa</th>
                                                                                            <th
                                                                                                class="bg-base-200 text-base-content font-semibold p-4 border">
                                                                                                Periksa</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach (['Timbang', 'Ukur Lingkar Lengan Atas', 'Tekanan Darah', 'Periksa Tinggi Rahim', 'Periksa Letak dan Denyut Jantung Janin', 'Status dan Imunisasi Tetanus', 'Konseling', 'Skrining Dokter', 'Tablet Tambah Darah', 'Test Lab Hemoglobin (Hb)', 'Test Golongan Darah', 'Test Lab Protein Urine', 'Test Lab Gula Darah', 'PPIA', 'Tata Laksana Kasus'] as $checkup)
                                                                                            <tr
                                                                                                class="hover:bg-base-300 transition-colors">
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                    {{ $checkup }}
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                        <tr>
                                                                                            <td
                                                                                                class="font-semibold p-4 border border-base-300">
                                                                                                Ibu Bersalin TP:</td>
                                                                                            <td colspan="2"
                                                                                                class="font-semibold p-4 border border-base-300">
                                                                                                Fasilitas Kesehatan:
                                                                                            </td>
                                                                                            <td colspan="4"
                                                                                                class="font-semibold p-4 border border-base-300">
                                                                                                Rujukan:</td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            class="hover:bg-base-300 transition-colors">
                                                                                            <td
                                                                                                class="font-semibold p-4 border border-base-300 capitalize">
                                                                                                Inisiasi Menyusu Dini
                                                                                            </td>
                                                                                            <td class="p-4 border border-base-300"
                                                                                                id="testing"
                                                                                                colspan="6"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th
                                                                                                class="bg-base-300 text-base-content font-bold p-4 border border-base-300 capitalize rounded-bl-lg">
                                                                                                Ibu Nifas sampai 42 hari
                                                                                                setelah bersalin</th>
                                                                                            <th
                                                                                                class="bg-base-300 text-base-content font-bold p-4 border border-base-300">
                                                                                                KF 1 (6-48 jam)</th>
                                                                                            <th
                                                                                                class="bg-base-300 text-base-content font-bold p-4 border border-base-300">
                                                                                                KF 2 (3-7 hari)</th>
                                                                                            <th
                                                                                                class="bg-base-300 text-base-content font-bold p-4 border border-base-300">
                                                                                                KF 3 (8-28 hari)</th>
                                                                                            <th class="bg-base-300 text-base-content font-bold p-4 border border-base-300"
                                                                                                colspan="3">KF 4
                                                                                                (28-42 hari)
                                                                                            </th>
                                                                                        </tr>
                                                                                        @foreach (['Periksa Payudara (ASI)', 'Periksa Pendarahan', 'Periksa Jalan Lahir', 'Vitamin A', 'Konseling', 'Imunisasi'] as $postpartumCheckup)
                                                                                            <tr
                                                                                                class="hover:bg-base-300 transition-colors">
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                    {{ $postpartumCheckup }}
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="p-4 border border-base-300">
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <button class="btn btn-sm"
                                                                    onclick="document.getElementById('detail_modal_{{ $ibuItem->id_user }}').close();">Close</button>
                                                            </div>
                                                        </div>
                                                    </dialog>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach (['pernyataan_ibu/keluarga_tentang_pelayanan_kesehatan_ibu_yang_sudah_diterima'] as $headerItem)
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center">
                            <div class="card bg-base-100 shadow-xl rounded-lg border border-base-300">
                                <div class="card-header p-5 border-b border-base-200">
                                    <h1 class="text-2xl font-semibold text-base-content uppercase">
                                        {{ str_replace('_', ' ', $headerItem) }}
                                    </h1>
                                    <p class="text-sm text-base-content mt-2">
                                    </p>
                                </div>
                                <div class="card-body p-5">
                                    <div class="overflow-x-auto">
                                        <table
                                            class="table w-full border-separate border-spacing-2 bg-base-200 rounded-lg">
                                            <thead>
                                                <tr>
                                                    <th class="bg-base-300 text-base-content font-semibold p-3 border rounded-tl-lg"
                                                        rowspan="2">
                                                        Ibu Hamil<br> HPHT: <br>
                                                        BB: TB: IMT:
                                                    </th>
                                                    <th class="bg-base-300 text-base-content font-semibold p-4 border"
                                                        colspan="2">Trimester
                                                        I</th>
                                                    <th class="bg-base-300 text-base-content font-semibold p-4 border"
                                                        colspan="1">Trimester
                                                        II</th>
                                                    <th class="bg-base-300 text-base-content font-semibold p-4 border"
                                                        colspan="3">Trimester
                                                        III</th>
                                                </tr>
                                                <tr>
                                                    <th class="bg-base-200 text-base-content font-semibold p-4 border">
                                                        Periksa</th>
                                                    <th class="bg-base-200 text-base-content font-semibold p-4 border">
                                                        Periksa</th>
                                                    <th class="bg-base-200 text-base-content font-semibold p-4 border">
                                                        Periksa</th>
                                                    <th class="bg-base-200 text-base-content font-semibold p-4 border">
                                                        Periksa</th>
                                                    <th class="bg-base-200 text-base-content font-semibold p-4 border">
                                                        Periksa</th>
                                                    <th class="bg-base-200 text-base-content font-semibold p-4 border">
                                                        Periksa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (['Timbang', 'Ukur Lingkar Lengan Atas', 'Tekanan Darah', 'Periksa Tinggi Rahim', 'Periksa Letak dan Denyut Jantung Janin', 'Status dan Imunisasi Tetanus', 'Konseling', 'Skrining Dokter', 'Tablet Tambah Darah', 'Test Lab Hemoglobin (Hb)', 'Test Golongan Darah', 'Test Lab Protein Urine', 'Test Lab Gula Darah', 'PPIA', 'Tata Laksana Kasus'] as $checkup)
                                                    <tr class="hover:bg-base-300 transition-colors">
                                                        <td class="p-4 border border-base-300">
                                                            {{ $checkup }}
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="font-semibold p-4 border border-base-300">
                                                        Ibu Bersalin TP:</td>
                                                    <td colspan="2"
                                                        class="font-semibold p-4 border border-base-300">
                                                        Fasilitas Kesehatan:
                                                    </td>
                                                    <td colspan="4"
                                                        class="font-semibold p-4 border border-base-300">
                                                        Rujukan:</td>
                                                </tr>
                                                <tr class="hover:bg-base-300 transition-colors">
                                                    <td class="font-semibold p-4 border border-base-300 capitalize">
                                                        Inisiasi Menyusu Dini
                                                    </td>
                                                    <td class="p-4 border border-base-300" id="testing"
                                                        colspan="6">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th
                                                        class="bg-base-300 text-base-content font-bold p-4 border border-base-300 capitalize rounded-bl-lg">
                                                        Ibu Nifas sampai 42 hari
                                                        setelah bersalin</th>
                                                    <th
                                                        class="bg-base-300 text-base-content font-bold p-4 border border-base-300">
                                                        KF 1 (6-48 jam)</th>
                                                    <th
                                                        class="bg-base-300 text-base-content font-bold p-4 border border-base-300">
                                                        KF 2 (3-7 hari)</th>
                                                    <th
                                                        class="bg-base-300 text-base-content font-bold p-4 border border-base-300">
                                                        KF 3 (8-28 hari)</th>
                                                    <th class="bg-base-300 text-base-content font-bold p-4 border border-base-300"
                                                        colspan="3">KF 4
                                                        (28-42 hari)
                                                    </th>
                                                </tr>
                                                @foreach (['Periksa Payudara (ASI)', 'Periksa Pendarahan', 'Periksa Jalan Lahir', 'Vitamin A', 'Konseling', 'Imunisasi'] as $postpartumCheckup)
                                                    <tr class="hover:bg-base-300 transition-colors">
                                                        <td class="p-4 border border-base-300">
                                                            {{ $postpartumCheckup }}
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                        <td class="p-4 border border-base-300">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-dashboard.main>
