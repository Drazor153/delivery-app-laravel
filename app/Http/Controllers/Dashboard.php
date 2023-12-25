<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    private $itemsPerPage = 10;
    private $dateformat = 'd-m-Y / H:i';


    private function formatDate($date)
    {
        return date($this->dateformat, strtotime($date));
    }

    public function index(Request $request)
    {
        // $orders = [
        //     [
        //         'id' => 1,
        //         'customer' => 'Juan Pérez',
        //         'total' => 50000,
        //         'status' => 'Procesando',
        //         'purchaseDate' => $this->formatDate('2023-11-06 15:00'),
        //     ],
        //     [
        //         'id' => 2,
        //         'customer' => 'Ana Silva',
        //         'total' => 20000,
        //         'status' => 'Enviado',
        //         'purchaseDate' => $this->formatDate('2023-10-28'),
        //     ],
        //     [
        //         'id' => 3,
        //         'customer' => 'Carlos Rojas',
        //         'total' => 80000,
        //         'status' => 'Entregado',
        //         'purchaseDate' => $this->formatDate('2023-09-15'),
        //     ],
        //     [
        //         'id' => 4,
        //         'customer' => 'María González',
        //         'total' => 12000,
        //         'status' => 'Cancelado',
        //         'purchaseDate' => $this->formatDate('2023-11-01'),
        //     ],
        //     [
        //         'id' => 5,
        //         'customer' => 'Pedro Soto',
        //         'total' => 30000,
        //         'status' => 'Pendiente',
        //         'purchaseDate' => $this->formatDate('2023-10-10'),
        //     ],
        //     [
        //         'id' => 6,
        //         'customer' => 'Elena Valdez',
        //         'total' => 70000,
        //         'status' => 'Procesando',
        //         'purchaseDate' => $this->formatDate('2023-11-05'),
        //     ],
        //     [
        //         'id' => 7,
        //         'customer' => 'Diego López',
        //         'total' => 15000,
        //         'status' => 'Enviado',
        //         'purchaseDate' => $this->formatDate('2023-10-22'),
        //     ],
        //     [
        //         'id' => 8,
        //         'customer' => 'Sofía Torres',
        //         'total' => 5000,
        //         'status' => 'Entregado',
        //         'purchaseDate' => $this->formatDate('2023-09-30'),
        //     ],
        //     [
        //         'id' => 9,
        //         'customer' => 'Miguel Hernández',
        //         'total' => 25000,
        //         'status' => 'Cancelado',
        //         'purchaseDate' => $this->formatDate('2023-10-05'),
        //     ],
        //     [
        //         'id' => 10,
        //         'customer' => 'Olga Trujillo',
        //         'total' => 18000,
        //         'status' => 'Pendiente',
        //         'purchaseDate' => $this->formatDate('2023-11-03'),
        //     ],
        //     [
        //         'id' => 11,
        //         'customer' => 'Gabriel Mendoza',
        //         'total' => 35000,
        //         'status' => 'Procesando',
        //         'purchaseDate' => $this->formatDate('2023-10-15'),
        //     ],
        //     [
        //         'id' => 12,
        //         'customer' => 'Lorena Castillo',
        //         'total' => 60000,
        //         'status' => 'Enviado',
        //         'purchaseDate' => $this->formatDate('2023-11-02'),
        //     ],
        //     [
        //         'id' => 13,
        //         'customer' => 'Francisco Torres',
        //         'total' => 180000,
        //         'status' => 'Entregado',
        //         'purchaseDate' => $this->formatDate('2023-09-20'),
        //     ],
        //     [
        //         'id' => 14,
        //         'customer' => 'Valentina Rojas',
        //         'total' => 9000,
        //         'status' => 'Cancelado',
        //         'purchaseDate' => $this->formatDate('2023-10-08'),
        //     ],
        //     [
        //         'id' => 15,
        //         'customer' => 'Hernán Silva',
        //         'total' => 42000,
        //         'status' => 'Pendiente',
        //         'purchaseDate' => $this->formatDate('2023-11-04'),
        //     ],
        //     [
        //         'id' => 16,
        //         'customer' => 'Laura Pérez',
        //         'total' => 75000,
        //         'status' => 'Procesando',
        //         'purchaseDate' => $this->formatDate('2023-10-18'),
        //     ],
        //     [
        //         'id' => 17,
        //         'customer' => 'Raúl Gómez',
        //         'total' => 22000,
        //         'status' => 'Enviado',
        //         'purchaseDate' => $this->formatDate('2023-09-25'),
        //     ],
        //     [
        //         'id' => 18,
        //         'customer' => 'Carolina Soto',
        //         'total' => 11000,
        //         'status' => 'Entregado',
        //         'purchaseDate' => $this->formatDate('2023-11-01'),
        //     ],
        //     [
        //         'id' => 19,
        //         'customer' => 'José Torres',
        //         'total' => 30000,
        //         'status' => 'Cancelado',
        //         'purchaseDate' => $this->formatDate('2023-10-12'),
        //     ],
        //     [
        //         'id' => 20,
        //         'customer' => 'Daniela Flores',
        //         'total' => 16000,
        //         'status' => 'Pendiente',
        //         'purchaseDate' => $this->formatDate('2023-09-28'),
        //     ],
        //     [
        //         'id' => 21,
        //         'customer' => 'Roberto Herrera',
        //         'total' => 48000,
        //         'status' => 'Procesando',
        //         'purchaseDate' => $this->formatDate('2023-10-10'),
        //     ],
        //     [
        //         'id' => 22,
        //         'customer' => 'Isabel Rojas',
        //         'total' => 8000,
        //         'status' => 'Enviado',
        //         'purchaseDate' => $this->formatDate('2023-11-03'),
        //     ],
        //     [
        //         'id' => 23,
        //         'customer' => 'Mauricio Gutiérrez',
        //         'total' => 130000,
        //         'status' => 'Entregado',
        //         'purchaseDate' => $this->formatDate('2023-09-22'),
        //     ],
        //     [
        //         'id' => 24,
        //         'customer' => 'Paulina Mora',
        //         'total' => 7500,
        //         'status' => 'Cancelado',
        //         'purchaseDate' => $this->formatDate('2023-10-15'),
        //     ],
        //     [
        //         'id' => 25,
        //         'customer' => 'Cristian Valdez',
        //         'total' => 27000,
        //         'status' => 'Pendiente',
        //         'purchaseDate' => $this->formatDate('2023-11-05'),
        //     ],
        //     [
        //         'id' => 26,
        //         'customer' => 'Marisol González',
        //         'total' => 92000,
        //         'status' => 'Procesando',
        //         'purchaseDate' => $this->formatDate('2023-10-20'),
        //     ],
        //     [
        //         'id' => 27,
        //         'customer' => 'Felipe Silva',
        //         'total' => 110000,
        //         'status' => 'Enviado',
        //         'purchaseDate' => $this->formatDate('2023-09-28'),
        //     ],
        //     [
        //         'id' => 28,
        //         'customer' => 'Camila Sánchez',
        //         'total' => 13000,
        //         'status' => 'Entregado',
        //         'purchaseDate' => $this->formatDate('2023-10-31'),
        //     ],
        //     [
        //         'id' => 29,
        //         'customer' => 'Andrés Rodríguez',
        //         'total' => 6000,
        //         'status' => 'Cancelado',
        //         'purchaseDate' => $this->formatDate('2023-09-25'),
        //     ],
        //     [
        //         'id' => 30,
        //         'customer' => 'Bárbara Muñoz',
        //         'total' => 38000,
        //         'status' => 'Pendiente',
        //         'purchaseDate' => $this->formatDate('2023-11-02'),
        //     ],
        // ];

        $orders = DB::table('carro', 'c')
            ->join('usuario', 'usuario.email', '=', 'c.email_usuario', 'inner')
            ->whereNotNull('estado_delivery')
            ->select('c.id_carro as id', DB::raw("concat(usuario.nombre, ' ', usuario.apellido) as customer"), 'c.precio_total as total', 'c.estado_delivery as status', 'c.fecha_pago as purchaseDate')
            ->get();
        
        $ordersArray = $orders->toArray();

        // Get pages and itemsPerPage from query params
        $page = $request->query('page');
        if (!$page) {
            $page = 1;
        }
        // Get total of orders
        $totalOrders = count($ordersArray);
        // Get orders from page and itemsPerPage
        $ordersRes = array_slice($ordersArray, ($page - 1) * $this->itemsPerPage, $this->itemsPerPage);
        // Return orders and total
        $lastPage = ceil($totalOrders / $this->itemsPerPage);
        return view('dashboard/index', compact('ordersRes', 'page', 'lastPage'));
    }

    public function all()
    {
        $orders = DB::table('carro', 'c')
            ->join('usuario', 'usuario.email', '=', 'c.email_usuario', 'inner')
            ->whereNotNull('estado_delivery')
            ->select('c.id_carro as id', DB::raw("concat(usuario.nombre, ' ', usuario.apellido) as customer"), 'c.precio_total as total', 'c.estado_delivery as status', 'c.fecha_pago as purchaseDate')
            ->get();

        return compact('orders');
    }
}
