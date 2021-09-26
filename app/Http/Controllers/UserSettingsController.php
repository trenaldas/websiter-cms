<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class UserSettingsController extends Controller
{
    public function index(): View
    {
        return view('user-settings');
    }
}
