import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { BackgroundComponent } from './components/background/background.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SocialMediaBarComponent } from './components/social-media-bar/social-media-bar.component';

@NgModule({
	declarations: [
		AppComponent,
		HeaderComponent,
		BackgroundComponent,
		SocialMediaBarComponent
	],
	imports: [
		BrowserModule,
		AppRoutingModule,
		FontAwesomeModule
	],
	providers: [],
	bootstrap: [AppComponent]
})

export class AppModule { }
