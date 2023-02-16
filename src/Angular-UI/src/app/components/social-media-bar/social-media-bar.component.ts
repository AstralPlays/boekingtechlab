import { Component, OnInit } from '@angular/core';
import { faFacebook, faInstagram, faLinkedin, faYoutube } from '@fortawesome/free-brands-svg-icons';

@Component({
	selector: 'app-social-media-bar',
	templateUrl: './social-media-bar.component.html',
	styleUrls: ['./social-media-bar.component.scss']
})

export class SocialMediaBarComponent implements OnInit {
	socialMedia = [
		{ icon: faFacebook, link: 'https://www.facebook.com/techlab' },
		{ icon: faInstagram, link: 'https://www.facebook.com/techlab' },
		{ icon: faLinkedin, link: 'https://www.facebook.com/techlab' },
		{ icon: faYoutube, link: 'https://www.facebook.com/techlab' }];
	email = 'techlab@example.nl';

	ngOnInit(): void {

	}
}