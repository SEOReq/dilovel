<?php


namespace App\Components\Http;

use App\Interfaces\ArrayAble;

/**
 * Class Cookie
 * @package App\Components\Http
 */
class Cookie implements ArrayAble
{

    /**
     * @var array
     */
    private array $cookie;

    /**
     * Cookie constructor.
     */
    public function __construct()
    {
        $this->cookie =& $_COOKIE;
    }


    /**
     * @param string $name
     * @param $value
     * @param int $time
     * @return bool
     */
    public function set(string $name, $value, $time = 3600): bool
    {
        $cookie = serialize(['value' => $value, 'expire' => $time + time()]);
        return setcookie($name, $cookie, time() + $time);
    }

    /**
     * @param string $name
     * @param null $default
     * @return ParseCookie
     */
    public function get(string $name, $default = null): ParseCookie
    {
        if (isset($this->cookie[$name]) && $this->isSerializedString($this->cookie[$name])) {
            return new ParseCookie((object)unserialize($this->cookie[$name], ['allowed_classes' => true]));
        }

        if (isset($this->cookie[$name])) {
            return new ParseCookie((object)['value' => $this->cookie[$name], 'expire' => 0]);
        }

        return new ParseCookie((object)['value' => $default, 'expire' => 0]);
    }

    /**
     * @param $name
     * @return bool
     */
    public function exists($name): bool
    {
        return isset($this->cookie[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function delete(string $name): bool
    {
        return setcookie($name, null, time() - 3600);
    }

    private function isSerializedString($string): bool
    {
        return ($string === 'b:0;' || @unserialize($string, ['allowed_classes' => true]) !== false);
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->cookie as $name => $value) {
            if ($this->isSerializedString($value)) {
                $objectCookie = unserialize($value, ['allowed_classes' => true]);
                $array[] = [

                    'name' => $name,
                    'value' => $objectCookie['value'],
                    'expire' => $objectCookie['expire'] - time()
                ];
            } else {
                $array[]=[
                    'name'=>$name,
                    'value'=>$value,
                    'expire'=>0,
                ];
            }
        }
        return $array;
    }
}
