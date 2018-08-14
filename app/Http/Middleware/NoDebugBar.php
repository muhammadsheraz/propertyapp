<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

/**
 * Class NoDebugBar.
 */
class NoDebugBar
{
    /**
     * @param         $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        \Debugbar::disable();

        return $next($request);
    }
}
