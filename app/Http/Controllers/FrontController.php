<?php

namespace App\Http\Controllers;

use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * 継承用のコントローラー
 * 責務としては表側のページすべてに使用した伊勢ソッドやbladeに渡したい値の取得
 */
class FrontController extends Controller
{
    protected $estateType = [];

    /**
     * FrontController constructor.
     * @param  Request  $request
     * @param  UtilityService  $utilityService
     */
    public function __construct(Request $request, UtilityService $utilityService)
    {

//        $sampleCount = Hoge::
//        View::share('sampleCount', $sampleCount);
    }
}
