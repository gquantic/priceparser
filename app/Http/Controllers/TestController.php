<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Parser\ProductParserService;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        $client= new ProductParserService();
        $responce= $client->boot('планшет');
        dd($responce);
    }


}
