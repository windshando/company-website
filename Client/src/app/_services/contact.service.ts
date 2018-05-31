import {Injectable} from "@angular/core";
import { Contact } from '../_models/contact.model';

@Injectable()
export class ContactService {

    contactUs(contact: Contact) {
      console.log("ContactUs log:\nName: "+ contact.name + 
      	"\nPhone: " + contact.phone + 
      	"\nType: " + contact.type + 
      	"\nAbout: " + contact.about);
    }

}