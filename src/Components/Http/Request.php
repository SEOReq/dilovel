<?php

namespace App\Components\Http;

use App\Components\Routers\RouterQueryString;
use App\Interfaces\ArrayAble;
use App\Interfaces\ToJson;
use JsonException;

/**
 * Class Request
 * @package App\Http
 */
class Request implements ArrayAble, ToJson
{
    /**
     * @var array
     */
    private array $request;

    /**
     * @var  array $get
     */
    private array $get;

    /**
     * @var array $post
     */
    private array $post;

    /**
     * @var array
     */
    private array  $server = [];


    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->request = array_map('trim', $_REQUEST);
        $this->get = array_map('trim', $_GET);
        $this->post = array_map('trim', $_POST);
        $this->server=$_SERVER;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return RouterQueryString::get($key,$this->get[$key] ?? $default);
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function post($name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    /**
     * @param array $array
     * @return $this
     */
    public function merge(array $array): self
    {
        array_merge($this->request, $array);
        return $this;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->request;
    }

    /**
     * @return string|null
     * @throws JsonException
     */
    public function toJson(): ?string
    {
        return json_encode($this->request, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array|false
     */
    public function getHeaders()
    {
        return getallheaders();
    }

    /**
     * @return array
     */
    public function server(): array
    {
        return $this->server;
    }

    /**
     * @return string
     */
    public function method(): string
    {

        return $this->server['REQUEST_METHOD'];
    }

    /**
     * @return Session
     */
    public function session(): Session
    {
        return new Session();
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasFile($name): bool
    {
        return isset($_FILES[$name]);
    }

    /**
     * @param string $file
     * @return File
     */
    public function file(string $file): File
    {
        return new File($file);
    }

    /**
     * @return Url
     */
    public function url(): Url
    {
        return new Url();
    }

    /**
     * @return false|string
     * @throws JsonException
     * @noinspection MagicMethodsValidityInspection
     */
    public function __toString()
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }


    /**
     * @return mixed
     */
    public function ip()
    {
        if (!empty($this->server()['HTTP_CLIENT_IP'])) {
            return  $this->server()['HTTP_CLIENT_IP'];
        }

        if (!empty($this->server()['HTTP_X_FORWARDED_FOR'])) {
           return $this->server()['HTTP_X_FORWARDED_FOR'];
        }

        return $this->server()['REMOTE_ADDR'];
    }
}