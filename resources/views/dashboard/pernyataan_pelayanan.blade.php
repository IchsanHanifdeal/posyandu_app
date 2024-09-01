<x-dashboard.main title="Identitas Ibu Hamil">

    <!-- Main Container -->
    <div class="bg-white shadow-md rounded-lg p-6 mx-auto max-w-4xl">
        <!-- Header -->
        <div class="bg-green-500 text-white text-center py-2 font-bold rounded-t-md">
            PERNYATAAN IBU/KELUARGA TENTANG PELAYANAN KESEHATAN IBU YANG SUDAH DITERIMA
        </div>
        <div class="bg-green-200 text-center py-2 text-sm">
            Ibu menulis tanggal, tempat pelayanan; dan tenaga kesehatan membubuhkan paraf sesuai jenis pelayanan
        </div>
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-yellow-500 text-left">
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">Ibu Hamil<br> HPHT:</th>
                        <th class="border border-gray-300 px-2 py-1">Trimester I</th>
                        <th class="border border-gray-300 px-2 py-1">Trimester II</th>
                        <th class="border border-gray-300 px-2 py-1">Trimester III</th>
                    </tr>
                    <tr class="bg-yellow-500">
                        <th class="border border-gray-300 px-2 py-1">BB: TB: IMT:</th>
                        <th class="border border-gray-300 px-2 py-1">Periksa</th>
                        <th class="border border-gray-300 px-2 py-1">Periksa</th>
                        <th class="border border-gray-300 px-2 py-1">Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row Items -->
                    @php
                        $items = [
                            'Timbang',
                            'Ukur Lingkar Lengan Atas',
                            'Tekanan Darah',
                            'Periksa Tinggi Rahim',
                            'Periksa Letak dan Denyut Jantung Janin',
                            'Status dan Imunisasi Tetanus',
                            'Konseling',
                            'Skrining Dokter',
                            'Tablet Tambah Darah',
                            'Test Lab Hemoglobin (Hb)',
                            'Test Golongan Darah',
                            'Test Lab Protein Urine',
                            'Test Lab Gula Darah',
                            'PPIA',
                            'Tata Laksana Kasus'
                        ];
                    @endphp

                    @foreach($items as $item)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1">{{ $item }}</td>
                            <td class="border border-gray-300 px-2 py-1"></td>
                            <td class="border border-gray-300 px-2 py-1"></td>
                            <td class="border border-gray-300 px-2 py-1"></td>
                        </tr>
                    @endforeach

                    <!-- Additional Rows -->
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Ibu Bersalin TP:</td>
                        <td class="border border-gray-300 px-2 py-1" colspan="2">Fasilitas Kesehatan:</td>
                        <td class="border border-gray-300 px-2 py-1">Rujukan:</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Inisiasi Menyusu Dini</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Ibu Nifas sampai 42 hari setelah bersalin</td>
                        <td class="border border-gray-300 px-2 py-1">KF 1 (6-48 jam)</td>
                        <td class="border border-gray-300 px-2 py-1">KF 2 (3-7 hari)</td>
                        <td class="border border-gray-300 px-2 py-1">KF 3 (8-28 hari)</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Periksa Payudara (ASI)</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Periksa Perdarahan</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Periksa Jalan Lahir</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Vitamin A</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">KB Pasca Persalinan</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Konseling</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">Tata Laksana Kasus</td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                        <td class="border border-gray-300 px-2 py-1"></td>
                    </tr>
                    <tr class="bg-yellow-200">
                        <td class="border border-gray-300 px-2 py-1">Bayi baru lahir/ neonatus 0 - 28 hari</td>
                        <td class="border border-gray-300 px-2 py-1">KN 1 (6-48 jam)</td>
                        <td class="border border-gray-300 px-2 py-1">KN 2 (3-7 hari)</td>
                        <td class="border border-gray-300 px-2 py-1">KN 3 (8-28 hari)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer Note -->
        <div class="text-center mt-4 text-sm text-gray-600">
            Pastikan pelayanan kesehatan neonatus dicatatkan di bagian anak
        </div>
    </div>

</x-dashboard.main>
