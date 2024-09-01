<x-dashboard.main title="Posyandu">
    <div class="grid sm:grid-cols-2 xl:grid-cols-2 gap-5 md:gap-6">
        @foreach (['posyandu_terbaru', 'jumlah_posyandu'] as $type)
            <div class="flex items-center px-4 py-3 bg-neutral border rounded-xl shadow-sm">
                <span
                    class="
                    {{ $type == 'posyandu_terbaru' ? 'bg-pink-300' : '' }}
                    {{ $type == 'jumlah_posyandu' ? 'bg-pink-300' : '' }}
                    p-3 mr-4 rounded-full">
                </span>
                <div>
                    <p class="text-sm font-medium capitalize text-white">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p id="{{ $type }}" class="text-lg font-semibold text-white capitalize">
                        {{ $type == 'posyandu_terbaru' ? $posyandu_terbaru ?? 'Tidak ada posyandu terbaru' : '' }}
                        {{ $type == 'jumlah_posyandu' ? $jumlah_posyandu ?? '0' : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex flex-col lg:flex-row gap-5">
        @if (Auth::user()->role === 'super_admin')
            @foreach (['tambah_posyandu'] as $item)
                <div onclick="{{ $item . '_modal' }}.showModal()"
                    class="bg-neutral flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 cursor-pointer border-back rounded-xl w-full">
                    <div>
                        <h1
                            class="text-white font-semibold flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                        <p class="text-sm opacity-60 text-white">
                            {{ $item == 'tambah_posyandu' ? 'Fitur Tambah posyandu memungkinkan pengguna untuk menambahkan posyandu baru.' : '' }}
                        </p>
                    </div>
                    <x-lucide-plus
                        class="{{ $item == 'tambah_posyandu' ? '' : 'hidden' }} size-5 sm:size-7 font-semibold text-white" />
                </div>
            @endforeach
        @endif
    </div>

    <div class="flex gap-5">
        @foreach (['Daftar_posyandu'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        Jelajahi dan ketahui posyandu terbaru.
                    </p>
                </div>
                <div class="flex flex-col rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    @foreach (['No', 'Nama Posyandu', 'Alamat', 'Fasilitas', 'Pengurus'] as $header)
                                        <th class="uppercase font-bold text-center">{{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="capitalize">
                                @forelse ($posyandu as $i => $item)
                                    <tr>
                                        <th class="text-center">{{ $i + 1 }}</th>
                                        <td class="font-bold">{{ $item->nama_posyandu }}</td>
                                        <td class="text-center">{{ $item->alamat }}</td>
                                        <td class="text-center">{{ $item->fasilitas }}</td>
                                        <td>
                                            @if ($item->users->isNotEmpty())
                                                @foreach ($item->users as $user)
                                                    {{ $user->nama }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @else
                                                Tidak ada pengurus
                                            @endif
                                        </td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-pencil class="size-5 hover:stroke-yellow-500 cursor-pointer"
                                                onclick="document.getElementById('update_posyandu_{{ $item->id_posyandu }}').showModal();" />
                                            <dialog id="update_posyandu_{{ $item->id_posyandu }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-neutral text-white">
                                                    <h3 class="text-lg font-bold">Edit Posyandu</h3>
                                                    <form action="{{ route('update.posyandu', $item->id_posyandu) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-4">
                                                            <label for="nama_posyandu"
                                                                class="block text-sm font-medium">Nama Posyandu</label>
                                                            <input type="text" name="nama_posyandu"
                                                                id="nama_posyandu" value="{{ $item->nama_posyandu }}"
                                                                class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="alamat"
                                                                class="block text-sm font-medium">Alamat</label>
                                                            <input type="text" name="alamat" id="alamat"
                                                                value="{{ $item->alamat }}"
                                                                class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="fasilitas"
                                                                class="block text-sm font-medium">Fasilitas</label>
                                                            <input type="text" name="fasilitas" id="fasilitas"
                                                                value="{{ $item->fasilitas }}"
                                                                class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="pengurus"
                                                                class="block text-sm font-medium">Pengurus</label>
                                                            <select name="pengurus[]" id="pengurus" multiple class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_user }}"
                                                                        {{ $item->users->contains($user->id_user) ? 'selected' : '' }}>
                                                                        {{ $user->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-action">
                                                            <button type="button"
                                                                onclick="document.getElementById('update_posyandu_{{ $item->id_posyandu }}').close()"
                                                                class="btn">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </dialog>

                                            <x-lucide-trash class="size-5 hover:stroke-red-500 cursor-pointer"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id_posyandu }}').showModal();" />
                                            <dialog id="hapus_modal_{{ $item->id_posyandu }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-base-100">
                                                    <h3 class="text-lg font-bold capitalize">Hapus
                                                        {{ $item->nama_posyandu }}
                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="text-red-800 font-semibold">Perhatian! Anda
                                                            sedang
                                                            mencoba untuk menghapus posyandu
                                                            <strong
                                                                class="text-red-800 font-bold">{{ $item->nama_posyandu }}</strong>.
                                                            <span class="text-black">Tindakan ini akan menghapus
                                                                semua data terkait. Apakah Anda yakin ingin
                                                                melanjutkan?</span>
                                                        </p>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button type="button"
                                                            onclick="document.getElementById('hapus_modal_{{ $item->id_posyandu }}').close()"
                                                            class="btn">Batal</button>
                                                        <form
                                                            action="{{ route('delete.posyandu', $item->id_posyandu) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </dialog>
                                        </td>

                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Tidak ada data posyandu</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-dashboard.main>

    <dialog id="tambah_posyandu_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box bg-neutral text-white">
            <h3 class="text-lg font-bold">Tambah Posyandu</h3>
            <form action="{{ route('store.posyandu') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_posyandu" class="block text-sm font-medium">Nama Posyandu</label>
                    <input type="text" name="nama_posyandu" id="nama_posyandu"
                        class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium">Alamat</label>
                    <input type="text" name="alamat" id="alamat"
                        class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="mb-4">
                    <label for="fasilitas" class="block text-sm font-medium">Fasilitas</label>
                    <input type="text" name="fasilitas" id="fasilitas"
                        class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="mb-4">
                    <label for="pengurus" class="block text-sm font-medium">Pengurus</label>
                    <select name="pengurus[]" id="pengurus" multiple
                        class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @foreach ($users as $user)
                            <option value="{{ $user->id_user }}">
                                {{ $user->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-action">
                    <button type="button"
                        onclick="document.getElementById('tambah_posyandu_modal').close()"
                        class="btn">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Posyandu</button>
                </div>
            </form>
        </div>
    </dialog>
    