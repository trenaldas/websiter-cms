<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    public function index(): View
    {
        return view('order.index');
    }

    public function show(Order $order): View
    {
        return view('order.show', [
            'order' => $order,
        ]);
    }
}
