import { getFirstName } from '.';

export const getWelcome = ctx => {
  const name = getFirstName(ctx);
  return `Seja bem vindo, ${name}!`;
};
