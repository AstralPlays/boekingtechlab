import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DatePipe } from '@angular/common';
import { HeaderComponent } from './components/header/header.component';
import { BackgroundComponent } from './components/background/background.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SocialMediaBarComponent } from './components/social-media-bar/social-media-bar.component';
import { LoginPageComponent } from './components/login-page/login-page.component';
import { RegisterPageComponent } from './components/register-page/register-page.component';
import { SliderComponent } from './components/slider/slider.component';
import { ReservationPageComponent } from './components/reservation-page/reservation-page.component';
import { AdminComponent } from './components/admin/admin.component';
import { AdminSidebarComponent } from './components/admin/admin-sidebar/admin-sidebar.component';
import { AdminDashboardComponent } from './components/admin/admin-dashboard/admin-dashboard.component';


@NgModule({
	declarations: [
		AppComponent,
		HeaderComponent,
		BackgroundComponent,
		SocialMediaBarComponent,
		LoginPageComponent,
		RegisterPageComponent,
		SliderComponent,
		ReservationPageComponent,
		AdminComponent,
		AdminSidebarComponent,
		AdminDashboardComponent,
	],
	imports: [
		BrowserModule,
		FontAwesomeModule,
		HttpClientModule,
		ReactiveFormsModule,
		AppRoutingModule
	],
	providers: [
		DatePipe
	],
	bootstrap: [
		AppComponent
	]
})

export class AppModule { }