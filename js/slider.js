// initialize Swiper
const swiper = new Swiper(".mySwiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  spaceBetween: 120,
  loop: true,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 0,
    modifier: 1,
    slideShadows: false,
  },
  autoplay: {
    delay: 3000, // Slower autoplay with a 7-second delay
  },
  speed: 3000, // Slower transition speed for smoother changes between slides
});
