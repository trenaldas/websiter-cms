<?php

namespace App\Http\Controllers;

use App\Models\Bit;
use App\Models\BitTheme;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BitController extends Controller
{
    private BitTheme $bitTheme;
    private Bit      $bit;

    public function __construct(BitTheme $bitTheme, Bit $bit)
    {
        $this->authorizeResource(Bit::class, 'bit');
        $this->bitTheme = $bitTheme;
        $this->bit      = $bit;
    }

    public function create(Request $request): View
    {
        return view('bit.create', [
            'bitTheme'   => $this->bitTheme->find($request->get('bit_theme_id')),
            'tagId'      => $request->get('tag_id'),
            'parentBits' => auth()->user()->selectedProject->bits->whereNull('parent_id'),
        ]);
    }

    public function edit(Bit $bit): View
    {
        return view('bit.edit', [
            'bit'        => $bit,
            'parentBits' => auth()->user()
                ->selectedProject
                ->bits()
                ->select(['bits.id', 'bits.name', 'tag_id'])
                ->whereNull('bits.parent_id')
                ->get()
                ->load('tag'),
        ]);
    }
}
