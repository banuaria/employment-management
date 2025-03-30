@props([
    'tabs' => [], // List of tab names
    'contents' => [] // Corresponding list of tab contents
])

<div class="mb-4 border-b border-gray-200">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">
        @foreach($tabs as $index => $tab)
            <li class="mr-2" role="presentation">
                <button 
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $index === 0 ? 'text-black border-red-500' : 'text-gray-500 border-transparent hover:text-gray-600 hover:border-gray-300' }}" 
                    id="tab-{{ $index }}-tab" 
                    data-tabs-target="#tab-{{ $index }}" 
                    type="button" 
                    role="tab" 
                    aria-controls="tab-{{ $index }}" 
                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                    onclick="switchTab(event, 'tab-{{ $index }}')"
                >
                    {{ $tab }}
                </button>
            </li>
        @endforeach
    </ul>
</div>
<div id="default-tab-content">
    @foreach($contents as $index => $content)
        <div 
            class="{{ $index === 0 ? '' : 'hidden' }} p-4" 
            id="tab-{{ $index }}" 
            role="tabpanel" 
            aria-labelledby="tab-{{ $index }}-tab"
        >
            <p class="text-sm text-gray-500">{!! $content !!}</p>
        </div>
    @endforeach
</div>

<script>
    function switchTab(event, tabId) {
        let tabLinks = document.querySelectorAll('#default-tab [role="tab"]');
        let tabPanels = document.querySelectorAll('#default-tab-content [role="tabpanel"]');

        tabLinks.forEach(tab => {
            tab.classList.remove('text-black', 'border-red-500');
            tab.classList.add('text-gray-500', 'border-transparent');
        });

        tabPanels.forEach(panel => {
            panel.classList.add('hidden');
        });

        event.currentTarget.classList.add('text-black', 'border-red-500');
        document.getElementById(tabId).classList.remove('hidden');
    }
</script>
