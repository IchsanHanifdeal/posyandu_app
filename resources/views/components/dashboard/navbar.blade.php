<div class="w-full navbar sticky top-0 bg-pink-100 border-b z-10">
    <div class="flex-none md:hidden">
        <label for="aside-dashboard" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <x-lucide-align-left class="size-6" />
        </label>
    </div>
    <div class="flex-1 px-2 mx-2"></div>
    <div class="flex-none hidden lg:block">
        <ul class="menu menu-horizontal">
            @if (Auth::user()->foto_profil === null)
                <img class="w-8 rounded-full border border-gray-400"
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}"
                    alt="{{ Auth::user()->nama }}">
            @else
                <img class="w-8 rounded-full border border-gray-400"
                    src="{{ asset('storage/foto_profil/' . Auth::user()->foto_profil) }}"
                    alt="{{ Auth::user()->nama }}">
            @endif
        </ul>
    </div>
</div>
