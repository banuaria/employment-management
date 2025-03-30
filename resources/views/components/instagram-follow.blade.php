@props(['username' => '@username', 'bgColor' => 'bg-gray-100'])

<section class="{{ $bgColor }} py-8">
    <div class="max-w-screen-lg mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900">FOLLOW US ON INSTAGRAM</h2>
        <p class="mt-2 text-red-500 text-lg">{{ $username }}</p>
    </div>
</section>
