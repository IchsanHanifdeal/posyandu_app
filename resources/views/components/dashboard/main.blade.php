<x-main title="{{ $title }}" class="!p-0" full>
    <div class="drawer md:drawer-open bg-[#f7e8f3]">
        <input id="aside-dashboard" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @if (!Request::is('/'))
                @include('components.dashboard.navbar')
            @endif
            @if (!Request::is('/'))
                <div class="p-4 md:p-5 bg-[#fff9fe] w-full">
            @endif
            <div class="flex flex-col gap-5 md:gap-6 w-full min-h-screen">
                {{ $slot }}
            </div>
        </div>
        @if (!Request::is('/'))
            @include('components.footer')
        @endif
    </div>
    @if (!Request::is('/'))
        @include('components.dashboard.aside')
    @endif
    </div>
</x-main>
