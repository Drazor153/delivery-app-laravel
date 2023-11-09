<?php

namespace Database\Seeders;

use App\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $producto1 = new ProductModel([
            'codigo' => 'NA001',
            'nombre' => 'Uchiha Sasuke',
            'precio' => 25000,
            'imagen' => 'sasukeoioeq.jpg',
            'descripcion' => 'Nendoroid de Sasuke Uchiha',
            'stock' => 60,
            // 'activo' => 1,
        ]);
        $producto1->save();

        $producto2 = new ProductModel([
            'codigo' => 'NA002',
            'nombre' => 'Naruto Uzumaki Rasengan',
            'precio' => 54990,
            'imagen' => 'Figura_Naruto_Uzumaki.jpeg',
            'descripcion' => 'y el protagonista homónimo de la franquicia de Naruto. Se convirtió en el jinchuriki de Kurama el día de su nacimiento, un destino que lo llevó a ser condenado al ostracismo por toda la aldea durante toda su infancia. Después de unirse al Equipo Kakashi, Naruto trabajó duro para ganarse el respeto y el reconocimiento de la aldea, con el sueño de convertirse en Hokage. En los años siguientes, Naruto se convierte en un ninja capaz, que eventualmente es considerado un héroe, tanto por los residente',
            'stock' => 20,
            // 'activo' => 1,
        ]);
        $producto2->save();

        $producto3 = new ProductModel([
            'codigo' => 'OP001',
            'nombre' => 'Figura Luffy One Piece',
            'precio' => 30000,
            'imagen' => 'qwesz.jpg',
            'descripcion' => 'Saga de One Piece figura',
            'stock' => 50,
            // 'activo' => 0,
        ]);
        $producto3->save();

        $producto4 = new ProductModel([
            'codigo' => 'TR001',
            'nombre' => 'MANGA TOKYO REVENGERS N.2',
            'precio' => 8000,
            'imagen' => 'Manga_Tokyo_Revengers.jpeg',
            'descripcion' => 'Takemichi, el antiguo delincuente juvenil que creció para convertirse en un completo fracasado, ¡salta en el tiempo hasta sus épocas de gloria en la secundaria baja!\r\nDespués de regresar 12 años al pa',
            'stock' => 23,
            // 'activo' => 1,
        ]);
        $producto4->save();

        $producto5 = new ProductModel([
            'codigo' => 'ZD001',
            'nombre' => 'Figura Link TLOZ',
            'precio' => 30000,
            'imagen' => 'asdqew.jpg',
            'descripcion' => 'Figura de Link perteneciente a la franquicia de The Legend of Zelda',
            'stock' => 50,
            // 'activo' => 1,
        ]);
        $producto5->save();
    }
}
