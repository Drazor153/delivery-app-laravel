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
        pathinfo('/api/products', PATHINFO_EXTENSION);
        $products = ProductModel::all();
        $storage = Storage::disk('marketfreak');
        // $path = './marketfreakV3/images/';
        // loop through the products and change the image path
        foreach ($products as $product) {
            
            $type = pathinfo($product->imagen, PATHINFO_EXTENSION);
            // error_log(File::get($path));
            // $data = file_get_contents($pathimage);
            error_log($product->imagen);
            error_log(mb_convert_encoding($product->imagen, 'UTF-8', 'UTF-8'));
            $data = $storage->get(mb_convert_encoding($product->imagen, 'UTF-8', 'UTF-8'));
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
    public function show(string $id)
    {
        //
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
