<?php

namespace Database\Seeders;

use App\Models\AdminModel;
use App\Models\CartModel;
use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin_user = new AdminModel();
        $admin_user->email = 'admin@marketfreak.cl';
        $admin_user->nombre = 'SuperMod';
        $admin_user->password = 'd0630163e27c19ee62e6d3163f629b9ff8b5d9c54a64062233551152c6cb02a6';
        $admin_user->save();

        $cart = new CartModel([
            'email_usuario' => 'fabian@correo.cl'
        ]);
        $cart->save();

        $customer = new UserModel([
            'email' => 'fabian@correo.cl',
            'nombre' => 'Fabian',
            'apellido' => 'Justo',
            'telefono' => '123456789',
            'direccion' => '18 de septiembre 2019',
            'rut' => '2098',
            'password' => 'b4af39d5b65a14849e885a9d65f0efe4f4e689989689c28c16cfcb3a6e78db5a',
            'carro_activo' => $cart->id,
        ]);

        $customer->save();
    }
}
