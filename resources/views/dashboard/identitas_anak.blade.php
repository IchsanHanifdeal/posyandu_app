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
                                        @foreach (['No', 'No Surat', 'Nama Anak', 'Nama Ibu', 'Hari', 'Tanggal', 'Pukul', 'Jenis Kelamin', 'Jenis Kelahiran', 'Kelahiran Ke', 'Berat Badan', 'Panjang Badan', 'Tempat Kelahiran'] as $header)
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
    @elseif(Auth::user()->role === 'user')
    @endif
</x-dashboard.main>
