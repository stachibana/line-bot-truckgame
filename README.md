# LINE BOT Truck Game

![Image](https://raw.github.com/wiki/stachibana/line-bot-truckgame/images/ss.png)

A casual game for LINE Bot.
Add friend via [https://line.me/R/ti/p/%40jod8279c](https://line.me/R/ti/p/%40jod8279c).

![QR Link](https://raw.github.com/wiki/stachibana/line-bot-truckgame/images/qr.png)

## Procedure

### LINE BOT
Create channel and get channel secret and channel access token. For more details see [https://developers.line.me/ja/docs/messaging-api/building-bot/](https://developers.line.me/ja/docs/messaging-api/building-bot/).

### Heroku
Create new App and set secret and token at Settings > Config Variables. Keys are 'CHANNEL_SECRET' & 'CHANNEL_ACCESS_TOKEN'.

### Heroku postgres
Search 'Heroku postgres' in Resources > Add-ons and provision it.

```shell
$ heroku pg:psql -a appname
appname::DATABASE=> create extension pgcrypto;
appname::DATABASE=> create table users (userid bytea, cleararray text, pararray text, playing integer, step integer, treasures text, carpos text, cardirection text);
```
