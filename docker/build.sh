#!/usr/bin/env bash
# ============================================================
#  Build the demo image locally or in CI
# ============================================================
#  Assembles a build context that contains both repositories:
#
#     app/               <- this repository
#     laravel-reports/   <- the package (Composer path repository)
#
#  Usage:
#     ./docker/build.sh
#     ./docker/build.sh --push
#     TAG=v1.2.3 ./docker/build.sh --push
#     PACKAGE_DIR=/src/laravel-reports ./docker/build.sh
#
#  The package is expected at ../laravel-reports (like the README
#  describes for local development). Override with PACKAGE_DIR.
# ============================================================

set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PACKAGE_DIR="${PACKAGE_DIR:-$(dirname "$APP_DIR")/laravel-reports}"
IMAGE="${IMAGE:-ghcr.io/guggach/laravel-reports-doc-demo}"
TAG="${TAG:-latest}"
PUSH=0

while [ $# -gt 0 ]; do
    case "$1" in
        --push)
            PUSH=1
            ;;
        --tag)
            TAG="$2"
            shift
            ;;
        --image)
            IMAGE="$2"
            shift
            ;;
        -h|--help)
            sed -n '2,18p' "${BASH_SOURCE[0]}" | sed 's/^# \{0,1\}//'
            exit 0
            ;;
        *)
            echo "Unknown option: $1" >&2
            exit 1
            ;;
    esac
    shift
done

if [ ! -f "$PACKAGE_DIR/composer.json" ]; then
    echo "error: the laravel-reports package was not found at:" >&2
    echo "       $PACKAGE_DIR" >&2
    echo "       Clone it next to this repository or set PACKAGE_DIR." >&2
    exit 1
fi

APP_VERSION="${APP_VERSION:-$(git -C "$APP_DIR" describe --tags --always 2>/dev/null || echo dev)}"
BUILD_DIR="$(mktemp -d)"
trap 'rm -rf "$BUILD_DIR"' EXIT

echo "==> assembling build context in $BUILD_DIR"

mkdir -p "$BUILD_DIR/app"

rsync -a \
    --exclude '.git/' \
    --exclude '.github/' \
    --exclude '.idea/' \
    --exclude '.vscode/' \
    --exclude 'node_modules/' \
    --exclude 'vendor/' \
    --exclude '.env' \
    --exclude 'database/*.sqlite' \
    --exclude 'storage/logs/' \
    --exclude 'storage/framework/' \
    --exclude 'storage/app/demo-pdfs/' \
    --exclude 'public/build/' \
    --exclude 'public/hot' \
    --exclude 'tests/' \
    --exclude 'phpunit.xml' \
    "$APP_DIR/" "$BUILD_DIR/app/"

rsync -a \
    --exclude '.git/' \
    --exclude 'node_modules/' \
    --exclude 'vendor/' \
    --exclude '.env' \
    "$PACKAGE_DIR/" "$BUILD_DIR/laravel-reports/"

cp "$APP_DIR/docker/dockerignore" "$BUILD_DIR/.dockerignore"

echo "==> docker build ${IMAGE}:${TAG} (APP_VERSION=${APP_VERSION})"

docker build \
    --build-arg "APP_VERSION=${APP_VERSION}" \
    --tag "${IMAGE}:${TAG}" \
    --file "$BUILD_DIR/app/docker/Dockerfile" \
    "$BUILD_DIR"

if [ "$PUSH" -eq 1 ]; then
    echo "==> docker push ${IMAGE}:${TAG}"
    docker push "${IMAGE}:${TAG}"
fi

echo "==> done: ${IMAGE}:${TAG}"
