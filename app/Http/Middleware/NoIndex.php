<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Marks demo-only pages as "do not index".
 *
 * The documentation pages are the SEO surface; the example reports are an
 * interactive playground and would only add thin, filter-dependent URLs.
 * A header is used instead of a robots.txt disallow on purpose: a disallowed
 * URL can still be indexed (without a snippet) because the crawler never gets
 * to see the noindex signal.
 */
final class NoIndex
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Robots-Tag', 'noindex, nofollow');

        return $response;
    }
}
