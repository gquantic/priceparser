<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Parser\ProductParserService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductParserService $productParserService;

    public function __construct(ProductParserService $productParserService)
    {
        $this->productParserService = $productParserService;
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
        return $this->productParserService->boot($request->post('title'));
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
