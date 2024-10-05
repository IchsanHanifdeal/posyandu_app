<x-dashboard.main title="Myposyandu">
    <div class="hero min-h-screen bg-gradient-to-br from-[#fff9fe] via-[#fce8fc] to-[#f5d4f5] relative overflow-hidden">
        <!-- Decorative Circles for Large Screens -->
        <div class="hidden lg:block absolute top-0 right-0 bg-pink-200 rounded-full w-64 h-64 opacity-30 transform translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="hidden lg:block absolute bottom-0 left-0 bg-purple-200 rounded-full w-48 h-48 opacity-40 transform -translate-x-1/2 translate-y-1/2"></div>
    
        <div class="hero-content flex flex-col lg:flex-row-reverse items-center justify-center h-full relative z-10 px-6 sm:px-8 md:px-10 lg:px-16">
            <img src="{{ asset('images/hero.png') }}"
                class="w-1/4 h-auto rounded-lg transform hover:scale-105 transition-transform duration-300 mb-8"
                alt="MyPosyandu Image" />
            <div class="text-center lg:text-left lg:mr-10">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 text-purple-800">MyPosyandu</h1>
                <p class="py-4 sm:py-6 text-base sm:text-lg leading-relaxed text-gray-700">
                    Selamat datang di <strong>MyPosyandu</strong>, platform digital yang memudahkan orang tua dan keluarga
                    untuk memantau kesehatan ibu dan anak. Kami menyediakan informasi lengkap tentang layanan posyandu,
                    jadwal imunisasi, dan tips kesehatan. Bergabunglah dengan kami untuk masa depan yang lebih sehat!
                </p>
                <button
                    class="btn btn-primary btn-lg shadow-lg hover:shadow-2xl hover:bg-purple-700 transform hover:-translate-y-1 transition-all duration-300"
                    onclick="window.location.href='{{ route('login') }}'">
                    Bergabung Sekarang
                </button>
            </div>
        </div>
    </div>
    
    <!-- About MyPosyandu Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-16 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2">
                <h2 class="text-4xl font-bold mb-4 text-gray-800">
                    Tentang <span class="text-green-600">MyPosyandu</span>
                </h2>
                <p class="text-lg leading-relaxed text-gray-600">
                    <strong>MyPosyandu</strong> adalah platform digital yang dikembangkan untuk mendukung peningkatan
                    kesehatan ibu dan anak di Indonesia. Sebagai bagian dari solusi kesehatan modern,
                    <strong>MyPosyandu</strong> mempermudah akses ke layanan posyandu, jadwal imunisasi, dan berbagai
                    tips kesehatan yang dapat diakses kapan saja, di mana saja.
                </p>
                <p class="text-lg leading-relaxed text-gray-600 mt-4">
                    Dengan fitur-fitur canggih seperti pengingat imunisasi, pemantauan perkembangan anak, dan akses
                    langsung ke informasi posyandu terdekat, <strong>MyPosyandu</strong> berkomitmen untuk meningkatkan
                    kualitas kesehatan ibu dan anak di Indonesia. Bergabunglah bersama kami untuk menciptakan generasi
                    yang lebih sehat dan cerdas.
                </p>
            </div>
            <div class="lg:w-1/2 mt-8 lg:mt-0 lg:pl-10">
                <img src="{{ asset('images/about.png') }}" class="w-full rounded-lg shadow-lg" alt="About MyPosyandu Image" />
            </div>
        </div>
    </div>
    <!-- Summary Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-4xl font-bold text-center mb-12 text-pink-800">
                Data Posyandu <span class="text-pink-600">Terkini</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <!-- Total Participants -->
                <div
                    class="bg-pink-100 shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold text-pink-800">Jumlah Peserta Posyandu</h3>
                    <p class="text-4xl font-bold text-pink-600">250</p>
                </div>

                <!-- Sasaran Balita -->
                <div
                    class="bg-pink-100 shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold text-pink-800">Sasaran Balita</h3>
                    <p class="text-4xl font-bold text-pink-600">150</p>
                </div>

                <!-- Sasaran Ibu Hamil -->
                <div
                    class="bg-pink-100 shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold text-pink-800">Sasaran Ibu Hamil</h3>
                    <p class="text-4xl font-bold text-pink-600">100</p>
                </div>

                <!-- Imunisasi Bayi -->
                <div
                    class="bg-pink-100 shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold text-pink-800">Jumlah Bayi Imunisasi</h3>
                    <p class="text-4xl font-bold text-pink-600">80</p>
                </div>

                <!-- Total Ibu Hamil Mendapat Pelayanan -->
                <div
                    class="bg-pink-100 shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold text-pink-800">Ibu Hamil Dapat Pelayanan</h3>
                    <p class="text-4xl font-bold text-pink-600">90</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-gradient-to-r from-pink-50 to-white">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-4xl font-bold text-center mb-12 text-pink-800">
                Fitur-fitur di <span class="text-pink-600">MyPosyandu</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Identitas Ibu Hamil -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-user-check class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Identitas Ibu Hamil</h3>
                        <p class="text-pink-600">Pantau dan simpan identitas serta kondisi ibu hamil.</p>
                    </div>
                </div>

                <!-- Pernyataan Pelayanan Ibu -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-file-text class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Pernyataan Pelayanan Ibu</h3>
                        <p class="text-pink-600">Catat dan kelola layanan kesehatan yang diberikan kepada ibu hamil.</p>
                    </div>
                </div>

                <!-- Amanat Persalinan -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-clipboard class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Amanat Persalinan Ibu</h3>
                        <p class="text-pink-600">Dokumentasikan amanat dan rencana persalinan bagi ibu hamil.</p>
                    </div>
                </div>

                <!-- Pelayanan Dokter -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-stethoscope class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Pelayanan Dokter</h3>
                        <p class="text-pink-600">Kelola pelayanan kesehatan ibu dari tenaga medis profesional.</p>
                    </div>
                </div>

                <!-- Pelayanan Kehamilan -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-heart class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Pelayanan Kehamilan</h3>
                        <p class="text-pink-600">Pantau kondisi dan layanan kehamilan ibu secara berkala.</p>
                    </div>
                </div>

                <!-- Pelayanan Nifas -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-bed class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Pelayanan Nifas</h3>
                        <p class="text-pink-600">Pantau layanan kesehatan ibu selama masa nifas.</p>
                    </div>
                </div>

                <!-- Informasi Ibu Hamil -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-info class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Informasi Ibu Hamil</h3>
                        <p class="text-pink-600">Akses berbagai informasi penting seputar kehamilan ibu.</p>
                    </div>
                </div>

                <!-- Informasi Ibu Bersalin -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-calendar class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Informasi Ibu Bersalin</h3>
                        <p class="text-pink-600">Dapatkan informasi lengkap mengenai proses persalinan.</p>
                    </div>
                </div>

                <!-- Kelas Ibu Hamil -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-book class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Kelas Ibu Hamil</h3>
                        <p class="text-pink-600">Ikuti kelas-kelas edukasi untuk mendukung kehamilan sehat.</p>
                    </div>
                </div>

                <!-- Imunisasi Anak -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-shield class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Imunisasi Anak</h3>
                        <p class="text-pink-600">Pastikan anak mendapatkan imunisasi sesuai jadwal yang dianjurkan.</p>
                    </div>
                </div>

                <!-- Ringkasan Pelayanan MTBS -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-file-text class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Ringkasan Pelayanan MTBS</h3>
                        <p class="text-pink-600">Ringkasan pelayanan MTBS (Manajemen Terpadu Balita Sakit).</p>
                    </div>
                </div>

                <!-- Rujukan Anak -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <x-lucide-link class="text-pink-500 w-12 h-12" />
                    <div>
                        <h3 class="text-xl font-semibold text-pink-800">Rujukan Anak</h3>
                        <p class="text-pink-600">Sistem rujukan anak ke fasilitas kesehatan yang lebih lengkap.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-4xl font-bold text-center mb-12 text-pink-800">
                Langkah Pencatatan di <span class="text-pink-600">MyPosyandu</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <!-- Step 1 -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-clipboard class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">1. Daftar Akun</h3>
                    <p class="text-pink-600">Buat akun baru dengan informasi yang valid untuk memulai.</p>
                </div>

                <!-- Step 2 -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-user-check class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">2. Isi Identitas</h3>
                    <p class="text-pink-600">Masukkan identitas ibu dan anak secara lengkap.</p>
                </div>

                <!-- Step 3 -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-file-text class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">3. Catat Pelayanan</h3>
                    <p class="text-pink-600">Dokumentasikan semua layanan kesehatan yang diterima.</p>
                </div>

                <!-- Step 4 -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-check-circle class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">4. Konfirmasi Data</h3>
                    <p class="text-pink-600">Periksa kembali data yang telah dimasukkan untuk akurasi.</p>
                </div>

                <!-- Step 5 -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-save class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">5. Simpan Data</h3>
                    <p class="text-pink-600">Simpan semua informasi yang telah dicatat.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-16 bg-gradient-to-br from-pink-50 to-white">
        <div class="container mx-auto px-6 lg:px-16 text-center">
            <h2 class="text-4xl font-bold mb-12 text-pink-800">
                Kenapa Memilih <span class="text-pink-600">MyPosyandu?</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Kemudahan Akses -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-smartphone class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">Kemudahan Akses</h3>
                    <p class="text-pink-600">Akses informasi kesehatan kapan saja, di mana saja.</p>
                </div>

                <!-- Pengingat Imunisasi -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-bell class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">Pengingat Imunisasi</h3>
                    <p class="text-pink-600">Jadwal imunisasi yang mudah dikelola dan diingat.</p>
                </div>

                <!-- Pantau Perkembangan -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-trending-up class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">Pantau Perkembangan</h3>
                    <p class="text-pink-600">Lacak pertumbuhan anak Anda dengan mudah.</p>
                </div>

                <!-- Komunitas dan Dukungan -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-users class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">Komunitas dan Dukungan</h3>
                    <p class="text-pink-600">Terhubung dengan orang tua lain untuk mendapatkan informasi dan dukungan.
                    </p>
                </div>

                <!-- Informasi Kesehatan -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-book-open class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">Informasi Kesehatan</h3>
                    <p class="text-pink-600">Akses berbagai informasi kesehatan yang terpercaya.</p>
                </div>

                <!-- Antarmuka User-Friendly -->
                <div
                    class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300 ease-in-out">
                    <div class="w-16 h-16 flex items-center justify-center bg-pink-200 rounded-full mb-4">
                        <x-lucide-layout-dashboard class="text-pink-600 w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-semibold text-pink-800">Antarmuka User-Friendly</h3>
                    <p class="text-pink-600">Mudah digunakan untuk semua usia dengan desain intuitif.</p>
                </div>
            </div>

            <div class="mt-12">
                <h2 class="text-3xl font-bold text-pink-800">Mari Bergabung Sekarang!</h2>
                <p class="mt-4 text-lg text-gray-700">Dengan MyPosyandu, Anda berkontribusi untuk menciptakan generasi
                    yang lebih sehat dan cerdas. Jangan ragu untuk memulai perjalanan kesehatan Anda hari ini!</p>
                <button class="btn btn-primary btn-lg shadow-lg mt-6"
                    onclick="window.location.href='{{ route('login') }}'">
                    Bergabung Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Contact Us Section -->
    <!-- Contact Us Section -->
    <div class="py-16 bg-pink-100">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-4xl font-bold text-center mb-8 text-pink-800">
                Kontak <span class="text-pink-600">Kami</span>
            </h2>
            <p class="text-lg leading-relaxed text-center text-gray-600 mb-8">
                Untuk pertanyaan lebih lanjut, silakan hubungi kami melalui email atau telepon, atau kirimkan pesan
                langsung melalui formulir di bawah ini.
            </p>

            <div class="flex flex-col lg:flex-row justify-center space-x-0 lg:space-x-8 mb-12">
                <!-- Contact Information -->
                <div class="bg-white shadow-lg rounded-lg p-8 text-center mb-6 lg:mb-0 w-full lg:w-1/3">
                    <h3 class="text-xl font-semibold text-pink-800 mb-4">Hubungi Kami</h3>
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-pink-500 w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h18M3 12h18m-6 9H3v-9h18v9z" />
                            </svg>
                            <p class="text-gray-600">support@myposyandu.com</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-pink-500 w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h18M3 12h18m-6 9H3v-9h18v9z" />
                            </svg>
                            <p class="text-gray-600">+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>

                <!-- Inquiry Form -->
                <div class="bg-white shadow-lg rounded-lg p-8 w-full lg:w-2/3">
                    <h3 class="text-xl font-semibold text-pink-800 mb-4">Kirim Pesan</h3>
                    <form>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="name">Nama:</label>
                            <input type="text" id="name"
                                class="input w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="email">Email:</label>
                            <input type="email" id="email"
                                class="input w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="message">Pesan:</label>
                            <textarea id="message" rows="4"
                                class="input w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required></textarea>
                        </div>
                        <button type="submit"
                            class="btn btn-primary w-full bg-pink-600 text-white rounded-lg py-2 hover:bg-pink-500 transition duration-300 shadow-lg">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-6 bg-pink-200 text-gray-800 text-center relative">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="flex flex-col md:flex-row justify-between items-center mb-2">
                <div class="mb-2 md:mb-0">
                    <h2 class="text-xl font-bold text-pink-600">MyPosyandu</h2>
                    <p class="text-xs text-gray-600">Menghubungkan Anda dengan kesehatan komunitas.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-pink-600 hover:text-pink-800 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 0118 0 9 9 0 11-18 0z" />
                        </svg>
                    </a>
                    <a href="#" class="text-pink-600 hover:text-pink-800 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 0118 0 9 9 0 11-18 0z" />
                        </svg>
                    </a>
                    <a href="#" class="text-pink-600 hover:text-pink-800 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 0118 0 9 9 0 11-18 0z" />
                        </svg>
                    </a>
                </div>
            </div>
    
            <p class="text-xs text-gray-600">© {{ date('Y') }} MyPosyandu. All rights reserved.</p>
        </div>
    
    </footer>
    

</x-dashboard.main>
