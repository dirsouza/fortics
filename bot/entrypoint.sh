#!/bin/bash

dockerize -wait tcp://api:9000 -timeout 20s

npm install

ENV=./.env
if [ ! -f "$ENV"]; then
  cp ./.env.example ./.env;
fi

npm run build && npm run start
