import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginPageComponent } from './components/login-page/login-page.component';
import { RegisterPageComponent } from './components/register-page/register-page.component';

const routes: Routes = [
	{ path: 'user',
		children: [
			{path: "", redirectTo: "register", pathMatch: 'prefix'},
			{path: 'login', title: "Boeking Tech Lab | Login", component: LoginPageComponent},
			{path: 'register', title: "Boeking Tech Lab | Register", component: RegisterPageComponent},
		]
	},
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule { }
