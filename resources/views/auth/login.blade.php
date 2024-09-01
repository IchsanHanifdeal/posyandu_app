<x-main title="Login">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold">
            Sistem Informasi Posyandu
        </a>
        <div class="w-full bg-[#ff8081] rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center uppercase">
                    Login
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <div>
                        <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                            Handphone</label>
                        <input type="text" inputmode="numeric" name="no_hp" id="no_hp"
                            class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Masukan No Handphone..." required="">
                        @error('No Handphone')
                            <span class="validated text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukan password..."
                            class="bg-[#974b34] border border-gray-300 text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required="">
                        @error('password')
                            <span class="validated text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full text-dark font-bold bg-neutral-300 hover:bg-neutral-500 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg text-sm px-5 py-2.5 text-center">Masuk</button>
                    <p class="text-sm font-light text-white text-center">
                        Tidak punya akun? <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-main>
