<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Parser\ProductParserService;
use App\Services\Plan\PlanService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductParserService $productParserService;
    protected PlanService $PlanService;

    public function __construct(ProductParserService $productParserService, PlanService $PlanService)
    {
        $this->productParserService = $productParserService;
        $this->PlanService=$PlanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($this->PlanService->request_available()==true)
        {
            $this->PlanService->incr_limit();
            return $this->productParserService->boot($request->post('title'));
        }
        else
        {
            return [[
                'img'=>'https://img.freepik.com/free-vector/warning-sign-gradient-shine_78370-1774.jpg?w=826&t=st=1704902165~exp=1704902765~hmac=024560b184d366f09b9b3cb55f5318e0bcc8bd86879fe88243da71c44af67cba',
                'title'=>'Сегодня больше нет доступных запросов'
                ]];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
