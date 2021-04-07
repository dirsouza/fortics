import { ISession, IMessage } from '.';

type TSessionAndMessage = ISession & {
  message: IMessage;
};

type TSessionAndMessages = ISession & {
  messages: Array<IMessage>;
};

export interface IResponse {
  success: boolean;
  message: string;
}

export interface IResponseCreate extends IResponse {
  data: TSessionAndMessage;
}

export interface IResponseList extends IResponse {
  data: Array<TSessionAndMessages>;
}
