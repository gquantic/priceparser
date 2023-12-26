<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Parser\ServicesParserService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected ServicesParserService $ServicesParserService;

    public function __construct(ServicesParserService $ServicesParserService)
    {
        $this->ServicesParserService = $ServicesParserService;
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
        return $this->ServicesParserService->boot($request->post('title'));
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
