const carouselContainer = document.querySelector('.carousel-container');
const slides = document.querySelectorAll('.carousel-slide');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
let currentIndex = 0;
let slideInterval;

const updateSlidePosition = () => {
    carouselContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
};

const showNextSlide = () => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlidePosition();
};

const showPrevSlide = () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlidePosition();
};

const startSlideShow = () => {
    slideInterval = setInterval(showNextSlide, 5000);
};

const stopSlideShow = () => {
    clearInterval(slideInterval);
};

nextBtn.addEventListener('click', () => {
    stopSlideShow();
    showNextSlide();
    startSlideShow();
});

prevBtn.addEventListener('click', () => {
    stopSlideShow();
    showPrevSlide();
    startSlideShow();
});

document.addEventListener('DOMContentLoaded', startSlideShow);
