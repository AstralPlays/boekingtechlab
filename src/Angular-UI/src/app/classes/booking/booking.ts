import { Material } from '../material/material';

export class Booking {
  // public created_at?: string;
  // public updated_at?: string;
  public classroom!: number; // will become a enum in the future
  public materials!: Array<Material>;
  public user!: string;
  public start_time!: string;
  public end_time!: string;
  public date!: string;

  constructor(data: any) {
    this.classroom = data.classroom;
    this.materials = data.materials;
    this.user = data.user;
    this.start_time = data.start_time;
    this.end_time = data.end_time;
    this.date = data.date;
  }
}
