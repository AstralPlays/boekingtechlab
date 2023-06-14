import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/scss/app.scss',
				'resources/scss/about-us.scss',
				'resources/scss/admin-dashboard.scss',
				'resources/scss/admin-reservations.scss',
				'resources/scss/background.scss',
				'resources/scss/header.scss',
				'resources/scss/home-page.scss',
				'resources/scss/login.scss',
				'resources/scss/register.scss',
				'resources/scss/reservation.scss',
				'resources/scss/side-bar.scss',
				'resources/js/app.js',
				'resources/js/reservation.js',
			],
			refresh: true,
		}),
	],
});
