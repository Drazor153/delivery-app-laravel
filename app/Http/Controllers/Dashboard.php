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
        $orders = DB::table('carro', 'c')
            ->join('usuario', 'usuario.email', '=', 'c.email_usuario', 'inner')
            ->whereNotNull('estado_delivery')
            ->select('c.id_carro as id', DB::raw("concat(usuario.nombre, ' ', usuario.apellido) as customer"), 'c.precio_total as total', 'c.estado_delivery as status', 'c.fecha_pago as purchaseDate')
            ->orderBy('c.fecha_pago', 'desc')
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
