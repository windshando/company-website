import {HttpClient, HttpClientModule} from "@angular/common/http";
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';
import {TranslateModule, TranslateLoader} from '@ngx-translate/core';
import {TranslateHttpLoader} from "@ngx-translate/http-loader";

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './_components/app.component';
import { HomeComponent } from './_components/home/home.component';
import { WorksComponent } from './_components/works/works.component';
import { WorkComponent } from './_components/works/work/work.component';
import { TeamComponent } from './_components/team/team.component';
import { ContactComponent } from './_components/contact/contact.component';
import { FooterComponent } from './_components/footer/footer.component';
import { HeaderComponent } from './_components/header/header.component';

import { LocalSettingsService } from './_services/local-settings.service';
import { ContactService } from './_services/contact.service';


// AoT requires an exported function for factories
export function HttpLoaderFactory(httpClient: HttpClient) {
    return new TranslateHttpLoader(httpClient, "assets/i18n/", ".json");
}

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    WorksComponent,
    WorkComponent,
    TeamComponent,
    ContactComponent,
    FooterComponent,
    HeaderComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule,
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory,
        deps: [HttpClient]
      }
    })
  ],
  providers: [
    LocalSettingsService,
    ContactService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
