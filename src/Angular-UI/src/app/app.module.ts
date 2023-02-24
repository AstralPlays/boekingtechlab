import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { BackgroundComponent } from './components/background/background.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SocialMediaBarComponent } from './components/social-media-bar/social-media-bar.component';
import { LoginPageComponent } from './components/login-page/login-page.component';
import { RegisterPageComponent } from './components/register-page/register-page.component';
import { Test401Component } from './components/test401/test401.component';
import { ReservationPageComponent } from './components/reservation-page/reservation-page.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';

@NgModule({
	declarations: [
		AppComponent,
		HeaderComponent,
		BackgroundComponent,
		SocialMediaBarComponent,
		LoginPageComponent,
		RegisterPageComponent,
		Test401Component,
		ReservationPageComponent,
		DashboardComponent
	],
	imports: [
		BrowserModule,
		FontAwesomeModule,
		HttpClientModule,
		ReactiveFormsModule,
		AppRoutingModule
	],
	bootstrap: [
		AppComponent
	]
})

export class AppModule { }