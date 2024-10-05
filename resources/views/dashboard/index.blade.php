<x-dashboard.main title="Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Average Daily Views -->
        @foreach (['nama_anak', 'tinggi_badan', 'berat_badan'] as $item)
        <div class="bg-gradient-to-br from-pink-100 to-pink-300 p-6 rounded-xl shadow-xl flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-pink-600 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-eye w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M1 12S5 5 12 5s11 7 11 7-4 7-11 7S1 12 1 12Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </div>
            <div class="ml-4">
                <div class="text-pink-800 text-4xl font-bold">234</div>
                <p class="text-pink-600 text-sm">Avg Daily Views</p>
            </div>
        </div>
        @endforeach

    </div>

    <!-- User Trends Chart -->
    <div class="bg-white p-6 mt-8 rounded-xl shadow-xl">
        <div class="flex justify-between items-center">
            <h3 class="text-pink-600 font-bold text-lg">User Trends</h3>
            <button class="btn btn-sm btn-outline text-pink-600 flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-refresh-cw w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <polyline points="23 4 23 10 17 10"/>
                    <polyline points="1 20 1 14 7 14"/>
                    <path d="M3.51 9a9 9 0 1 1 2.13 9.36L1 14"/>
                </svg>
                <span>Refresh</span>
            </button>
        </div>
        
        <!-- Example Chart Placeholder -->
        <div class="mt-4 h-64 flex items-center justify-center bg-pink-50 rounded-lg">
            <svg class="w-full h-full" viewBox="0 0 200 100">
                <!-- Example of a more complex polyline -->
                <polyline fill="none" stroke="#D926A9" stroke-width="4" 
                    points="10,80 40,60 70,90 100,40 130,70 160,30 190,50" />
            </svg>
        </div>
    </div>
</x-dashboard.main>
