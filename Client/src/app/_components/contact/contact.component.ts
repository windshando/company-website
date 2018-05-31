import { Component, OnInit } from '@angular/core';
import { ContactService } from '../../_services/contact.service';
import { Contact } from '../../_models/contact.model';

@Component({
  selector: 'glove-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.scss']
})
export class ContactComponent implements OnInit {

  contact: Contact;

  constructor(
  	private contactService: ContactService
  ) {
  	this.contact = new Contact();
  }

  ngOnInit() {
  }

  onContactUs(){
  	this.contactService.contactUs(this.contact);
  }

}
