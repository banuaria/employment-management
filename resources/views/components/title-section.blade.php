@props([
    'title' => 'Title',    
    'mainTitle' => 'Main Title' 
])
<div class="flex flex-col mb-4">
    <h2 class="text-md md:text-lg font-bold text-red-500 uppercase">{{ $title }}</h2>
    <h1 class="text-2xl md:text-4xl font-extrabold mb-4 uppercase">{{ $mainTitle }}</h1>
</div>
