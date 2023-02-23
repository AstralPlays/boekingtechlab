export class Auth {
    public auth!: string;
    public role?: string;

    constructor(data: any) {
        this.auth = data.auth
        this.role = data.role
    }
}