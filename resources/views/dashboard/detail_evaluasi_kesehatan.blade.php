<x-dashboard.main title="Detail Evaluasi Kesehatan">
    <div class="container mx-auto py-8 px-4">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-pink-600 mb-4 sm:mb-0">Detail Evaluasi Kesehatan {{ $ibu->user->nama }}</h1>
            <a href="{{ route('evaluasi_kesehatan') }}" class="btn btn-outline btn-primary">
                Kembali ke Daftar
            </a>
        </div>

        <!-- Section: Kondisi Kesehatan -->
        <div class="card bg-pink-50 shadow-xl mb-6">
            <div class="card-body">
                <h2 class="card-title text-pink-600">Kondisi Kesehatan</h2>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-600">
                    <div><strong>Tanggal Pemeriksaan:</strong> {{ $kondisiKesehatan->tanggal }}</div>
                    <div><strong>Tinggi Badan (TB):</strong> {{ $kondisiKesehatan->tb }} cm</div>
                    <div><strong>Berat Badan (BB):</strong> {{ $kondisiKesehatan->bb }} kg</div>
                    <div><strong>LILA:</strong> {{ $kondisiKesehatan->lila }} cm</div>
                    <div><strong>Indeks Massa Tubuh (IMT):</strong> {{ ucfirst($kondisiKesehatan->imt) }}</div>
                </div>
            </div>
        </div>

        <!-- Section: Riwayat Kesehatan -->
        <div class="card bg-pink-50 shadow-xl mb-6">
            <div class="card-body">
                <h2 class="card-title text-pink-600">Riwayat Kesehatan</h2>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-600">
                    @foreach (['jantung', 'hipertensi', 'tyroid', 'alergi', 'autoimun', 'asma', 'tb', 'hepasitis_b', 'jiwa', 'sifilis', 'diabetes'] as $penyakit)
                        <div><strong>{{ ucfirst($penyakit) }}:</strong> {{ $riwayatKesehatan->$penyakit ? 'Ya' : 'Tidak' }}</div>
                    @endforeach
                    <div class="col-span-2"><strong>Penyakit Lainnya:</strong> {{ $riwayatKesehatan->lainnya ?? 'Tidak ada' }}</div>
                </div>
            </div>
        </div>

        <!-- Section: Status Imunisasi -->
        <div class="card bg-pink-50 shadow-xl mb-6">
            <div class="card-body">
                <h2 class="card-title text-pink-600">Status Imunisasi</h2>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-600">
                    <div><strong>1 Bulan:</strong> {{ $statusImunisasi->bulan_1 ? 'Ya' : 'Tidak' }}</div>
                    <div><strong>6 Bulan:</strong> {{ $statusImunisasi->bulan_6 ? 'Ya' : 'Tidak' }}</div>
                    <div><strong>12 Bulan (TT 10):</strong> {{ $statusImunisasi->bulan_12_10 ? 'Ya' : 'Tidak' }}</div>
                    <div><strong>12 Bulan (TT 25):</strong> {{ $statusImunisasi->bulan_12_25 ? 'Ya' : 'Tidak' }}</div>
                </div>
            </div>
        </div>

        <!-- Section: Riwayat Perilaku Beresiko -->
        <div class="card bg-pink-50 shadow-xl mb-6">
            <div class="card-body">
                <h2 class="card-title text-pink-600">Riwayat Perilaku Beresiko</h2>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-600">
                    @foreach (['merokok', 'pola_makan_beresiko', 'alkohol', 'obat_obatan', 'kosmetik'] as $perilaku)
                        <div><strong>{{ ucfirst(str_replace('_', ' ', $perilaku)) }}:</strong> {{ $riwayatPerilakuBeresiko->$perilaku ? 'Ya' : 'Tidak' }}</div>
                    @endforeach
                    <div class="col-span-2"><strong>Perilaku Lainnya:</strong> {{ $riwayatPerilakuBeresiko->lainnya ?? 'Tidak ada' }}</div>
                </div>
            </div>
        </div>

        <!-- Section: Riwayat Kehamilan -->
        <div class="card bg-pink-50 shadow-xl mb-6">
            <div class="card-body">
                <h2 class="card-title text-pink-600">Riwayat Kehamilan</h2>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-600">
                    <div><strong>Tahun:</strong> {{ $riwayatKehamilan->tahun ?? 'Tidak ada' }}</div>
                    <div><strong>Berat Lahir:</strong> {{ $riwayatKehamilan->berat_lahir ?? 'Tidak ada' }}</div>
                    <div><strong>Persalinan:</strong> {{ $riwayatKehamilan->persalinan ?? 'Tidak ada' }}</div>
                    <div><strong>Penolong Persalinan:</strong> {{ $riwayatKehamilan->penolong_persalinan ?? 'Tidak ada' }}</div>
                    <div><strong>Komplikasi:</strong> {{ $riwayatKehamilan->komplikasi ?? 'Tidak ada' }}</div>
                </div>
            </div>
        </div>

        <!-- Section: Pemeriksaan Khusus -->
        <div class="card bg-pink-50 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-pink-600">Pemeriksaan Khusus</h2>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-600">
                    <div><strong>Vulva:</strong> {{ ucfirst(str_replace('_', ' ', $pemeriksaanKhusus->vulva)) }}</div>
                    <div><strong>Uretra:</strong> {{ ucfirst(str_replace('_', ' ', $pemeriksaanKhusus->uretra)) }}</div>
                    <div><strong>Vagina:</strong> {{ ucfirst(str_replace('_', ' ', $pemeriksaanKhusus->vagina)) }}</div>
                    <div><strong>Porsio:</strong> {{ ucfirst(str_replace('_', ' ', $pemeriksaanKhusus->porsio)) }}</div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.main>
