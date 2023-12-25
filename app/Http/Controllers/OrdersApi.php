<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class OrdersApi extends Controller

{
    private $orders = [
        [
            'id' => 1,
            'customer' => 'Juan Pérez',
            'total' => 50000,
            'status' => 'Procesando',
            'purchaseDate' => '2023-11-06',
        ],
        [
            'id' => 2,
            'customer' => 'Ana Silva',
            'total' => 20000,
            'status' => 'Enviado',
            'purchaseDate' => '2023-10-28',
        ],
        [
            'id' => 3,
            'customer' => 'Carlos Rojas',
            'total' => 80000,
            'status' => 'Entregado',
            'purchaseDate' => '2023-09-15',
        ],
        [
            'id' => 4,
            'customer' => 'María González',
            'total' => 12000,
            'status' => 'Cancelado',
            'purchaseDate' => '2023-11-01',
        ],
        [
            'id' => 5,
            'customer' => 'Pedro Soto',
            'total' => 30000,
            'status' => 'Pendiente',
            'purchaseDate' => '2023-10-10',
        ],
        [
            'id' => 6,
            'customer' => 'Elena Valdez',
            'total' => 70000,
            'status' => 'Procesando',
            'purchaseDate' => '2023-11-05',
        ],
        [
            'id' => 7,
            'customer' => 'Diego López',
            'total' => 15000,
            'status' => 'Enviado',
            'purchaseDate' => '2023-10-22',
        ],
        [
            'id' => 8,
            'customer' => 'Sofía Torres',
            'total' => 5000,
            'status' => 'Entregado',
            'purchaseDate' => '2023-09-30',
        ],
        [
            'id' => 9,
            'customer' => 'Miguel Hernández',
            'total' => 25000,
            'status' => 'Cancelado',
            'purchaseDate' => '2023-10-05',
        ],
        [
            'id' => 10,
            'customer' => 'Olga Trujillo',
            'total' => 18000,
            'status' => 'Pendiente',
            'purchaseDate' => '2023-11-03',
        ],
        [
            'id' => 11,
            'customer' => 'Gabriel Mendoza',
            'total' => 35000,
            'status' => 'Procesando',
            'purchaseDate' => '2023-10-15',
        ],
        [
            'id' => 12,
            'customer' => 'Lorena Castillo',
            'total' => 60000,
            'status' => 'Enviado',
            'purchaseDate' => '2023-11-02',
        ],
        [
            'id' => 13,
            'customer' => 'Francisco Torres',
            'total' => 180000,
            'status' => 'Entregado',
            'purchaseDate' => '2023-09-20',
        ],
        [
            'id' => 14,
            'customer' => 'Valentina Rojas',
            'total' => 9000,
            'status' => 'Cancelado',
            'purchaseDate' => '2023-10-08',
        ],
        [
            'id' => 15,
            'customer' => 'Hernán Silva',
            'total' => 42000,
            'status' => 'Pendiente',
            'purchaseDate' => '2023-11-04',
        ],
        [
            'id' => 16,
            'customer' => 'Laura Pérez',
            'total' => 75000,
            'status' => 'Procesando',
            'purchaseDate' => '2023-10-18',
        ],
        [
            'id' => 17,
            'customer' => 'Raúl Gómez',
            'total' => 22000,
            'status' => 'Enviado',
            'purchaseDate' => '2023-09-25',
        ],
        [
            'id' => 18,
            'customer' => 'Carolina Soto',
            'total' => 11000,
            'status' => 'Entregado',
            'purchaseDate' => '2023-11-01',
        ],
        [
            'id' => 19,
            'customer' => 'José Torres',
            'total' => 30000,
            'status' => 'Cancelado',
            'purchaseDate' => '2023-10-12',
        ],
        [
            'id' => 20,
            'customer' => 'Daniela Flores',
            'total' => 16000,
            'status' => 'Pendiente',
            'purchaseDate' => '2023-09-28',
        ],
        [
            'id' => 21,
            'customer' => 'Roberto Herrera',
            'total' => 48000,
            'status' => 'Procesando',
            'purchaseDate' => '2023-10-10',
        ],
        [
            'id' => 22,
            'customer' => 'Isabel Rojas',
            'total' => 8000,
            'status' => 'Enviado',
            'purchaseDate' => '2023-11-03',
        ],
        [
            'id' => 23,
            'customer' => 'Mauricio Gutiérrez',
            'total' => 130000,
            'status' => 'Entregado',
            'purchaseDate' => '2023-09-22',
        ],
        [
            'id' => 24,
            'customer' => 'Paulina Mora',
            'total' => 7500,
            'status' => 'Cancelado',
            'purchaseDate' => '2023-10-15',
        ],
        [
            'id' => 25,
            'customer' => 'Cristian Valdez',
            'total' => 27000,
            'status' => 'Pendiente',
            'purchaseDate' => '2023-11-05',
        ],
        [
            'id' => 26,
            'customer' => 'Marisol González',
            'total' => 92000,
            'status' => 'Procesando',
            'purchaseDate' => '2023-10-20',
        ],
        [
            'id' => 27,
            'customer' => 'Felipe Silva',
            'total' => 110000,
            'status' => 'Enviado',
            'purchaseDate' => '2023-09-28',
        ],
        [
            'id' => 28,
            'customer' => 'Camila Sánchez',
            'total' => 13000,
            'status' => 'Entregado',
            'purchaseDate' => '2023-10-31',
        ],
        [
            'id' => 29,
            'customer' => 'Andrés Rodríguez',
            'total' => 6000,
            'status' => 'Cancelado',
            'purchaseDate' => '2023-09-25',
        ],
        [
            'id' => 30,
            'customer' => 'Bárbara Muñoz',
            'total' => 38000,
            'status' => 'Pendiente',
            'purchaseDate' => '2023-11-02',
        ],
    ];
    public function paginatedOrders(Request $request){
        // Get pages and itemsPerPage from query params
        $page = $request->query('page');
        $itemsPerPage = $request->query('itemsPerPage');
        // Get orders from global variable
        // Get total of orders
        $totalOrders = count($this->orders);
        // Get orders from page and itemsPerPage
        $ordersRes = array_slice($this->orders, ($page - 1) * $itemsPerPage, $itemsPerPage);
        // Return orders and total
        return compact('ordersRes', 'totalOrders');
    }
}
