# syntax=docker/dockerfile:1
# ============================================================
#  laravel-reports doc/demo – Production Image
# ============================================================
#  Build context is the parent directory that contains BOTH:
#
#     app/                <- this repository (reports-playground)
#     laravel-reports/    <- the package repository
#
#  The demo consumes the package through a Composer path repository
#  (../laravel-reports), so the package has to live next to the app
#  inside the build context. docker/build.sh assembles that context.
#
#  The image does NOT terminate TLS. It listens on :80 and is meant
#  to sit behind the existing Caddy reverse proxy (website3), which
#  owns the domain and the certificates.
# ============================================================

FROM dunglas/frankenphp:1-php8.5-alpine

# Version metadata, passed by the build (tag name or commit hash).
ARG APP_VERSION=dev
ENV APP_VERSION=${APP_VERSION}

# Plain HTTP inside the container. The edge proxy terminates TLS and
# sets X-Forwarded-*; the app trusts it via trustProxies().
#
# No FrankenPHP worker mode on purpose: the standard Laravel
# public/index.php does not call frankenphp_handle_request(), so
# "worker" makes the Caddy module fail at startup. Classic mode is
# what a mounted, custom Caddyfile without a global frankenphp block
# uses anyway (that is also how website3 runs in production).
ENV SERVER_NAME=:80

# System dependencies.
#   chromium      renders the PDFs and the demo screenshots (musl build!)
#   ttf-dejavu    fonts for the reports (avoid empty text in PDFs)
#   nodejs/npm    only needed to build the Vite assets, removed afterwards
#
# Do not install Playwright's Chromium here: those binaries are glibc
# builds and do not run on Alpine.
RUN apk add --no-cache bash nodejs npm chromium ttf-dejavu

# Make the Chromium binary path stable regardless of the Alpine package.
RUN if [ -x /usr/bin/chromium ]; then \
        ln -sf /usr/bin/chromium /usr/local/bin/chromium; \
    elif [ -x /usr/bin/chromium-browser ]; then \
        ln -sf /usr/bin/chromium-browser /usr/local/bin/chromium; \
    else \
        echo "No chromium binary found in the image." >&2; \
        exit 1; \
    fi
ENV LARAVEL_PDF_CHROME_BINARY=/usr/local/bin/chromium

# PHP extensions required by the app (SQLite demo DB, intl formatting,
# Composer/zip, sockets for chrome-php). gd is required by
# phpoffice/phpspreadsheet (Excel export); without it the composer
# install fails its platform check before the app code is copied.
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions intl zip opcache pcntl sockets pdo_sqlite sqlite3 gd \
    && rm -rf /var/cache/apk/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP CLI memory for the asset generation and the migrations.
RUN echo "memory_limit = 512M" > /usr/local/etc/php/conf.d/zz-memory.ini

WORKDIR /app

# 1. Dependency manifests first (better layer caching).
COPY app/composer.json app/composer.lock app/package.json app/package-lock.json ./

# 2. The package for the Composer path repository (../laravel-reports).
COPY laravel-reports /laravel-reports

# 3. PHP production dependencies + JS build dependencies.
RUN composer install --no-dev --no-interaction --prefer-dist --no-autoloader --no-scripts \
    && npm ci --include=dev

# 4. Application code.
COPY app/ /app

# 4b. Runtime directories are excluded from the build context (they contain
#     local state), so recreate the structure Laravel expects.
RUN mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    storage/app/demo-pdfs

# 5. Optimised autoloader and built frontend assets.
RUN composer dump-autoload --optimize --no-dev \
    && npm run build \
    && rm -rf node_modules npm-cache

# 6. Self-contained demo database. The migrations insert the demo rows,
#    so no seeder (and therefore no dev dependency such as Faker) is needed.
RUN mkdir -p database \
    && touch database/database.sqlite \
    && php artisan migrate --force --no-interaction

# 7. Writable directories for the runtime: sessions/cache/views,
#    generated PDFs and generated landing page screenshots.
RUN mkdir -p public/images/examples \
    && chown -R www-data:www-data storage bootstrap/cache public/images \
    && chown www-data:www-data database/database.sqlite

# The base image's healthcheck probes the Caddy admin API, which is
# meaningless here. compose.yml defines a real /up check.
HEALTHCHECK NONE

EXPOSE 80

# Default CMD of the FrankenPHP image:
#   frankenphp run --config /etc/caddy/Caddyfile
