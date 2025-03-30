<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <ul class="bg-gray-100 p-10 space-y text-sm font-medium text-gray-500">
            <li>
                <a href="#" wire:click.prevent="setActiveTab('HowToBuy')" 
                   class="block py-2 px-4 rounded {{ $activeTab === 'HowToBuy' ? 'text-black font-bold' : 'hover:text-gray-900 dark:hover:text-white' }}">
                    1. HOW TO BUY
                </a>
            </li>
            <li>
                <a href="#" wire:click.prevent="setActiveTab('Payments')" 
                   class="block py-2 px-4 rounded {{ $activeTab === 'Payments' ? 'text-black font-bold' : 'hover:text-gray-900 dark:hover:text-white' }}">
                    2. PAYMENTS
                </a>
            </li>
            <li>
                <a href="#" wire:click.prevent="setActiveTab('AboutUs')" 
                   class="block py-2 px-4 rounded {{ $activeTab === 'AboutUs' ? 'text-black font-bold' : 'hover:text-gray-900 dark:hover:text-white' }}">
                    3. ABOUT US
                </a>
            </li>
        </ul>
    </div>
    <div class="bg-white">
    @if($activeTab === 'HowToBuy')
        <h2 class="text-xl font-bold mb-4">HOW TO BUY</h2>
        <div class="space-y-2">
                <x-accordion id="accordion-collapse" :items="$accordionItems" wire:key="accordion-{{ $activeTab }}" />
        </div>
    @elseif($activeTab === 'Payments')
        <h2 class="text-xl font-bold mb-4">PAYMENTS</h2>
        <div class="space-y-2">
                <x-accordion id="accordion-collapse" :items="$accordionItems" wire:key="accordion-{{ $activeTab }}" />
        </div>
    @elseif($activeTab === 'AboutUs')
        <h2 class="text-xl font-bold mb-4">ABOUT US</h2>
        <div class="space-y-2">
                <x-accordion id="accordion-collapse" :items="$accordionItems" wire:key="accordion-{{ $activeTab }}" />
        </div>
    @endif
    </div>
</div>
