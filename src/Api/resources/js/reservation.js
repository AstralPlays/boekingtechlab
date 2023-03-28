import { Swiper, Navigation, Pagination } from 'swiper';
Swiper.use([Navigation, Pagination]);

var swiperParams = {
	slidesPerView: 'auto',
	spaceBetween: 10,
	// slidesOffsetBefore: 35,
	// slidesOffsetAfter: 35,
	// centeredSlides: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	pagination: {
		el: ".swiper-pagination",
		enabled: true,
		dynamicBullets: true,
		clickable: true,
		renderBullet: function (index, className) {
			return '<span class="' + className + '">' + (index + 1) + '</span>';
		},
	},
};

const swiper = new Swiper('.swiper', swiperParams);