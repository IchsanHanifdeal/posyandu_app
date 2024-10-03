<div class="drawer-side border-r z-20">
    <label for="aside-dashboard" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul
        class="bg-[#f7e8f3] menu flex flex-col justify-between p-4 w-64 lg:w-72 min-h-full scrollbar-custom [&>li>a]:gap-4 [&>li]:my-1.5 [&>li]:text-[14.3px] [&>li]:font-medium [&>li]:text-opacity-80 [&>li]:text-base [&>_*_svg]:stroke-[1.5] [&>_*_svg]:size-[23px]">
        <div>
            <div class="pb-4 border-b border-gray-300">
                @include('components.brands', ['class' => 'btn btn-ghost text-2xl'])
            </div>
            <span class="label text-xs font-extrabold opacity-50">GENERAL</span>
            <li>
                <a href="{{ route('dashboard') }}" class="{!! Request::path() == 'dashboard' ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                    <x-lucide-bar-chart-2 />
                    Dashboard
                </a>
            </li>
            @if (Auth::user()->role === 'super_admin')
                <span class="label text-xs font-extrabold opacity-50">MAIN DATA</span>
                <li>
                    <a href="{{ route('posyandu') }}"
                        class="{!! Request::path() == 'dashboard/posyandu' ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-house-plus />
                        Data Posyandu
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna') }}"
                        class="{!! Request::path() == 'dashboard/pengguna' ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-users />
                        Data Pengguna
                    </a>
                </li>
            @elseif (Auth::user()->role === 'admin' || Auth::user()->role === 'user')
                <span class="label text-xs font-extrabold opacity-50">CATATAN IBU</span>
                <li>
                    <a href="{{ route('identitas_ibu_hamil') }}"
                        class="{!! preg_match('#^dashboard/identitas_ibu_hamil.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-user-check />
                        Identitas Ibu Hamil
                    </a>
                </li>
                <li>
                    <a href="{{ route('pernyataan_pelayanan') }}"
                        class="{!! preg_match('#^dashboard/pernyataan.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-file-text />
                        Pernyataan Pelayanan Ibu
                    </a>
                </li>
                <li>
                    <a href="{{ route('amanat_persalinan') }}"
                        class="{!! preg_match('#^dashboard/amanat.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-clipboard />
                        Amanat Persalinan Ibu
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelayanan_dokter') }}"
                        class="{!! preg_match('#^dashboard/pelayanan_dokter.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-stethoscope />
                        Pelayanan Dokter
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelayanan_kehamilan') }}"
                        class="{!! preg_match('#^dashboard/pelayanan_kehamilan.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-heart />
                        Pelayanan Kehamilan
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelayanan_nifas') }}"
                        class="{!! preg_match('#^dashboard/pelayanan_nifas.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-bed />
                        Pelayanan Nifas
                    </a>
                </li>
                <li>
                    <a href="{{ route('rujukan') }}"
                        class="{!! preg_match('#^dashboard/rujukan.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-link />
                        Rujukan
                    </a>
                </li>
                <span class="label text-xs font-extrabold opacity-50">INFORMASI IBU</span>
                <li>
                    <a href="{{ route('ibu_hamil') }}"
                        class="{!! preg_match('#^dashboard/ibu_hamil.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-info />
                        Informasi Ibu Hamil
                    </a>
                </li>
                <li>
                    <a href="{{ route('ibu_bersalin') }}"
                        class="{!! preg_match('#^dashboard/ibu_bersalin.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Informasi Ibu Bersalin
                    </a>
                </li>
                <li>
                    <a href="{{ route('ibu_nifas') }}"
                        class="{!! preg_match('#^dashboard/ibu_nifas.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Informasi Ibu Nifas
                    </a>
                </li>
                <li>
                    <a href="{{ route('ibu_menyusui') }}"
                        class="{!! preg_match('#^dashboard/ibu_menyusui.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-heart />
                        Informasi Ibu Menyusui
                    </a>
                </li>
                <li>
                    <a href="{{ route('keluarga_berencana') }}"
                        class="{!! preg_match('#^dashboard/keluarga_berencana.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-target />
                        Informasi Keluarga Berencana
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas_ibu_hamil') }}"
                        class="{!! preg_match('#^dashboard/kelas.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-book />
                        Kelas Ibu Hamil
                    </a>
                </li>
                <span class="label text-xs font-extrabold opacity-50">CATATAN ANAK</span>
                <li>
                    <a href="{{ route('identitas_anak') }}"
                        class="{!! preg_match('#^dashboard/identitas_anak.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-user />
                        Identitas Anak
                    </a>
                </li>
                <li>
                    <a href="{{ route('perkembangan_anak') }}"
                        class="{!! preg_match('#^dashboard/perkembangan_anak.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-trending-up />
                        Perkembangan Anak
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelayanan_neonatus') }}"
                        class="{!! preg_match('#^dashboard/pelayanan_neonatus.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-baby />
                        Pelayanan Kesehatan Neonatus
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('sdidtk') }}"
                        class="{!! preg_match('#^dashboard/sdidtk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-check-square />
                        Pelayanan SDIDTK
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('kurva_pertumbuhan') }}"
                        class="{!! preg_match('#^dashboard/kurva_pertumbuhan.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-trending-up />
                        Kurva Pertumbuhan
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('imunisasi') }}"
                        class="{!! preg_match('#^dashboard/imunisasi.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-shield />
                        Imunisasi
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('vit_a') }}"
                        class="{!! preg_match('#^dashboard/vit_a.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-pill-bottle />
                        PMBA, Vitamin A, Obat Cacing
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('ringkasan_pelayanan_mtbs') }}"
                        class="{!! preg_match('#^dashboard/ringkasan_pelayanan_mtbs.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-file-text />
                        Ringkasan Pelayanan MTBS
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('rujukan_anak') }}"
                        class="{!! preg_match('#^dashboard/rujukan_anak.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-link />
                        Rujukan Anak
                    </a>
                </li> --}}
                <span class="label text-xs font-extrabold opacity-50">INFORMASI ANAK</span>
                <li>
                    <a href="{{ route('bayi_baru_lahir') }}"
                        class="{!! preg_match('#^dashboard/bayi_baru_lahir.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-baby />
                        Bayi Baru Lahir
                    </a>
                </li>
                <li>
                    <a href="{{ route('kondisi_balita') }}"
                        class="{!! preg_match('#^dashboard/kondisi_balita.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-thermometer />
                        Kondisi Balita
                    </a>
                </li>
                <li>
                    <a href="{{ route('bayi_anak_balita_6_24_bulan') }}"
                        class="{!! preg_match('#^dashboard/bayi_anak_balita_6_24_bulan.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Bayi, Anak Balita 6 - 24 bulan
                    </a>
                </li>
                <li>
                    <a href="{{ route('anak_balita_2_3_tahun') }}"
                        class="{!! preg_match('#^dashboard/anak_balita_2_3_tahun.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Anak Balita 2 - 3 tahun
                    </a>
                </li>
                <li>
                    <a href="{{ route('anak_balita_3_4_tahun') }}"
                        class="{!! preg_match('#^dashboard/anak_balita_3_4_tahun.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Anak Balita 3 - 4 tahun
                    </a>
                </li>
                <li>
                    <a href="{{ route('anak_balita_4_5_tahun') }}"
                        class="{!! preg_match('#^dashboard/anak_balita_4_5_tahun.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Anak Balita 4 - 5 tahun
                    </a>
                </li>
                <li>
                    <a href="{{ route('anak_5_6_tahun') }}"
                        class="{!! preg_match('#^dashboard/anak_5_6_tahun.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-calendar />
                        Anak 5 - 6 Tahun
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('kelas_ibu_balita') }}"
                        class="{!! preg_match('#^dashboard/kelas_ibu_balita.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                        <x-lucide-book />
                        Kelas Ibu Balita
                    </a>
                </li> --}}
        </div>
        @endif
        <div class="flex flex-col">
            <span class="label text-xs font-extrabold opacity-50">ADVANCE</span>
            <li>
                <a href="{{ route('profile') }}"
                    class="{!! Request::path() == 'dashboard/profile' ? 'active' : '' !!} flex items-center px-2.5 font-semibold">
                    <x-lucide-user-2 />
                    Profile
                </a>
            </li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="px-0">
                    @csrf
                    <a class="flex items-center px-2.5 gap-2 font-semibold" href="#"
                        onclick="event.preventDefault(); confirmLogout();">
                        <x-lucide-log-out />
                        Logout
                    </a>
                </form>
            </li>
        </div>
    </ul>
</div>
