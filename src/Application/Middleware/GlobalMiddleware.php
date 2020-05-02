<?php


namespace App\Application\Middleware;


use App\Components\Http\Request;
use App\Interfaces\MiddlewareInterface;
use Closure;

/**
 * Class GlobalMiddleware
 * @package App\Application\Middleware
 */
class GlobalMiddleware implements MiddlewareInterface
{

    /**
     * @param Closure $next
     * @param Request $request
     * @return mixed
     */
    public function handle(Closure $next, Request $request)
    {

        $yourCondition = false;

        if ($yourCondition) {
            return $next($request);
        }
        return view(404);
    }
}