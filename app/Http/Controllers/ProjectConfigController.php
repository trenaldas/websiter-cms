<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectConfigController extends Controller
{
    public function index(): View
    {
        return view('project-config.index', [
            'config'     => auth()->user()->selectedProject,
            'currencies' => Currency::all(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $active = $request->active ? 1 : 0;

        if ($request->active && count(auth()->user()->selectedProject->tags) === 0) {
            $active = 0;
        }

        auth()->user()->selectedProject()->first()->update([
            'currency_id'                => $request->currency_id,
            'active'                     => $active,
            'title'                      => $request->title,
            'description'                => $request->description,
            'send_email_on_order'        => $request->send_email_on_order,
            'seller_details_for_order'   => $request->seller_details_for_order,
            'cart_finish_success_title'  => $request->cart_finish_success_title,
            'cart_finish_success'        => $request->cart_finish_success,
            'google_analytics'           => $request->google_analytics,
            'query_title'                => $request->query_title,
            'query_message'              => $request->query_message,
            'mail_query_success_title'   => $request->mail_query_success_title,
            'mail_query_success_message' => $request->mail_query_success_message,
            'facebook'                   => $request->facebook,
            'instagram'                  => $request->instagram,
            'twitter'                    => $request->twitter,
            'linkedin'                   => $request->linkedin,
            'footer_copyright'           => $request->footer_copyright,
        ]);

        return redirect()->route('project.config.index')
                         ->with(['message' => __('Project config updated!')]);
    }
}
