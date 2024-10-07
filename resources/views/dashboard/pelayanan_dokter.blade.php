<x-dashboard.main title="Pelayanan Dokter">
    @foreach (['Daftar_pelayanan_dokter'] as $item)
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
                                @foreach (['No', 'Nama Pelayanan', 'Aksi'] as $header)
                                    <th class="uppercase font-bold text-center">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $informasiIbuHamil = [
                                    [
                                        'id' => 1,
                                        'judul' => 'Evaluasi Kesehatan Ibu Hamil',
                                        'route' => 'evaluasi_kesehatan',
                                    ],
                                    // [
                                    //     'id' => 2,
                                    //     'judul' => 'Pemeriksaan Dokter Trimester 1 (Usia kehamilan < 12 minggu)',
                                    //     'route' => 'trimester_1',
                                    // ],
                                    // [
                                    //     'id' => 3,
                                    //     'judul' => 'Skrining Preeklampsia pada usia kehamilan < 20 minggu',
                                    //     'route' => 'skrining_preeklampsia',
                                    // ],
                                    // [
                                    //     'id' => 4,
                                    //     'judul' => 'Pemeriksaan Dokter Trimester 3 (Usia kehamilan 32 -36 minggu)',
                                    //     'route' => 'trimester_3',
                                    // ],
                                ];
                            @endphp

                            @foreach ($informasiIbuHamil as $info)
                                <tr onclick="window.location.href='{{ route($info['route']) }}'"
                                    class="cursor-pointer hover:bg-gray-100">
                                    <td class="text-center">{{ $info['id'] }}</td>
                                    <td class="text-center font-semibold">{{ $info['judul'] }}</td>
                                    <td class="text-center">
                                        <button
                                            class="w-full btn btn-neutral flex items-center justify-center gap-2 text-white font-bold">
                                            Lihat Detail
                                        </button>
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

@foreach (['Evaluasi Kesehatan Ibu Hamil', 'Skrining Preeklampsia', 'Pemeriksaan Dokter Trimester 1', 'Pemeriksaan Dokter Trimester 3'] as $i => $item)
    <dialog id="add_data_{{ str_replace(' ', '_', $item) }}" class="modal modal-bottom sm:modal-middle">
        <form onsubmit="saveData(this)" action="javascript:void();"S class="modal-box">
            <h3 class="text-lg font-bold">Lengkapi Dokumen</h3>
            <div class="flex flex-col py-4" id="input_render_{{ str_replace('_', ' ', $item) }}"></div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <button onclick="printDocs()" class="btn btn-accent">
                    Cetak
                </button>
                <button class="btn" type="button"
                    onclick="document.getElementById(`add_data_{{ str_replace(' ', '_', $item) }}`).close();">
                    Tutup
                </button>
            </div>
        </form>
    </dialog>
@endforeach

<script>
    let init_file = '';
    let init_payload = {}

    let files = [
        '/docx/bkiabi-evaluasi-kesehatan-ibu.docx',
        '/docx/bkiabi-skrining-preeklampsia.docx',
        '/docx/bkiabi-pemeriksaan-dokter-trimester-1.docx',
        '/docx/bkiabi-pemeriksaan-dokter-trimester-3.docx',
    ]

    async function printDocs() {
        const doc = await downloadDocs({
            file: init_file,
            payload: init_payload
        })
    }

    function saveData(data) {
        const payload = parseForm(data)
        init_payload = payload
    }

    async function initInput(item, i) {
        init_file = files[i];
        let data = await extractDocx({
            file: files[i]
        })

        let keys = await extractDocxKeys(data)
        let filter = keys.original().filter(x => !x.startsWith('%'));

        renderFormInputs(filter, "input_render_" + item);
    }
</script>
