export class Contact {

  constructor(
    public name: string = "",
    public phone: string = "",
    public about: string = "",
    public type: string = "",
    public file: any = null
  ) {}

  toString(): string {
    return JSON.stringify(this)
  }
}