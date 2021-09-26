<?php

namespace App\Http\Controllers;

use App\Http\Requests\BitThemeIndexRequest;
use App\Models\BitTheme;
use Illuminate\Contracts\View\View;

class BitThemeController extends Controller
{
    private BitTheme $bitTheme;

    public function __construct(BitTheme $bitTheme)
    {
        $this->bitTheme = $bitTheme;
    }

    public function index(BitThemeIndexRequest $request): View
    {
        return view('bit-theme.index', [
            'tagId'      => $request->get('tag_id'),
            'bitThemes'  => $this->bitTheme->all(),
        ]);
    }
}
