<?php


namespace App\Application\Controllers;

use App\Application\Elastic\ElasticModelExample;
use App\Application\Models\Users;
use App\Components\Collection\Collection;
use App\Components\Http\Request;
use App\Components\Reflection\RuleAnnotation;

/**
 * Class Deneme
 * @package App\Application\Controllers
 */
class Deneme
{
    public function index(Request $request)
    {
        $elastic=new ElasticModelExample();
        $elastic->testField='elbet bir gün';
        return $elastic->save();

        $model=ElasticModelExample::find('dene5f1f2df66d99a6.80384871');
        $model->testField = 'gece ateşi';
        return   $model->save();
    }
}
