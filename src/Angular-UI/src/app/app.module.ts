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

@NgModule({
	declarations: [
		AppComponent,
		HeaderComponent,
		BackgroundComponent,
		SocialMediaBarComponent,
		LoginPageComponent
	],
	imports: [
		BrowserModule,
		FontAwesomeModule,
		HttpClientModule,
		ReactiveFormsModule,
		AppRoutingModule
	],
	providers: [],
	bootstrap: [AppComponent]
})

export class AppModule { }
