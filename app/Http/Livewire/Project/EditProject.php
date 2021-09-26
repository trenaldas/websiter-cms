<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class EditProject extends Component
{
    public Project $project;

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
                Rule::unique('projects')->ignore($this->project->id),
            ],
            'domain_url'    => [
                'required_without:subdomain_url',
                'nullable',
                'min:3',
                'max:25',
                $domainRegex,
                Rule::unique('projects')->ignore($this->project->id),
            ]
        ];
    }

    public function mount(): void
    {
        $this->domain        = $this->project->subdomain_url ? 0 : 1;
        $this->title         = $this->project->title;
        $this->subdomain_url = $this->project->subdomain_url;
        $this->domain_url    = $this->project->domain_url;
    }

    public function updatedDomain(): void
    {
        if ($this->domain === 1) {
            $this->subdomain_url = null;
            $this->domain_url = $this->project->domain_url;
            return;
        }

        $this->domain_url = null;
        $this->subdomain_url = $this->project->subdomain_url;
    }

    public function update(): Redirector
    {

        if ($this->domain_url && $this->subdomain_url) {
            throw ValidationException::withMessages([
                'domain_url' => __('You can have only one field selected.')
            ]);
        }

        $this->validate();

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

        $this->project->update([
            'title'         => $this->title,
            'subdomain_url' => $this->subdomain_url,
            'domain_url'    => $this->domain_url,
        ]);

        session()->flash('message', __('Updated Successfully!'));
        return redirect()->route('project.index');
    }

    public function render(): View
    {
        return view('livewire.project.edit-project');
    }
}
