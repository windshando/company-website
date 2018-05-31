import { Component, OnInit } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';

import {LocalSettingsService} from '../../_services/local-settings.service';

@Component({
  selector: 'glove-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss']
})
export class FooterComponent implements OnInit {
  
  phone: string = "+38(097) 987-97-26";
  language: string;

  constructor(
  	private translate: TranslateService,
  	private localSettings: LocalSettingsService
  ) { 
    this.language = localSettings.getLanguage();
  }

  ngOnInit() {
  }

  changeLang(lang) {
  	this.translate.use(lang);
    this.localSettings.setLanguage(lang);
    this.language = lang;
  }

}
