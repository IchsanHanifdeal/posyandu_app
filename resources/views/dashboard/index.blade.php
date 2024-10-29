<x-dashboard.main title="Dashboard">
    @if (Auth::user()->role === 'admin')
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <!-- Ucapan Selamat -->
            <div
                class="bg-gradient-to-br from-pink-200 via-red-200 to-purple-200 p-6 rounded-xl shadow-lg transition-transform transform hover:scale-105 hover:shadow-2xl flex items-center">
                <div class="flex items-center justify-center w-16 h-16 bg-red-500 text-white rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m9-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-6">
                    <div id="greeting-message" class="text-red-800 text-2xl font-extrabold"></div>
                    <p class="text-sm font-medium text-red-600 mt-2 tracking-wide">
                        Terima kasih atas dedikasi Anda sebagai Kader Posyandu! Mari bersama-sama meningkatkan kesehatan
                        ibu dan anak di komunitas kita. Jangan lupa untuk selalu memantau perkembangan si kecil dan
                        memberikan informasi terbaru kepada para ibu.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <!-- Valentine Themed Cards -->
            @foreach (['sasaran_balita_perbulan', 'sasaran_D/s_perbulan', 'sasaran_ibu_hamil', 'ibu_hamil_yang_dapat_pelayanan', 'sasaran_remaja', 'remaja_yang_dapat_pelayanan_kesehatan', 'sasaran_usia_produktif', 'usia_produktif_yang_dapat_pelayanan_kesehatan', 'sasaran_lansia', 'lansia_yang_dapat_pelayanan_kesehatan', 'jumlah_bayi_yang_di_imunisasi', 'jumlah_kunjungan_rumah'] as $item)
                <div
                    class="bg-gradient-to-br from-pink-200 via-red-200 to-purple-200 p-6 rounded-xl shadow-lg transition-transform transform hover:scale-105 hover:shadow-2xl flex items-center">
                    <div class="ml-6">
                        <div id="{{ $item }}" class="text-red-800 text-2xl font-extrabold">
                            {{-- @if ($item == 'rata_rata_tinggi_anak')
                                {{ $rata_rata_tinggi_anak ?? '0' }} cm
                            @elseif ($item == 'rata_rata_berat_anak')
                                {{ $rata_rata_berat_anak ?? '0' }} kg --}}
                            @if ($item == 'sasaran_balita_perbulan')
                                {{ $sasaran_balita_perbulan ?? '-' }}
                            @elseif ($item == 'sasaran_D/s_perbulan')
                                {{ $sasaran_D_s_perbulan ?? '-' }}
                            @elseif ($item == 'sasaran_ibu_hamil')
                                {{ $sasaran_ibu_hamil ?? '-' }}
                            @elseif ($item == 'ibu_hamil_yang_dapat_pelayanan')
                                {{ $ibu_hamil_yang_dapat_pelayanan ?? '-' }}
                            @elseif ($item == 'sasaran_remaja')
                                {{ $sasaran_remaja ?? '-' }}
                            @elseif ($item == 'remaja_yang_dapat_pelayanan_kesehatan')
                                {{ $remaja_yang_dapat_pelayanan_kesehatan ?? '-' }}
                            @elseif ($item == 'sasaran_usia_produktif')
                                {{ $sasaran_usia_produktif ?? '-' }}
                            @elseif ($item == 'usia_produktif_yang_dapat_pelayanan_kesehatan')
                                {{ $usia_produktif_yang_dapat_pelayanan_kesehatan ?? '-' }}
                            @elseif ($item == 'sasaran_lansia')
                                {{ $sasaran_lansia ?? '-' }}
                            @elseif ($item == 'lansia_yang_dapat_pelayanan_kesehatan')
                                {{ $lansia_yang_dapat_pelayanan_kesehatan ?? '-' }}
                            @elseif ($item == 'jumlah_bayi_yang_di_imunisasi')
                                {{ $jumlah_bayi_yang_di_imunisasi ?? '-' }}
                            @elseif ($item == 'jumlah_kunjungan_rumah')
                                {{ $jumlah_kunjungan_rumah ?? '-' }}
                            @else
                                {{ '-' }}
                            @endif
                        </div>
                        <p class="text-sm font-medium text-red-600 mt-1 capitalize tracking-wide">
                            {{ str_replace('_', ' ', $item) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="text-center font-bold text-lg text-red-600">Rekapitulasi Perbulan</h3>
                    <div class="overflow-x-auto">
                        <canvas id="monthlyChart" class="w-full h-96"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Data dari server
            var months = {!! $months !!};
            var dataMonthly = {!! $dataMonthly !!};

            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'bar', // Mengubah tipe chart menjadi bar chart
                data: {
                    labels: months,
                    datasets: [{
                            label: 'Sasaran Balita',
                            data: dataMonthly.sasaran_balita_perbulan,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        },
                        {
                            label: 'Sasaran DS',
                            data: dataMonthly.sasaran_D_s_perbulan,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            fill: false
                        },
                        {
                            label: 'Sasaran Ibu Hamil',
                            data: dataMonthly.sasaran_ibu_hamil,
                            backgroundColor: 'rgba(153, 102, 255, 0.5)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            fill: false
                        },
                        {
                            label: 'Ibu Hamil Dapat Pelayanan',
                            data: dataMonthly.ibu_hamil_yang_dapat_pelayanan,
                            backgroundColor: 'rgba(255, 206, 86, 0.5)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            fill: false
                        },
                        {
                            label: 'Sasaran Remaja',
                            data: dataMonthly.sasaran_remaja,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            fill: false
                        },
                        {
                            label: 'Remaja Dapat Pelayanan Kesehatan',
                            data: dataMonthly.remaja_yang_dapat_pelayanan_kesehatan,
                            backgroundColor: 'rgba(255, 159, 64, 0.5)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            fill: false
                        },
                        {
                            label: 'Sasaran Usia Produktif',
                            data: dataMonthly.sasaran_usia_produktif,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        },
                        {
                            label: 'Usia Produktif Dapat Pelayanan Kesehatan',
                            data: dataMonthly.usia_produktif_yang_dapat_pelayanan_kesehatan,
                            backgroundColor: 'rgba(153, 102, 255, 0.5)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            fill: false
                        },
                        {
                            label: 'Sasaran Lansia',
                            data: dataMonthly.sasaran_lansia,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            fill: false
                        },
                        {
                            label: 'Lansia Dapat Pelayanan Kesehatan',
                            data: dataMonthly.lansia_yang_dapat_pelayanan_kesehatan,
                            backgroundColor: 'rgba(255, 206, 86, 0.5)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            fill: false
                        },
                        {
                            label: 'Jumlah Bayi Diimunisasi',
                            data: dataMonthly.jumlah_bayi_yang_di_imunisasi,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            fill: false
                        },
                        {
                            label: 'Jumlah Kunjungan Rumah',
                            data: dataMonthly.jumlah_kunjungan_rumah,
                            backgroundColor: 'rgba(153, 102, 255, 0.5)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            fill: false
                        }
                    ]
                },

                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        }
                    }
                },
                plugins: [{
                    id: 'scroll',
                    beforeInit: function(chart) {
                        chart.canvas.parentNode.style.overflowX = 'auto';
                        chart.canvas.parentNode.style.whiteSpace = 'nowrap';
                        chart.canvas.style.width = (months.length * 50) + 'px';
                    }
                }]
            });
        </script>
    @elseif (Auth::user()->role === 'user')
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <!-- Ucapan Selamat -->
            <div
                class="bg-gradient-to-br from-pink-200 via-red-200 to-purple-200 p-6 rounded-xl shadow-lg transition-transform transform hover:scale-105 hover:shadow-2xl flex items-center">
                <div class="flex items-center justify-center w-16 h-16 bg-red-500 text-white rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m9-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-6">
                    <div id="greeting-message" class="text-red-800 text-2xl font-extrabold"></div>
                    <p class="text-sm font-medium text-red-600 mt-2 tracking-wide">
                        Kami berharap Anda memiliki hari yang produktif dan menyenangkan! Jangan lupa untuk memeriksa
                        statistik terbaru dan informasi penting terkait perkembangan anak.
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Valentine Themed Cards -->
            @foreach (['nama_anak', 'tinggi_badan_terbaru', 'berat_badan_terbaru'] as $item)
                <div
                    class="bg-gradient-to-br from-pink-200 via-red-200 to-purple-200 p-6 rounded-xl shadow-lg transition-transform transform hover:scale-105 hover:shadow-2xl flex items-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-red-500 text-white rounded-full shadow-md">
                        @if ($item == 'nama_anak')
                            <x-lucide-baby class="h-8 w-8" />
                        @elseif ($item == 'tinggi_badan_terbaru')
                            <x-lucide-ruler class="h-8 w-8" />
                        @elseif ($item == 'berat_badan')
                            <x-lucide-dumbbell class="h-8 w-8" />
                        @endif
                    </div>
                    <div class="ml-6">
                        <div id="{{ $item }}" class="text-red-800 text-2xl font-extrabold">
                            {{ $item == 'nama_anak' ? $nama_anak ?? '-' : '' }}
                            {{ $item == 'tinggi_badan_terbaru' ? $tinggi_badan . ' cm' ?? '0' : '' }}
                            {{ $item == 'berat_badan_terbaru' ? $berat_badan . ' kg' ?? '0' : '' }}
                        </div>
                        <p class="text-sm font-medium text-red-600 mt-1 capitalize tracking-wide">
                            {{ str_replace('_', ' ', $item) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- User Trends Chart -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            @foreach (['tinggi_badan', 'berat_badan'] as $item)
                <div class="card shadow-xl bg-white p-6 rounded-lg hover:shadow-2xl transition-all">
                    <div class="flex justify-between items-center">
                        <h3 class="text-pink-600 font-bold text-lg capitalize">{{ str_replace('_', ' ', $item) }}</h3>
                    </div>

                    <!-- Line Chart Canvas -->
                    <div class="mt-4 h-64 flex items-center justify-center bg-pink-50 rounded-lg shadow-inner">
                        <canvas id="{{ $item }}-chart" class="w-full h-full"></canvas>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            const tinggiBadanData = {!! json_encode($perkembanganTinggiBadan ?? []) !!}.reverse(); // Reverse the data
            const beratBadanData = {!! json_encode($perkembanganBeratBadan ?? []) !!}.reverse(); // Reverse the data
            const tanggalPemeriksaan = {!! json_encode($tanggalpemeriksaan ?? []) !!}.reverse(); // Reverse the dates

            const ctxTinggi = document.getElementById('tinggi_badan-chart').getContext('2d');
            new Chart(ctxTinggi, {
                type: 'line',
                data: {
                    labels: tanggalPemeriksaan,
                    datasets: [{
                        label: 'Tinggi Badan (cm)',
                        data: tinggiBadanData,
                        borderColor: '#D926A9',
                        backgroundColor: 'rgba(217, 38, 169, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal Pemeriksaan' // Title for x-axis
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Tinggi Badan (cm)' // Title for y-axis
                            },
                            beginAtZero: false
                        }
                    }
                }
            });

            const ctxBerat = document.getElementById('berat_badan-chart').getContext('2d');
            new Chart(ctxBerat, {
                type: 'line',
                data: {
                    labels: tanggalPemeriksaan,
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: beratBadanData,
                        borderColor: '#FB7185',
                        backgroundColor: 'rgba(251, 113, 133, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal Pemeriksaan' // Title for x-axis
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Berat Badan (kg)' // Title for y-axis
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endif
    <script>
        const now = new Date();
        const hours = now.getHours();
        const namaUser = "{{ Auth::user()->nama }}";
        let greeting;

        if (hours < 12) {
            greeting = "Selamat Pagi " + namaUser + ", Selamat datang di Dashboard MyPosyandu";
        } else if (hours < 18) {
            greeting = "Selamat Siang " + namaUser + ", Selamat datang di Dashboard MyPosyandu";
        } else {
            greeting = "Selamat Malam " + namaUser + ", Selamat datang di Dashboard MyPosyandu";
        }

        // Menampilkan ucapan sesuai waktu
        document.getElementById('greeting-message').textContent = greeting;
    </script>
</x-dashboard.main>
