<?php

namespace App\Http\Controllers;

class ShippingMethodController extends Controller
{
    public function index()
    {
        return view('shipping-method.index', [
            'methods' => auth()->user()->selectedProject->shippingMethods,
        ]);
    }
}
