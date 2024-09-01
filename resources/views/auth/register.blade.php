<x-main title="Register">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold">
            Sistem Informasi Posyandu
        </a>
        <div class="w-full bg-[#ff8081] rounded-lg shadow md:mt-0 sm:w-3/4 xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center uppercase">
                    Registrasi
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('post.register') }}">
                    @csrf
                    <div class="grid sm:grid-cols-2 xl:grid-cols-2 gap-5 md:gap-6">
                        @foreach ([
                            ['label' => 'Nama', 'type' => 'text'],
                            ['label' => 'NIK', 'type' => 'text'],
                            ['label' => 'Pembiayaan', 'type' => 'text'],
                            ['label' => 'Golongan Darah', 'type' => 'text'],
                            ['label' => 'Tempat Lahir', 'type' => 'text'],
                            ['label' => 'Tanggal Lahir', 'type' => 'date'],
                            ['label' => 'Pendidikan', 'type' => 'text'],
                            ['label' => 'Pekerjaan', 'type' => 'text'],
                            ['label' => 'Alamat Rumah', 'type' => 'text'],
                            ['label' => 'No Handphone', 'type' => 'number'],
                            ] as $field)
                            <div>
                                <label for="{{ strtolower(str_replace(' ', '_', $field['label'])) }}_ibu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">
                                    {{ $field['label'] }} Ibu
                                </label>
                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ strtolower(str_replace(' ', '_', $field['label'])) }}_ibu"
                                    id="{{ strtolower(str_replace(' ', '_', $field['label'])) }}_ibu"
                                    class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukan {{ strtolower($field['label']) }} ibu..."
                                    value="{{ old(strtolower(str_replace(' ', '_', $field['label'])) . '_ibu') }}"
                                    required
                                >
                                @error(strtolower(str_replace(' ', '_', $field['label'])) . '_ibu')
                                    <span class="validated text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="{{ strtolower(str_replace(' ', '_', $field['label'])) }}_suami" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">
                                    {{ $field['label'] }} Suami/Pendamping
                                </label>
                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ strtolower(str_replace(' ', '_', $field['label'])) }}_suami"
                                    id="{{ strtolower(str_replace(' ', '_', $field['label'])) }}_suami"
                                    class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukan {{ strtolower($field['label']) }} suami/pendamping..."
                                    value="{{ old(strtolower(str_replace(' ', '_', $field['label'])) . '_suami') }}"
                                    required
                                >
                                @error(strtolower(str_replace(' ', '_', $field['label'])) . '_suami')
                                    <span class="validated text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>  
                    <div>
                        <label for="puskesmas_domisili" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Puskesmas Domisili</label>
                        <input type="text" inputmode="numeric" name="puskesmas_domisili" id="puskesmas_domisili"
                            class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Masukan puskesmas domisili..." required="">
                        @error('puskesmas_domisili')
                            <span class="validated text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="no_register_kohort_ibu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Register Kohort Ibu</label>
                        <input type="text" inputmode="numeric" name="no_register_kohort_ibu" id="no_register_kohort_ibu"
                            class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Masukan No Register Kohort Ibu..." required="">
                        @error('no_register_kohort_ibu')
                            <span class="validated text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full text-dark font-bold bg-neutral-300 hover:bg-neutral-500 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg text-sm px-5 py-2.5 text-center">Daftar</button>
                    <p class="text-sm font-light text-white text-center">
                        Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Masuk Sekarang</a>
                    </p>            
                </form>
            </div>
        </div>
    </div>
</x-main>