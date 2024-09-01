<x-dashboard.main title="Data Pengguna">
    <div class="grid sm:grid-cols-2 xl:grid-cols-2 gap-5 md:gap-6">
        @foreach (['pengguna_terbaru', 'jumlah_pengguna'] as $type)
            <div class="flex items-center px-4 py-3 bg-neutral border rounded-xl shadow-sm">
                <span
                    class="
                    {{ $type == 'pengguna_terbaru' ? 'bg-pink-300' : '' }}
                    {{ $type == 'jumlah_pengguna' ? 'bg-pink-300' : '' }}
                    p-3 mr-4 rounded-full">
                </span>
                <div>
                    <p class="text-sm font-medium capitalize text-white">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p id="{{ $type }}" class="text-lg font-semibold text-white capitalize">
                        {{ $type == 'pengguna_terbaru' ? $pengguna_terbaru ?? 'Tidak ada pengguna terbaru' : '' }}
                        {{ $type == 'jumlah_pengguna' ? $jumlah_pengguna ?? '0' : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col lg:flex-row gap-5">
        @if (Auth::user()->role === 'super_admin')
            @foreach (['tambah_pengguna'] as $item)
                <div onclick="{{ $item . '_modal' }}.showModal()"
                    class="bg-neutral flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 cursor-pointer border-back rounded-xl w-full">
                    <div>
                        <h1
                            class="text-white font-semibold flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                        <p class="text-sm opacity-60 text-white">
                            {{ $item == 'tambah_pengguna' ? 'Fitur Tambah pengguna memungkinkan pengguna untuk menambahkan pengguna baru.' : '' }}
                        </p>
                    </div>
                    <x-lucide-plus
                        class="{{ $item == 'tambah_pengguna' ? '' : 'hidden' }} size-5 sm:size-7 font-semibold text-white" />
                </div>
            @endforeach
        @endif
    </div>
    <div class="flex gap-5">
        @foreach (['Daftar_pengguna'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        Jelajahi dan ketahui pengguna terbaru.
                    </p>
                </div>
                <div class="flex flex-col rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    @foreach (['No', 'Foto Profil', 'Nama', 'No Handphone', 'Role', 'created at', 'updated at'] as $header)
                                        <th class="uppercase font-bold text-center">{{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="capitalize">
                                @forelse ($pengguna as $i => $item)
                                    <tr>
                                        <th class="font-bold">{{ $i + 1 }}</th>
                                        <td class="font-semibold capitalize text-center">
                                            <label for="lihat_modal_{{ $item->id_user }}"
                                                class="w-full btn btn-neutral flex items-center justify-center gap-2 text-white font-bold">
                                                <span>Lihat</span>
                                            </label>

                                            <input type="checkbox" id="lihat_modal_{{ $item->id_user }}"
                                                class="modal-toggle" />
                                            <div class="modal" role="dialog">
                                                <div class="modal-box">
                                                    <h3 class="text-lg font-bold">Foto Profil {{ $item->nama }}</h3>
                                                    <div
                                                        class="flex flex-col w-full gap-3 !h-full mt-3 rounded-lg overflow-hidden">
                                                        @php
                                                            $imagePath = $item->foto_profil
                                                                ? asset('storage/foto_profil/' . $item->foto_profil)
                                                                : 'https://ui-avatars.com/api/?name=' .
                                                                    urlencode($item->nama);
                                                        @endphp
                                                        <img id="foto_profil_preview_{{ $item->id_user }}"
                                                            src="{{ $imagePath }}" class="border size-full"
                                                            alt="Profile Picture">

                                                        <form action="{{ route('photo.update', $item->id_user) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="file" accept="image/*"
                                                                id="foto_profil_file_{{ $item->id_user }}"
                                                                class="hidden" name="foto_profil">
                                                            <label for="foto_profil_file_{{ $item->id_user }}"
                                                                class="w-full cursor-pointer btn btn-sm btn-accent">Ganti</label>
                                                            <button type="submit"
                                                                class="w-full cursor-pointer btn btn-sm btn-accent mt-3">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <label class="modal-backdrop"
                                                    for="lihat_modal_{{ $item->id_user }}"></label>
                                            </div>
                                        </td>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                const userId = "{{ $item->id_user }}";
                                                const fotoInput = document.getElementById('foto_profil_file_' + userId);
                                                const previewImage = document.getElementById('foto_profil_preview_' + userId);

                                                fotoInput.addEventListener('change', function() {
                                                    const file = this.files[0];
                                                    if (file) {
                                                        const blob = URL.createObjectURL(file);
                                                        previewImage.style.display = 'block';
                                                        previewImage.src = blob;
                                                    }
                                                });
                                            });
                                        </script>

                                        <td class="font-bold">{{ $item->nama }}</td>
                                        @php
                                            $phoneNumber = $item->no_hp;
                                            if (substr($phoneNumber, 0, 2) === '08') {
                                                $phoneNumber = '+628' . substr($phoneNumber, 2);
                                            }

                                            $waLink = 'https://wa.me/' . $phoneNumber;
                                        @endphp

                                        <td class="font-semibold text-blue-700">
                                            <a href="{{ $waLink }}" target="_blank">{{ $item->no_hp }}</a>
                                        </td>

                                        <td class="font-semibold capitalize">
                                            @if ($item->role === 'user')
                                                Ibu Hamil
                                            @else
                                                {{ str_replace('_', ' ', $item->role) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="text-center">{{ $item->updated_at }}</td>
                                        </td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-trash class="size-5 hover:stroke-red-500 cursor-pointer"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id_user }}').showModal();" />
                                            <dialog id="hapus_modal_{{ $item->id_user }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box bg-base-100">
                                                    <h3 class="text-lg font-bold capitalize">Hapus
                                                        {{ $item->nama }}
                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="text-red-800 font-semibold">Perhatian! Anda
                                                            sedang
                                                            mencoba untuk menghapus Pengguna
                                                            <strong
                                                                class="text-red-800 font-bold">{{ $item->nama }}</strong>.
                                                            <span class="text-black">Tindakan ini akan menghapus
                                                                semua data terkait. Apakah Anda yakin ingin
                                                                melanjutkan?</span>
                                                        </p>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button type="button"
                                                            onclick="document.getElementById('hapus_modal_{{ $item->id_user }}').close()"
                                                            class="btn">Batal</button>
                                                        <form action="{{ route('delete.pengguna', $item->id_user) }}"
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
                                @endforelse
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.main>

<dialog id="tambah_pengguna_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-neutral text-white">
        <h3 class="text-lg font-bold text-center mb-3">Tambah Pengguna</h3>
        <form action="{{ route('store.pengguna') }}" method="POST">
            @csrf
            <div class="grid sm:grid-cols-1 xl:grid-cols-1 gap-5 md:gap-6">
                @foreach ([['label' => 'Nama', 'type' => 'text'], ['label' => 'No Handphone', 'type' => 'number']] as $field)
                    <div>
                        <label for="{{ strtolower(str_replace(' ', '_', $field['label'])) }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">
                            {{ $field['label'] }}
                        </label>
                        <input type="{{ $field['type'] }}"
                            name="{{ strtolower(str_replace(' ', '_', $field['label'])) }}"
                            id="{{ strtolower(str_replace(' ', '_', $field['label'])) }}"
                            class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Masukan {{ strtolower($field['label']) }}"
                            value="{{ old(strtolower(str_replace(' ', '_', $field['label']))) }}" required>
                        @error(strtolower(str_replace(' ', '_', $field['label'])))
                            <span
                                class="validated text-zinc-300 font-semibold bg-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
                <div>
                    <label for="Role"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">
                        Role
                    </label>
                    <select name="role" id="role"
                        class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        <option value="">--- Pilih Role Pengguna ---</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="modal-action">
                    <button type="button" onclick="document.getElementById('tambah_pengguna_modal').close()"
                        class="btn">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                </div>
            </div>
        </form>
    </div>
</dialog>
