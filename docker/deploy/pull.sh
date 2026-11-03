#!/usr/bin/env bash
# ============================================================
#  laravel-reports doc/demo – pull + deploy
# ============================================================
#  Runs on the host, typically from cron or by hand:
#
#     cd /opt/docker/guggach/laravel-reports && ./pull.sh
#
#  The container is only recreated when the image digest actually
#  changed. An unchanged cron run is a no-op: no restart, no asset
#  regeneration.
# ============================================================

set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")"

if [ ! -f .env ]; then
    echo "error: .env is missing (copy .env.example and set APP_KEY)" >&2
    exit 1
fi

if [ ! -f deploy.env ]; then
    echo "error: deploy.env is missing (copy deploy.env.example)" >&2
    exit 1
fi

# shellcheck disable=SC1091
set -a
. ./deploy.env
set +a

: "${GHCR_USER:=guggach}"
IMAGE="${IMAGE:-ghcr.io/guggach/laravel-reports-doc-demo:latest}"

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

before="$(docker image inspect --format '{{.Id}}' "$IMAGE" 2>/dev/null || true)"

echo "==> pull image"
docker compose pull docs

after="$(docker image inspect --format '{{.Id}}' "$IMAGE" 2>/dev/null || true)"

recreated=0

if [ -z "$after" ]; then
    echo "error: image could not be pulled" >&2
    exit 1
fi

if [ "$before" != "$after" ]; then
    echo "==> new image (${before:-none} -> ${after}), recreating container"
    docker compose up -d --force-recreate docs
    recreated=1
else
    echo "==> image unchanged, ensuring the container is up"
    docker compose up -d docs
fi

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

# The PDFs live inside the container, so a fresh container needs them.
# An unchanged container keeps them from the previous deploy.
if [ "$recreated" -eq 1 ] || ! docker compose exec -T docs test -f /app/storage/app/demo-pdfs/price_list.en.pdf; then
    echo "==> generating demo assets (screenshots + PDFs)"
    docker compose exec -T docs php artisan demo:assets --url=http://127.0.0.1
else
    echo "==> demo assets present, skipping generation"
fi

echo "==> status"
docker compose ps docs

echo "==> done: https://laravel-reports.private-net.ch"
