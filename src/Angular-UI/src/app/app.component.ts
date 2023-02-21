import { Component, OnInit } from '@angular/core';
import { Subject, takeUntil } from 'rxjs';
import { ApiService } from './services/api.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent implements OnInit {
  title = 'Angular-UI';
  unsubscribe$ = new Subject<void>();

  constructor(private Api: ApiService) {}

  ngOnInit(): void {
    // this.Api.getTestData()
    //   .pipe(takeUntil(this.unsubscribe$))
    //   .subscribe((data: any) => {
    //     console.log(data);
    //   });
  }
}
