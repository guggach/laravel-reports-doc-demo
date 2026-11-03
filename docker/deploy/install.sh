#!/usr/bin/env bash
# ============================================================
#  laravel-reports doc/demo – first-time installation
# ============================================================
#  Run once on the server:
#
#     cd /opt/laravel-reports && ./install.sh [website3-app-container]
#
#  The optional argument is the running app container of website3.
#  It gets attached to the shared "edge" network so its Caddy can
#  reach this stack as docs:80.
# ============================================================

set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")"

WEBSITE_CONTAINER="${1:-}"

print_next_steps() {
    cat <<'EOT'

==> next step: route the domain through the existing Caddy

Add this block to the Caddyfile of website3:

    laravel-reports.private-net.ch {
        encode zstd br gzip
        header -X-Powered-By
        reverse_proxy docs:80
    }

Then apply it without downtime (from the website3 compose directory):

    docker compose exec app caddy validate --config /etc/caddy/Caddyfile
    docker compose exec app caddy reload   --config /etc/caddy/Caddyfile

DNS: laravel-reports.private-net.ch must point to this server (A/AAAA).
EOT
}

echo "==> .env"
if [ ! -f .env ]; then
    cp .env.example .env
    key="base64:$(openssl rand -base64 32)"
    sed -i "s|^APP_KEY=.*|APP_KEY=${key}|" .env
    echo "    created .env and generated APP_KEY"
else
    echo "    .env already exists, left untouched"
fi

echo "==> deploy.env"
if [ ! -f deploy.env ]; then
    cp deploy.env.example deploy.env
    echo "    created deploy.env – set GHCR_TOKEN before running pull.sh"
else
    echo "    deploy.env already exists, left untouched"
fi

echo "==> edge network"
if docker network inspect edge >/dev/null 2>&1; then
    echo "    edge already exists"
else
    docker network create edge >/dev/null
    echo "    created edge"
fi

if [ -n "$WEBSITE_CONTAINER" ]; then
    if docker network connect edge "$WEBSITE_CONTAINER" >/dev/null 2>&1; then
        echo "    attached $WEBSITE_CONTAINER to edge"
    else
        echo "    $WEBSITE_CONTAINER is already attached (or does not exist)"
    fi
else
    echo "    hint: docker network connect edge <website3-app-container>"
    echo "          and add 'edge' to the app service in website3/compose.yml"
fi

if grep -q '^GHCR_TOKEN=$' deploy.env; then
    echo
    echo "    GHCR_TOKEN is empty – the image is public, pull works anonymously."
fi

echo "==> pull + start"
docker compose pull docs
docker compose up -d docs

echo "==> waiting for the health endpoint"
for _ in $(seq 1 30); do
    if docker compose exec -T docs curl -fsS http://127.0.0.1/up >/dev/null 2>&1; then
        break
    fi
    sleep 2
done

echo "==> generating demo assets"
docker compose exec -T docs php artisan demo:assets --url=http://127.0.0.1

print_next_steps
