import './configs/env-config';
import { Telegraf, session } from 'telegraf';
import { getChatId, getWelcome } from './helpers';
import { IContext, ISessionCreate } from './interfaces';
import SessionService from './services/SessionService';

const { BOT_TOKEN } = process.env;

if (!BOT_TOKEN) {
  throw new TypeError('BOT_TOKEN must be provided!');
}

const bot = new Telegraf<IContext>(BOT_TOKEN);

bot.use(session());

bot.on('text', async ctx => {
  try {
    if (!ctx.session) {
      ctx.session = getChatId(ctx);
      await ctx.reply(getWelcome(ctx));
    }

    const payload: ISessionCreate = {
      name: ctx.update?.message?.from?.first_name,
      platform_type: 'Telegram',
      contact_identifier: ctx.update?.message?.from?.id,
      message: ctx.update?.message?.text,
    };

    await SessionService.create(payload);

    await ctx.reply('Mensagem recebida!');
  } catch (e) {
    await ctx.reply('Mensagem não foi recebida!');
  }
});

bot.launch();

process.once('SIGINT', () => bot.stop('SIGINT'));
process.once('SIGTERM', () => bot.stop('SIGTERM'));
