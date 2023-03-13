import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { HeaderComponent } from './components/header/header.component';
import { LoginPageComponent } from './components/login-page/login-page.component';
import { RegisterPageComponent } from './components/register-page/register-page.component';
import { ReservationPageComponent } from './components/reservation-page/reservation-page.component';
import { SliderComponent } from './components/slider/slider.component';
import { UserComponent } from './components/user/user.component';
import { AuthGuard } from './guards/auth.guard';

const routes: Routes = [
	{ path: 'reservation', title: "Boeking tech lab | reservation", component: ReservationPageComponent },
	{ path: 'login', title: "Boeking Tech Lab | Login", component: LoginPageComponent },
	{ path: 'register', title: "Boeking Tech Lab | Register", component: RegisterPageComponent },
	{ path: 'unauthorized', title: "Boeking Tech Lab | unauthorized", component: SliderComponent },
	{
		path: 'user', title: "Boeking Tech Lab | User", canActivate: [AuthGuard],
		children: [
			{ path: '',redirectTo:'Dash', pathMatch: 'full' },
			{ path: 'Dash', title: "Boeking Tech Lab | Register", component: HeaderComponent }
		],
	},
	{
		path: 'admin', title: "Boeking Tech Lab | Admin", canActivate: [AuthGuard],
		children: [
			{ path: '',redirectTo:'Dash', pathMatch: 'full' },
			{ path: 'Dash', title: "Boeking Tech Lab | Register", component: DashboardComponent }
		],
	}
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule { }
