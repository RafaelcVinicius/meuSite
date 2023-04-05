# Building app
FROM node:alpine as build

WORKDIR /app

COPY package*.json ./

RUN npm install -g @quasar/cli
RUN npm install

COPY . .

RUN quasar build

# Starting NGINX
FROM nginx

COPY ./.docker-compose/nginx.conf /etc/nginx/nginx.conf

COPY --from=build /app/dist/spa /usr/share/nginx/html

EXPOSE 80

# inicie o nginx
CMD ["nginx", "-g", "daemon off;"]
