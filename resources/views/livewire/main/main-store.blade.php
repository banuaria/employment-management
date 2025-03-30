<div>
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <x-title-section title="Our Store" mainTitle="Where to buy"/>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($stores as $store)
                @if($store->status)
                    <div>
                        <a href="{{ $store->url }}" target="_blank">
                            <img class="h-auto max-w-full rounded-lg" src="{{ $store->path }}" alt="{{ $store->title }}">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>