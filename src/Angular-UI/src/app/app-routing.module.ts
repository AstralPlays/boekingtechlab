import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AdminDashboardComponent } from './components/admin/admin-dashboard/admin-dashboard.component';
import { AdminComponent } from './components/admin/admin.component';
import { HeaderComponent } from './components/header/header.component';
import { LoginPageComponent } from './components/login-page/login-page.component';
import { RegisterPageComponent } from './components/register-page/register-page.component';
import { ReservationPageComponent } from './components/reservation-page/reservation-page.component';
import { SliderComponent } from './components/slider/slider.component';
import { AuthGuard } from './guards/auth.guard';

const routes: Routes = [
	{ path: 'reservation', title: "Boeking tech lab | reservation", component: ReservationPageComponent },
	{ path: 'login', title: "Boeking Tech Lab | Login", component: LoginPageComponent },
	{ path: 'register', title: "Boeking Tech Lab | Register", component: RegisterPageComponent },
	{ path: 'unauthorized', title: "Boeking Tech Lab | unauthorized", component: SliderComponent },
	{
		path: 'user', title: "Boeking Tech Lab | User", canActivate: [AuthGuard],
		children: [
			{ path: '',redirectTo:'dash', pathMatch: 'full' },
			{ path: 'dash', title: "Boeking Tech Lab | Register", component: HeaderComponent }
		],
	},
	{
		path: 'admin', title: "Boeking Tech Lab | Admin", component: AdminComponent, canActivate: [AuthGuard],
		children: [
			{ path: '',redirectTo:'dashboard', pathMatch: 'full' },
			{ path: 'dashboard', title: "Boeking Tech Lab | Admin Dashboard", component: AdminDashboardComponent }
		],
	}
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule { }
