<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\LineProductModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function register(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $hpass = hash('sha256', $password);
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $rut = $request->input('rut');

        $user = UserModel::all()->where('email', $email)->first();
        if($user != null){
            $success = false;
            return compact('success');
        }
        $new_cart = new CartModel([
            'email_usuario' => $email,
        ]);
        $new_cart->save();

        $user = new UserModel([
            'email' => $email,
            'password' => $hpass,
            'nombre' => $name,
            'apellido' => $lastname,
            'telefono' => $phone,
            'direccion' => $address,
            'rut' => $rut,
            'carro_activo' => $new_cart->id_carro,
        ]);
        $user->save();
        $success = true;
        return compact('success', 'user');
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
        $products_cart = DB::table('linea_producto')->where('id_carro', $active_cart)->get();

        // $products_cart = LineProductModel::all()->where('id_carro', $active_cart);
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

    public function addLineProduct(Request $request){
        $email = $request->input('email');
        $codigo = $request->input('codigo');
        $user = UserModel::all()->where('email', $email)->first();
        if($user == null){
            $response = [
                'success' => false,
                'message' => 'No existe el usuario'
            ];
            return $response;
        }
        $active_cart_instance = CartModel::all()->where('id_carro', $user->carro_activo)->first();
        if($active_cart_instance == null){
            $response = [
                'success' => false,
                'message' => 'No hay un carro activo'
            ];
            return $response;
        }

        $active_cart = $user->carro_activo;
        $product = ProductModel::all()->where('codigo', $codigo)->first();
        $line_product = LineProductModel::all()->where('id_carro', $active_cart)->where('codigo_producto', $codigo)->first();
        if($line_product == null){
            $line = new LineProductModel();
            $line->id_carro = $active_cart;
            $line->codigo_producto = $codigo;
            $line->cantidad = 1;
            $line->precio_linea = $product->precio;
            $line->save();
        }else{
            $line_product->cantidad += 1;
            $line_product->precio_linea = $line_product->cantidad * $product->precio;
            $line_product->save();
        }
        $active_cart_instance->precio_total += $product->precio;
        $active_cart_instance->save();
        $data = [
            'success' => true,
            'new_balance' => $active_cart_instance->precio_total
        ];
        return $data;
    }
}
