export class Login {
  public email!: string;
  public password!: string;
  // public password_confirm?: string;

  constructor(data: any) {
    this.email = data.email;
    this.password = data.password;
    // this.password_confirm = data.password_confirm;
  }
}
