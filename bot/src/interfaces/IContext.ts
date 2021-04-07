import { Context } from 'telegraf';
import { ISessionData } from '.';

export interface IContext extends Context {
  session?: ISessionData;
}
