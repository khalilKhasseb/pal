<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;
use App\Models\Scopes\PanelScope;
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


        $conFrontEnd = !str_contains(str_replace('/', '', request()->getRequestUri()), 'home-sommod');

        $sommod = str_contains(str_replace('/', '', request()->getRequestUri()), 'home-sommod');
        $backEnd = false;
        if (!is_null(request()->route())) {


            $backEnd = str_contains(request()->route()->getName(), 'filament');
        }

        // check if sommod and file is set to sommod

        if ($conFrontEnd && $this->getContentProvider() === 'admin') {
            return $next($request);
        }

        if ($sommod && $this->getContentProvider() === 'sommod') {
            return $next($request);
        }
        // if ($conFrontEnd && !$backEnd) {
        //     $this->setContentProvider('admin', 'frontend');
        // }

        if ($conFrontEnd) {

            $this->setContentProvider('admin', 'backend');
        }
        if ($sommod) {

            $this->setContentProvider('sommod', 'frontend');
        }
        if ($backEnd) {

            $this->setContentProvider('admin', 'backend');
        }



        return $next($request);
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

    protected function getContentProvider()
    {
        if (file_exists(storage_path('app/content_provider.jsin'))) {

            return json_decode(Storage::get('content_provider.json'))->provider;
        }

        return 'admin';
    }
}
