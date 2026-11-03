#!/usr/bin/env bash
# ============================================================
#  laravel-reports doc/demo – pull + deploy
# ============================================================
#  Runs on the host, typically from cron or by hand:
#
#     cd /opt/laravel-reports && ./pull.sh
#
#  Steps:
#    1. login to ghcr.io (token from deploy.env)
#    2. pull the image
#    3. recreate the container
#    4. wait for /up
#    5. regenerate screenshots + prebuilt PDFs inside the container
#
#  The generator runs with --url=http://127.0.0.1 so the container
#  fetches its own assets without going through the public proxy.
# ============================================================

set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")"

if [ ! -f .env ]; then
    echo "error: .env is missing (copy .env.example and set APP_KEY)" >&2
    exit 1
fi

if [ ! -f deploy.env ]; then
    echo "error: deploy.env is missing (copy deploy.env.example and set GHCR_TOKEN)" >&2
    exit 1
fi

# shellcheck disable=SC1091
set -a
. ./deploy.env
set +a

: "${GHCR_USER:=guggach}"

if [ -n "${GHCR_TOKEN:-}" ]; then
    echo "==> docker login ghcr.io"
    if ! printf '%s' "$GHCR_TOKEN" | docker login ghcr.io -u "$GHCR_USER" --password-stdin >/dev/null 2>&1; then
        echo "error: ghcr.io login failed. The token is probably expired." >&2
        echo "       Create a PAT with scope read:packages and update deploy.env." >&2
        exit 1
    fi
else
    echo "==> no GHCR_TOKEN set, pulling anonymously (public image)"
fi

echo "==> pull image"
docker compose pull docs

echo "==> recreate container"
docker compose up -d --force-recreate docs

echo "==> waiting for the health endpoint"
healthy=0
for _ in $(seq 1 30); do
    if docker compose exec -T docs curl -fsS http://127.0.0.1/up >/dev/null 2>&1; then
        healthy=1
        break
    fi
    sleep 2
done

if [ "$healthy" -ne 1 ]; then
    echo "error: the container did not become healthy." >&2
    docker compose logs --tail=80 docs
    exit 1
fi

echo "==> generating demo assets (screenshots + PDFs)"
docker compose exec -T docs php artisan demo:assets --url=http://127.0.0.1

echo "==> status"
docker compose ps docs

echo "==> done: https://laravel-reports.private-net.ch"
