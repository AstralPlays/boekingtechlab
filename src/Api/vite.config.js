import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/scss/about-us.scss',
				'resources/scss/admin-dashboard.scss',
				'resources/scss/admin-reservations.scss',
				'resources/scss/app.scss',
				'resources/scss/background.scss',
				'resources/scss/header.scss',
				'resources/scss/home-page.scss',
				'resources/scss/login.scss',
				'resources/scss/register.scss',
				'resources/scss/reservation.scss',
				'resources/scss/side-bar.scss',
				'resources/scss/user-dashboard.scss',
				'resources/scss/user-reservations.scss',
				'resources/scss/user-settings.scss',
				'resources/js/app.js',
				'resources/js/swiper.js',
			],
			refresh: true,
		}),
	],
});
