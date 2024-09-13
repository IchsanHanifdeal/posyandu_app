<x-dashboard.main title="Amanat Persalinan Ibu">
    @if (Auth::user()->role === 'admin')
        <div class="flex gap-5">
            @foreach (['daftar_amanat_persalinan_ibu_hamil'] as $item)
                <div class="flex flex-col border-back rounded-xl w-full">
                    <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                        <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                        <p class="text-sm opacity-60">
                            Jelajahi dan ketahui amanat persalinan pada ibu hamil.
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
                                <tbody>
                                    @forelse ($ibu as $i => $item)
                                        <tr>
                                            <td class="text-center font-semibold">{{ $i + 1 }}</td>
                                            <td class="text-center font-semibold">{{ $item->nik }}</td>
                                            <td class="text-center font-bold">{{ $item->user->nama }}</td>
                                            @php
                                                $phoneNumber = $item->user->no_hp;
                                                if (substr($phoneNumber, 0, 2) === '08') {
                                                    $phoneNumber = '+628' . substr($phoneNumber, 2);
                                                }

                                                $waLink = 'https://wa.me/' . $phoneNumber;
                                            @endphp

                                            <td class="font-semibold text-blue-700 text-center">
                                                <a href="{{ $waLink }}"
                                                    target="_blank">{{ $item->user->no_hp }}</a>
                                            </td>
                                            <td class="text-center">{{ $item->no_register_kohort }}</td>
                                            <td class="flex items-center gap-4">
                                                <!-- Icon Book User that triggers the modal -->
                                                <x-lucide-book-user class="size-5 hover:stroke-blue-500 cursor-pointer"
                                                    onclick="document.getElementById('detail_modal_{{ $item->id_user }}').showModal();" />
                                            
                                                <dialog id="detail_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
                                                    <div class="modal-box">
                                                        <h3 class="font-bold text-lg">Detail Amanat Persalinan</h3>
                                                        <p class="py-4">Apakah Anda ingin mencetak dokumen Amanat Persalinan?</p>
                                            
                                                        <div class="modal-action">
                                                            <a href="{{ route('print.amanat_persalinan') }}" target="_blank" class="btn btn-primary">
                                                                Cetak
                                                            </a>
                                                            <button class="btn" onclick="document.getElementById('detail_modal_{{ $item->id_user }}').close();">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </dialog>
                                            </td>
                                                                                   
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-gray-700 text-center capitalize" colspan="5">Tidak ada
                                                data
                                                amanat persalinain</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
    @endif
</x-dashboard.main>
