<?php

namespace App\Http\Livewire\Project;

use App\Notifications\NewProjectNotification;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class CreateProject extends Component
{
    public string  $title         = '';
    public ?string $subdomain_url = null;
    public ?string $domain_url    = null;
    public int     $domain        = 0;

    protected function rules(): array
    {
        $domainRegex = config('app.env') === 'local'
            ? ''
            : 'regex:/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i';

        return [
            'title'         => [
                'required',
                'min:3',
                'max:25',
            ],
            'subdomain_url' => [
                'required_without:domain_url',
                'nullable',
                'min:3',
                'max:25',
                'unique:projects,subdomain_url',
            ],
            'domain_url'    => [
                'required_without:subdomain_url',
                'nullable',
                'min:3',
                'max:25',
                $domainRegex,
                'unique:projects,domain_url',
            ]
        ];
    }

    public function cancel(): Redirector
    {
        return redirect()->route('project.index');
    }

    public function updatedDomain(): void
    {
        if ($this->domain === 1) {
            $this->subdomain_url = null;
            return;
        }

        $this->domain_url = null;
    }

    public function store(): Redirector
    {
        $this->validate();
        if ($this->domain_url && $this->subdomain_url) {
            throw ValidationException::withMessages([
                'domain_url' => __('You can have only one field selected.')
            ]);
        }

        if ($this->subdomain_url) {
            $this->subdomain_url = str_replace([
                'http://',
                'https://',
                'www.',
                '.websiter.com',
            ], '', $this->subdomain_url);

            $this->subdomain_url = str_replace(' ', '-', $this->subdomain_url);
        }

        if ($this->domain_url) {
            $this->domain_url = str_replace([
                'http://',
                'https://',
                'www.',
            ], '', $this->domain_url);

            $this->domain_url = str_replace(' ', '-', $this->domain_url);
        }

        $project = auth()->user()->projects()->create([
            'title'                      => $this->title,
            'domain_url'                 => $this->domain_url === '' ? null : $this->domain_url,
            'subdomain_url'              => $this->subdomain_url === '' ? null : $this->subdomain_url,
            'description'                => __('Website Description'),
            'send_email_on_order'        => __('Thanks.'),
            'seller_details_for_order'   => __('Name Surname, Full Address'),
            'vat_percent'                => 0,
            'cart_finish_success_title'  => __('Thank you!'),
            'cart_finish_success'        => __('Your order has been submitted successfully. We will contact you soon to arrange details about receiving products.'),
            'google_analytics'           => __('Your G-" ID'),
            'query_title'                => __('Fast Query'),
            'query_message'              => __('No Question Is Too Small'),
            'mail_query_success_title'   => __('Thank you!'),
            'mail_query_success_message' => __('Your Query was successfully received.'),
            'footer_copyright'           => __('© 2021 All rights reserved'),
        ]);

        auth()->user()->notify(new NewProjectNotification($project));

        if (! auth()->user()->selected_project_id) {
            auth()->user()->selected_project_id = $project->id;
            auth()->user()->save();
        }

        session()->flash('message', __('Saved Successfully!'));
        return redirect()->route('project.index');
    }

    public function render(): View
    {
        return view('livewire.project.create-project');
    }
}
