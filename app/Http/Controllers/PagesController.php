<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Service;
use App\Models\Portifolio;
use App\Models\About;

class PagesController extends Controller
{
    public function index(){

        $data = ['main','services','portfolios','abouts'];
        $main = Main::first();
        $services = Service::all();
        $portfolios = Portifolio::all();
        $abouts = About::all();
        return view('pages.index', compact($data));
    }

}
