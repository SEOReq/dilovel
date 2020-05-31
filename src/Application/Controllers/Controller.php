<?php


namespace App\Application\Controllers;

use App\Application\Models\Book;
use App\Application\Models\Users;
use App\Application\Request\TcNoVerifyRequest;
use App\Components\Auth\User\Auth;
use App\Components\String\Str;
use JsonException;

/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{
    /**
     * @param TcNoVerifyRequest $request
     * @return false|string
     * @throws JsonException
     */
    public function index(TcNoVerifyRequest $request)
    {
        $str = new Str('///MERHABA/////');
        return $str
            ->length()
             ->md5();

        //App::addDeferObject(new ExampleShutdownListener());
        //return $request->is('mobile');
        //return user()->get();

        /*$mail=new Mail();
        $mail->setSubject('title mail');
        $mail->setTo('berxudar@gmail.com');
        $mail->attach(__FILE__);
        $mail->setBody('message content foo bar ');
        $mail->setFrom('dilsizkaval@windowslive.com');
        return $mail->send();

        $queue=new Queue('test');
        $queue->add(new SendEmail());
        $queue->add(new ExampleQueue('dılo sürücü'));*/


        //$user= $request->user()->get();
        // Auth::user()->isCanLogin('berxudar@gmail.com',1234567);
        //Auth::user()->login(Users::find(34));
        //Auth::user()->logout();
        //return Auth::user()->get();
    }
}
