// Step 1: Get DOM elements
let carouselDom = document.querySelector('.carousel');
let sliderDom = carouselDom.querySelector('.carousel .list');
let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let timeDom = document.querySelector('.carousel .time');
let techSpecsButton = document.getElementById('tech-specs-button');
let techSpecsContainer = document.getElementById('tech-specs-container');

thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
let timeAutoNext = 7000;

let runNextAuto = setTimeout(() => {
    showSlider('next');
}, timeAutoNext);

function showSlider(type) {
    let sliderItemsDom = sliderDom.querySelectorAll('.carousel .list .item');
    let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');

    if (type === 'next') {
        sliderDom.appendChild(sliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
    }

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        showSlider('next');
    }, timeAutoNext);
}

// Add event listeners to the thumbnail images for manual control
thumbnailItemsDom.forEach(thumbnailItem => {
    thumbnailItem.addEventListener('click', function() {
        // Find the index of the clicked thumbnail item
        let index = Array.from(thumbnailItemsDom).indexOf(this);
        // Calculate how many times 'next' action should be called to reach this index
        let steps = thumbnailItemsDom.length - index;
        // Execute 'next' action 'steps' times
        for (let i = 0; i < steps; i++) {
            showSlider('next');
        }
    });
});

