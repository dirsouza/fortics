import { http, AxiosResponse } from '../suports';
import { ISessionCreate, IResponseCreate } from '../interfaces';

export default class SessionService {
  static async create(
    payload: ISessionCreate
  ): Promise<AxiosResponse<IResponseCreate>> {
    return http.post('/sessions/create', payload);
  }
}
