import axios, { AxiosResponse } from 'axios';

const http = axios.create({
  baseURL: process.env.API_BASE_URL,
});

export { http, axios, AxiosResponse };
