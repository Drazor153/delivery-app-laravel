@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="mt-4 grid place-items-center">
    <table class="w-[90%] border border-slate-400 text-left" [ngClass]="{'animate-pulse': isLoading}">
      <thead class="bg-slate-400 uppercase">
        <tr>
          <th class="px-3 py-3">#</th>
          <th class="px-6 py-3">Comprador</th>
          <th class="px-6 py-3">Estado de delivery</th>
          <th class="px-4 py-3">Fecha de compra</th>
          <th class="px-6 py-3">Total</th>
          <th class="px-6 py-3 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody id="ordersTBody">
        {{-- Set currency format --}}
        @foreach ($ordersRes as $order)
          <tr class="border-b border-slate-400 bg-slate-200 hover:bg-slate-300">
            <th scope="row" class="px-3 py-3">{{ $order->id }}</th>
            <td class="px-6 py-3">{{ $order->customer }}</td>
            <td class="px-6 py-3">{{ $order->status }}</td>

            <td class="px-4 py-3">{{ $order->purchaseDate }}</td>
            <td class="px-6 py-3">${{ number_format($order->total, 0, ',', '.') }}</td>
            <td class="flex justify-center gap-2 py-3">
              <a class="whitespace-nowrap rounded-lg bg-blue-600 px-3 py-1.5 text-white hover:bg-blue-700"
                href="">Revisar</a>
              <a class="whitespace-nowrap rounded-lg bg-green-600 px-3 py-1.5 text-white hover:bg-green-700"
                href="">Cambiar estado</a>
            </td>
        @endforEach
        @empty($ordersRes)
          <tr class="border-b border-slate-400 bg-slate-200 text-center hover:bg-slate-300">
            <td colspan="6" class="px-3 py-3">No hay ordenes</td>
          @endempty

        </tr>
      </tbody>
    </table>
    <div id="paginator" class="mt-4 flex gap-4 whitespace-nowrap text-xl">
      @php($isThereNextPage = $page < $lastPage)
      @php($isTherePreviousPage = $page > 1)

      @if ($isTherePreviousPage)
        <a class="flex-1 select-none rounded-full bg-slate-500 px-2 text-white hover:bg-slate-400"
          href="{{ '/dashboard?page=' . ($page - 1) }}">
          < </a>
          @else
            <a class="pointer-events-none flex-1 select-none rounded-full bg-slate-300 px-2 text-white hover:bg-slate-400"
              href="#">
              < </a>
      @endif

      <span class="flex-1">Page {{ $page }} of {{ $lastPage }}</span>

      @if ($isThereNextPage)
        <a class="flex-1 select-none rounded-full bg-slate-500 px-2 text-white hover:bg-slate-400"
          href="{{ '/dashboard?page=' . ($page + 1) }}"> > </a>
      @else
        <a class="pointer-events-none flex-1 select-none rounded-full bg-slate-300 px-2 text-white hover:bg-slate-400"
          href="#"> > </a>
      @endif

    </div>

  </div>
@endsection
{{-- @push('scripts')
  <script>
    const BASE_URL = 'http://localhost:8000/api';
    const $ordersTBody = $('#ordersTBody');

    let currentPage = 1;
    let ordersArray = [];
    let itemsPerPage = 10;
    let totalItems = 0;

    const ordersFetch = async (page, itemsPerPage) => {
      const ordersFetch = await axios.get(`${BASE_URL}/orders`, {
        params: {
          page,
          itemsPerPage
        }
      });
      ordersArray = ordersFetch.data.ordersRes;
      totalItems = ordersFetch.data.totalOrders;
    }


    $(document).ready(async function() {


      $ordersTBody.append('Cargando...')
      await ordersFetch(currentPage, itemsPerPage);
      $ordersTBody.empty();
      ordersArray.forEach(order => {
        $ordersTBody.append(`
          <tr class="bg-slate-200 hover:bg-slate-300 border-b border-slate-400">
            <th scope="row" class="px-3 py-3" >${order.id}</th>
            <td class="px-6 py-3" >${order.customer}</td>
            <td class="px-6 py-3" >${order.status}</td>
            <td class="px-4 py-3" >${new Date(order.purchaseDate).toLocaleDateString()}</td>
            <td class="px-6 py-3" >${order.total.toLocaleString('es-CL', { style: 'currency', currency: 'CLP' })}</td>
        
            <td class="py-3 flex justify-center gap-2">
              <a class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 rounded-lg text-white whitespace-nowrap" href="">Revisar</a>
              <a class="px-3 py-1.5 bg-green-600 hover:bg-green-700 rounded-lg text-white whitespace-nowrap" href="">Cambiar estado</a>
            </td>
          </tr>
        `);
      });
    });
  </script>
@endpush --}}
