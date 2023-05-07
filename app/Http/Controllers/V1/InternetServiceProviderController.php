<?php

namespace App\Http\Controllers\V1;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CalculatorInterface;

class InternetServiceProviderController extends Controller
{
    private $mptService;
    private $ooredooService;

    public function __construct(Mpt $mptService, Ooredoo $ooredooService)
    {
        $this->mptService = $mptService;
        $this->ooredooService = $ooredooService;
    }

    public function service(Request $request)
    {
        return response()->json(
            app($request->route('type'))->calculate($request['month'])
        );
    }
}
