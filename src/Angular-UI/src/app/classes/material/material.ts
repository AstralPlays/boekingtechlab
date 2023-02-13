
export class Material {
  public material!: string;
  public available!: number;
  public classroom!: Array<number>;
  public loaned!: number; // the amount that the class will use in the specified time block

  constructor(data: any) {
    this.material = data.material;
    this.available = data.available;
    this.classroom = data.classroom;
    this.loaned = data.loaned;
  }
}
