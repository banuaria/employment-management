<meta name="description" content="{{ $configData->meta_desc }}">
<meta name="keyword" content="{{ $meta_keywords ?? $configData->meta_keywords }}">
<meta property="og:site_name" content="{{ config('app.url') }}"/>
<meta property="og:title" content="{{ $meta_title ?? $configData->meta_title }}"/>
<meta property="og:description" content="{{ $meta_desc ?? $configData->meta_desc }}"/>
<meta property="og:image" content="{{ asset($configData->primary_logo) }}">
<meta property="og:image:alt" content="{{ $configData->company_name }}">
<meta property="og:image:type" content="image/{{ File::extension($configData->primary_logo) }}">
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:type" content="website"/>
