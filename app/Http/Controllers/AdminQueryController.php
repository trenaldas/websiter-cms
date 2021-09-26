<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminQueryStoreRequest;
use App\Models\AdminConfig;
use App\Models\AdminQuery;
use App\Notifications\AdminQueryNotification;
use Illuminate\Http\RedirectResponse;

class AdminQueryController extends Controller
{
    private AdminQuery $adminQuery;

    public function __construct(AdminQuery $adminQuery)
    {
        $this->adminQuery = $adminQuery;
    }

    public function store(AdminQueryStoreRequest $request): RedirectResponse
    {
        $query = $this->adminQuery->create([
            'name'    => $request->name,
            'message' => $request->message,
            'email'   => $request->email,
        ]);

        AdminConfig::first()->notify(new AdminQueryNotification($query));

        return redirect()->route('contact-us')
                         ->with('message', 'We received your query!');
    }
}
