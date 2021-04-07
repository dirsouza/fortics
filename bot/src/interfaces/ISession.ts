type TPlatforms = 'Telegram';

export interface ISession {
  id?: number;
  name: string;
  platform_type: TPlatforms;
  contact_identifier: number;
}
