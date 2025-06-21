# Usar imagen oficial de PHP con menos peso (si es posible)
FROM php:8.1-cli

# Instalar dependencias en una sola capa y limpiar después
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    procps \
    tesseract-ocr \
    tesseract-ocr-eng \
    tesseract-ocr-spa \
    poppler-utils \
    ghostscript \
    imagemagick \
    libmagickwand-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Modificar la política de seguridad de ImageMagick para permitir PDF
RUN sed -i '/<policy domain="coder" rights="none" pattern="PDF" \/>/d' /etc/ImageMagick-6/policy.xml \
    && sed -i 's/rights="none"/rights="read|write"/g' /etc/ImageMagick-6/policy.xml \
    && echo '<policy domain="coder" rights="read|write" pattern="PDF" />' >> /etc/ImageMagick-6/policy.xml

# Instalar Composer de forma segura (con verificación)
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    --version=2.8.9 \
    --sha-256=8e8829ec2b97fcb05158236984bc252bef902e7b8ff65555a1eeda4ec13fb82b

# Añadir composer al PATH global
ENV PATH /usr/local/bin:$PATH

# Establecer directorio de trabajo
WORKDIR /code

# Copiar solo archivos necesarios para instalar dependencias primero
COPY composer.json composer.lock ./

# Instalar dependencias de Composer (sin dev)
# RUN composer install --no-dev --no-scripts --no-autoloader --optimize-autoloader

# Copiar el resto del código DESPUÉS de instalar dependencias
COPY . .

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Exponer puertos
EXPOSE 8001
EXPOSE 8002

CMD ["/start.sh"]