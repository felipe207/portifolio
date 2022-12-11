<?php

namespace App\Http\Controllers\Site;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers;

class HomeController extends BaseController
{
    public function home()
    {
        return view('site.home');
    }
}
