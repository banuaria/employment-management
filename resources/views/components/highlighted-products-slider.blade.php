@props(['data', 'label', 'title'])
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<style>
    .swiper-button-next,
    .swiper-button-prev {
        color: white; /* Set the text color to white */
        background-color: rgba(255, 255, 255, 0.3); /* Set the background color to white with 0.3 opacity */
        border-radius: 50%; /* Make the background a circle */
        width: 40px; /* Set width for navigation button */
        height: 40px; /* Set height for navigation button */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: rgba(255, 255, 255, 0.5); /* Change background on hover */
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px; /* Adjust size of navigation arrows */
    }

    .swiper-pagination-bullet {
        bottom:0px;
        background-color: black; /* Set the background color of pagination bullets to white */
    }

    .swiper-pagination-bullet-active {
        background-color: rgba(255, 255, 255, 0.8); /* Active bullet background color */
    }

    /* Ensure swiper-container is styled properly */
    .swiper-container {
        position: relative; /* For positioning navigation buttons */
    }
</style>

<div class="w-full m-auto max-w-screen-xl px-5">
    <x-title-section title="{{ $label }}" mainTitle="{{ $title }}" />
    <div class="w-full">
        <div class="swiper-container relative overflow-hidden w-full">
            <div class="swiper-wrapper">
                @foreach ($data as $item)
                    <div class="swiper-slide">
                        <x-product-card 
                            thumbnail="{{ $item->thumbnail }}"
                            category="{{ $item->productCategory->title }}"
                            title="{{ $item->title }}"
                            ctaLink="{{ route('product.detail', ['slug_category' => $item->productCategory->slug, 'slug_subcategory' => $item->productSubcategory->slug, 'slug' => $item->slug]) }}"
                            ctaText="View Detail"
                            :ctaTargetBlank="false"
                        />
                    </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <!-- <div class="swiper-pagination"></div> -->
            <!-- Add Navigation -->
            <div class="swiper-button-next "></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 2,
            spaceBetween: 4,
            loop: true, // Enables continuous loop mode
            autoplay: {
                delay: 3000, // Delay between slides in milliseconds (3 seconds)
                disableOnInteraction: false, // Keep autoplay running after user interaction
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
    });
</script>

