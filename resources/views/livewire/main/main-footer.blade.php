<footer class="bg-black text-white py-8">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-5 py-2.5">
        <!-- Logo and Company Name -->
        <div class="flex items-center py-4 w-full md:w-auto">
            <a href="/" class="flex items-center">
                <x-application-logo logo="{{ $configData->primary_logo ? asset($configData->primary_logo) : '' }}" class="h-10 filter invert grayscale brightness-0" />
            </a>
        </div>
        <!-- Links Section -->
        {{-- <div class="grid grid-cols-2 gap-8 py-4 lg:py-8 lg:grid-cols-3 {{ count($link_chunks) > 3 ? 'xl:grid-cols-4' : '' }}">
            @foreach ($link_chunks as $key => $link_chunk)
            <div>
                <ul class="flex flex-col space-y-4 text-white font-medium">
                    @foreach ($link_chunk as $link)
                    <li>
                        <a wire:navigate href="{{ $link['route'] != '#' ? $link['route'] : '#'}}" class=" hover:text-primary-400">{{ $link['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div> --}}
        <!-- Social Media Links -->
        <div class="flex items-center space-x-4 py-4 w-full md:w-auto">
            @if($configData->instagram)
                <a href="{{ $configData->instagram }}" target="_blank" class="text-gray-400 hover:text-white transition">
                    <x-icon-instagram class="w-5 h-5" />
                </a>
            @endif
            @if($configData->facebook)
                <a href="{{ $configData->facebook }}" target="_blank" class="text-gray-400 hover:text-white transition">
                    <x-icon-facebook class="w-5 h-5" />
                </a>
            @endif
            @if($configData->x)
                <a href="{{ $configData->x }}" target="_blank" class="text-gray-400 hover:text-white transition">
                    <x-icon-x class="w-5 h-5" />
                </a>
            @endif
            @if($configData->linkedin)
                <a href="{{ $configData->linkedin }}" target="_blank" class="text-gray-400 hover:text-white transition">
                    <x-icon-linkedin class="w-5 h-5" />
                </a>
            @endif
            @if($configData->youtube)
                <a href="{{ $configData->youtube }}" target="_blank" class="text-gray-400 hover:text-white transition">
                    <x-icon-youtube class="w-5 h-5" />
                </a>
            @endif
        </div>
    </div>
    <div class="text-center mt-8">
        <span class="text-sm text-gray-400 sm:text-center">© {{ \Carbon\Carbon::now()->year }} <a href="/" >{{ config('app.name') }}</a>. All Rights Reserved.</span>
    </div>
</footer>
