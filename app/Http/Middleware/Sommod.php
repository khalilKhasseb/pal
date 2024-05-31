<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class Sommod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next(
            $this->validateSource($request)
        );
    }


    protected function validateSource($request): Request
    {
        $source = $request->route()->getName();
        $content_provider_source = $this->getContentProvider()['source'];

        if ($source === $content_provider_source) {
            return $request;
        }
        $this->setProvider($request);

        return $request;
    }
    protected function setContentProvider($provider, $source): void
    {

        $content_provider_file_path = storage_path('app/content_provider.json');
        $content_provider = json_encode([
            'provider' => $provider,
            'source' => $source
        ]);
        // validate file if not exists

        file_put_contents($content_provider_file_path, $content_provider);
    }

    protected function getContentProvider(): array | \Exception
    {
        if (file_exists(storage_path('app/content_provider.json'))) {

            return json_decode(Storage::get('content_provider.json'), true);
        }

        throw new \Exception('File content provider not exisits');
    }

    protected function setProvider(Request $request): void
    {
        $routeName = $request->route()->getName();
        if ($this->routeSommod($request)) {
            $this->setContentProvider('sommod', $routeName);
        } elseif ($this->routeHome($request)) {
            $this->setContentProvider('council', $routeName);
        } elseif ($this->routeBackEnd($request)) {
            $this->setContentProvider('admin', $routeName);
        }
    }



    private function routeSommod(Request $request): bool
    {
        return $request->route()->getName() === 'front.sommod.home';
    }
    private function routeHome(Request $request): bool
    {
        return $request->route()->getName() === 'theme.home';
    }

    private function routeBackEnd(Request $request): bool
    {
        return str_contains($request->route()->getName(), 'filament');
    }
}
