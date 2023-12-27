<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Storage;

class ProductsApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $products = ProductModel::all();
        $storage = Storage::disk('marketfreak');
        // $path = './marketfreakV3/images/';
        // loop through the products and change the image path
        foreach ($products as $product) {
            $type = pathinfo($product->imagen, PATHINFO_EXTENSION);
            $data = $storage->get($product->imagen);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $product->imagen = $base64;
        }   
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $product = ProductModel::all()->where('codigo', $code)->first();
        $storage = Storage::disk('marketfreak');
        $type = pathinfo($product->imagen, PATHINFO_EXTENSION);
        $data = $storage->get($product->imagen);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $product->imagen = $base64;
        return $product;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
