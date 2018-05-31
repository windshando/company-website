import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './_components/home/home.component';
import { WorksComponent } from './_components/works/works.component';
import { WorkComponent } from './_components/works/work/work.component';
import { TeamComponent } from './_components/team/team.component';
import { ContactComponent } from './_components/contact/contact.component';

const routes: Routes = [
   { path: '', component: HomeComponent },
   { path: 'home', component: HomeComponent },
   { path: 'works', component: WorksComponent },
   { path: 'works/:id', component: WorkComponent },
   { path: 'team', component: TeamComponent },
   { path: 'contact', component: ContactComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
