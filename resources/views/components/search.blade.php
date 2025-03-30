<div class="relative">
    <button type="button" id="search-icon" class="p-2">
        <x-icon-search class="h-5 w-5 text-gray-700 hover:text-gray-500" />
    </button>
    <form id="search-form" 
        class="search-form fixed inset-0 px-7 bg-white h-screen z-50 shadow-lg hidden opacity-0 transition-opacity duration-300"
        wire:submit.prevent="search">
        <div class="flex justify-center items-center w-full h-full">
            <button type="submit" class="p-2">
                <x-icon-search class="h-5 w-5" />
            </button>
            <input 
                type="text" 
                name="keywords" 
                placeholder="TYPE YOUR SEARCH" 
                wire:model="keywords"
                class="px-4 py-2 rounded-md border border-gray-300 w-full"
            >
            <button type="button" id="search-close" class="p-2">
                <x-icon-close class="h-5 w-5 text-gray-700 hover:text-gray-500" />
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchIcon = document.getElementById('search-icon');
        const searchForm = document.getElementById('search-form');
        const searchClose = document.getElementById('search-close');

        function fadeIn(element) {
            element.classList.remove('hidden');
            setTimeout(() => {
                element.classList.remove('opacity-0');
                element.classList.add('opacity-100');
            }, 10);
        }

        function fadeOut(element) {
            element.classList.add('opacity-0');
            setTimeout(() => {
                element.classList.add('hidden');
            }, 300); // Match this duration with your transition duration
        }

        searchIcon.addEventListener('click', function() {
            fadeIn(searchForm);
        });

        searchClose.addEventListener('click', function() {
            fadeOut(searchForm);
        });
    });
</script>
