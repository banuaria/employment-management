<div class="flex flex-col space-y-8">
    {{-- <x-carousel :covers="$covers" /> --}}

    {{-- <x-highlighted-products-slider
        label="OUR PRODUCT"
        title="BEST SELLER PRODUCTS" 
        :data=$products
    /> --}}

    {{-- @if ($feature)
        <x-jumbotron 
            class=""
            :isCenter="false"
            bgImage=""
            bgVideo=""
            bgColor="white"
            label=""
            :title="$feature->title"
            :desc="$feature->desc"
            textColor="black"
            ctaLink="#"
            ctaText="Learn More"
            :ctaTargetBlank="false"
            :contentRight="$feature->path"
            :isVideo="false"
            :reverse="true"
            :backdrop="false"
        />
    @endif

    <x-highlighted-articles
        label="HIGHLIGHTS"
        title="ARTICLE" 
        :type=1
        ctaLink="{{ route('post.index') }}"
        ctaText="See More"
        :ctaTargetBlank="false"
        :data="$posts" 
    />  --}}
</div>
