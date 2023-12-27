<?php

namespace App\Http\Controllers;

use App\Models\LineProductModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientApi extends Controller
{
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $hpass = hash('sha256', $password);
        $user = UserModel::all()->where('email', $email)->first();
        error_log($user->password);
        error_log($hpass);
        if($user == null){
            $success = false;
            return compact('success');
        }
        if($user->password == $hpass){
            $success = true;
            return compact('success', 'user');
        }

        $success = false;
        return compact('success');
    }

    public function updateBalance(Request $request){
        $email = $request->input('email');
        $balance = $request->input('balance');
        $user = UserModel::all()->where('email', $email)->first();
        if($user == null){
            $success = false;
            return compact('success');
        }
        $user->saldo += $balance;
        $user->save();
        $success = true;
        $new_balance = $user->saldo;
        return compact('success', 'new_balance');
    }

    public function getCartUser(string $email){
        $user = UserModel::all()->where('email', $email)->first();
        if($user == null){
            $success = false;
            return compact('success');
        }
        $active_cart = $user->carro_activo;

        $products_cart = LineProductModel::all()->where('id_carro', $active_cart);
        
        foreach ($products_cart as $product) {
            $product->producto = ProductModel::all(['nombre', 'imagen', 'precio', 'codigo'])->where('codigo', $product->codigo_producto)->first();
            $storage = Storage::disk('marketfreak');
            $type = pathinfo($product->producto->imagen, PATHINFO_EXTENSION);
            $data = $storage->get($product->producto->imagen);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $product->producto->imagen = $base64;
            unset($product->codigo_producto);
        }
        $success = true;
        return compact('success', 'products_cart');
    }
}
