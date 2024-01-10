<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Parser\ServicesParserService;
use App\Services\Plan\PlanService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected ServicesParserService $ServicesParserService;
    protected PlanService $PlanService;


    public function __construct(ServicesParserService $ServicesParserService, PlanService $PlanService)
    {
        $this->ServicesParserService = $ServicesParserService;
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
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($this->PlanService->request_available==true)
        {
            $this->PlanService->incr_limit();
            return $this->ServicesParserService->boot($request->post('title'));
        }
        else
        {
            return 'Сегодня больше нет доступных запросов';
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
