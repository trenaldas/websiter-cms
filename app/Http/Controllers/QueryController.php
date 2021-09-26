<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function index(): View
    {
        return view('query.index', [
            'queries' => auth()->user()->queries()->paginate(10),
        ]);
    }

    public function show(Query $query): View
    {
        return view('query.show', [
            'query' => $query,
        ]);
    }

    public function destroy(Query $query): RedirectResponse
    {
        $query->delete();

        return redirect()->route('query.index')
                         ->with('message', 'Query removed!');
    }
}
