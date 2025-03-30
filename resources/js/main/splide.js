import Splide from '@splidejs/splide';
import '@splidejs/splide/css';

let main;
let thumbnails;

function splideCarousel() {
    // Check if both elements exist before initializing Splide
    const mainElement = document.querySelector('#splide-carousel-main');
    const thumbnailsElement = document.querySelector('#splide-carousel-thumbnail');

    if (mainElement && thumbnailsElement) {
        // If Splide instances already exist, destroy them first
        if (main) {
            main.destroy(true); // true removes all Splide-related styles as well
        }
        if (thumbnails) {
            thumbnails.destroy(true);
        }

        // Initialize new Splide instances
        main = new Splide(mainElement, {
            type      : 'fade',
            rewind    : true,
            pagination: false,
            arrows    : false,
        });

        thumbnails = new Splide(thumbnailsElement, {
            fixedWidth  : 120,
            fixedHeight : 120,
            gap         : 10,
            rewind      : true,
            pagination  : false,
            isNavigation: true,
        });

        // Sync the carousels and mount them
        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    }
}

export { splideCarousel };
