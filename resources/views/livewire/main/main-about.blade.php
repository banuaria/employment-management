<div>
    @if ($configData->cover_about)
    <img class="w-full h-auto bg-cover bg-center" src="{{ $configData->cover_about }}" alt="image description">
    @endif
    
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <x-title-section title="About Us" mainTitle="Our Story"/>
        <div>
            <div class="tinymce-content">{!! $about->content !!}</div>
        </div>
    </div>
</div>
