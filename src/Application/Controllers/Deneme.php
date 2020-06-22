<?php


namespace App\Application\Controllers;

use App\Components\Http\Request;

class Deneme
{
    public function index(Request $request)
    {
        return redirect()->router('index')
            ->withHash('dilocan')
            ->withQuery(['id'=>15,'haber'=>'alasana'])
             ;
    }
}
