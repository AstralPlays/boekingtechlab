import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { BackgroundComponent } from './components/background/background.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SocialMediaBarComponent } from './components/social-media-bar/social-media-bar.component';
import { LoginPageComponent } from './components/login-page/login-page.component';
import { ReservationPageComponent } from './components/reservation-page/reservation-page.component';

@NgModule({
	declarations: [
		AppComponent,
		HeaderComponent,
		BackgroundComponent,
		SocialMediaBarComponent,
		LoginPageComponent,
		ReservationPageComponent
	],
	imports: [
		BrowserModule,
		ReactiveFormsModule,
		AppRoutingModule,
		FontAwesomeModule
	],
	bootstrap: [
		AppComponent
	]
})

export class AppModule { }
