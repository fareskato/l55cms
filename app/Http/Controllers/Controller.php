<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Search engine for each type
     */
//    public function search($entity, $text, $field1 = null, $field2 = null)
//    {
//        $text = strtolower($text);
//
//        $result = $entity::where($field1, 'LIKE', '%'.$text.'%');
//        if(count($result) > 0){
//            dd('fares');
//        }
//    }
}
