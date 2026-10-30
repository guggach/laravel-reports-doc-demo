<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

final class DocsController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'examples' => $this->exampleList(),
        ]);
    }

    public function examples(): View
    {
        return view('examples.index', [
            'examples' => $this->exampleList(),
        ]);
    }

    public function example(string $key): View
    {
        $example = collect($this->exampleList())->firstWhere('key', $key);

        abort_unless($example !== null, 404);

        return view('examples.show', [
            'example' => $example,
        ]);
    }

    public function index(): View
    {
        return view('docs.index');
    }

    public function show(string $page): View
    {
        $pages = config('docs.pages', []);

        abort_unless(isset($pages[$page]), 404);

        return view($pages[$page]['view']);
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function exampleList(): array
    {
        return config('docs.examples', []);
    }
}
