<x-dashboard.main title="Informasi Ibu Menyusui">
    @foreach (['Daftar_informasi_ibu_hamil'] as $item)
        <div class="flex flex-col border-back rounded-xl w-full">
            <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                    {{ str_replace('_', ' ', $item) }}
                </h1>
                <p class="text-sm opacity-60">
                    Jelajahi dan ketahui Informasi seputar ibu hamil.
                </p>
            </div>
            <div class="flex flex-col rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                @foreach (['No', 'Nama Materi', 'Materi'] as $header)
                                    <th class="uppercase font-bold text-center">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $informasiIbuHamil = [
                                    [
                                        'id' => 1,
                                        'judul' => 'Menyusui Bayi bermanfaat untuk pemulihan rahim, kesehatan payudara & ASI adalah gizi terbaik untuk bayi',
                                        'gambar' => 'ibu_menyusui.jpg',
                                        'deskripsi' => 'Menyusui Bayi bermanfaat untuk pemulihan rahim, kesehatan payudara & ASI adalah gizi terbaik untuk bayi',
                                    ],
                                    [
                                        'id' => 2,
                                        'judul' => 'Cara memerah dan menyimpan ASI',
                                        'gambar' => 'cara_memerah.jpg',
                                        'deskripsi' => 'Cara memerah dan menyimpan ASI',
                                    ],
                                    [
                                        'id' => 3,
                                        'judul' => 'makan dan minum ibu menyusui',
                                        'gambar' => 'makan.jpg',
                                        'deskripsi' => 'makan dan minum ibu menyusui',
                                    ],
                                    [
                                        'id' => 4,
                                        'judul' => 'cara cuci tangan',
                                        'gambar' => 'cuci_tangan.jpg',
                                        'deskripsi' => 'cara cuci tangan',
                                    ],
                                ];
                            @endphp

                            @foreach ($informasiIbuHamil as $info)
                                <tr>
                                    <td class="text-center">{{ $info['id'] }}</td>
                                    <td class="text-center font-semibold capitalize">{{ $info['judul'] }}</td>
                                    <td class="text-center capitalize">
                                        <label for="lihat_modal_{{ $info['id'] }}"
                                            class="w-full btn btn-neutral flex items-center justify-center gap-2 text-white font-bold">
                                            <span>Lihat</span>
                                        </label>

                                        <input type="checkbox" id="lihat_modal_{{ $info['id'] }}"
                                            class="modal-toggle" />
                                        <div class="modal" role="dialog">
                                            <div class="modal-box">
                                                <h3 class="text-lg font-bold capitalize">{{ $info['deskripsi'] }}</h3>
                                                <div
                                                    class="flex flex-col w-full gap-3 !h-full mt-3 rounded-lg overflow-hidden">
                                                    <img id="foto_informasi_preview_{{ $info['id'] }}"
                                                        src="{{ asset('images/informasi/ibu_menyusui/' . $info['gambar']) }}"
                                                        class="border size-full" alt="Materi Gambar">
                                                </div>
                                            </div>
                                            <label class="modal-backdrop" for="lihat_modal_{{ $info['id'] }}"></label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</x-dashboard.main>