<x-dashboard.main title="Informasi Ibu Hamil">
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
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center font-semibold">Periksa Kehamilan</td>
                                <td class="text-center capitalize">
                                    <label for="lihat_modal_1"
                                        class="w-full btn btn-neutral flex items-center justify-center gap-2 text-white font-bold">
                                        <span>Lihat</span>
                                    </label>

                                    <input type="checkbox" id="lihat_modal_1" class="modal-toggle" />
                                    <div class="modal" role="dialog">
                                        <div class="modal-box">
                                            <h3 class="text-lg font-bold">Materi Periksa Kehamilan</h3>
                                            <div
                                                class="flex flex-col w-full gap-3 !h-full mt-3 rounded-lg overflow-hidden">
                                                <img id="foto_informasi_preview_1"
                                                    src="{{ asset('images/informasi/ibu_hamil/periksa_kehamilan.jpg') }}" class="border size-full"
                                                    alt="Profile Picture">
                                            </div>
                                        </div>
                                        <label class="modal-backdrop" for="lihat_modal_1"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</x-dashboard.main>
