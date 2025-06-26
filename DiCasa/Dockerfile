FROM php:8.2-fpm

# Instalar dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    sqlite3 \
    libsqlite3-dev \
    supervisor

RUN docker-php-ext-install pdo pdo_sqlite zip mbstring

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar diretórios necessários
RUN mkdir -p /var/www/html /run/php /var/log/supervisor

# Copiar arquivos do projeto
COPY . /var/www/html

# Copiar nginx conf
COPY ./conf/nginx/nginx-site.conf /etc/nginx/sites-available/default

# Copiar script de inicialização
COPY start.sh /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www/html

CMD ["/start.sh"]

