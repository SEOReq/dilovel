<?php


namespace App\Components\Routers;


/**
 * Class Router
 * @package App\Routers\Components
 * @method static get($url, $callback)
 * @method static post($url, $callback)
 */
class Router
{

    /**
     * @param $name
     * @param $arguments
     * @return MainRouter
     *
     */
    public static function __callStatic($name, $arguments)
    {
        if ($_SERVER['REQUEST_METHOD'] === strtoupper($name)) {
            return new MainRouter(
                new ParseArguments($arguments)
            );

        }
    }

    public static function group($attributes,$callback)
    {
        return $callback();
    }
}