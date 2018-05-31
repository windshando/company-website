import { Component } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';

import {LocalSettingsService} from '../_services/local-settings.service';

@Component({
  selector: 'glove-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss']
})
export class AppComponent {
	
	constructor(
    private translate: TranslateService, 
    private localSettings: LocalSettingsService
  ) {
    	translate.addLangs(['en', 'uk', 'ru']);
    	translate.setDefaultLang('en');
      if(localSettings.getLanguage() == ""){
        switch (navigator.language) {
          case 'uk':
            translate.use('uk');
            break;
          case 'ru':
            translate.use('ru');
            break;
          default:
            translate.use('en');
            break;
        }
      } else {
        translate.use(localSettings.getLanguage());
      }
  	}
}
