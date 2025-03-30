import './bootstrap';
import { initFlowbite } from 'flowbite';
import { splideCarousel } from './main/splide';

function initLibrary() {
    initFlowbite();
    splideCarousel();
}

// Listening DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    initLibrary();
});

// Listening livewire:navigated
document.addEventListener('livewire:navigated', () => {
    initLibrary();
});

document.addEventListener('livewire:init', () => {
    Livewire.on('flowbite-refresh', () => {
        const observer = new MutationObserver((mutationsList, observer) => {
            initFlowbite();
            observer.disconnect();
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });
});

// // GSAP
// import { gsap } from 'gsap';
// import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
// import { ScrollTrigger } from 'gsap/ScrollTrigger';
// gsap.registerPlugin(ScrollToPlugin);
// gsap.registerPlugin(ScrollTrigger) ;
// window.gsap = gsap;
// window.ScrollToPlugin = ScrollToPlugin;
// window.ScrollTrigger = ScrollTrigger;
