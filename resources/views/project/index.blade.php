@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Your Projects') }}
        </h2>
        @if(session('message'))
            <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        <button @cannot('create', \App\Models\Project::class) disabled @endcannot form="create-form" class="w-min mb-4 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md @can('create', \App\Models\Project::class) hover:bg-purple-700  active:bg-purple-600 @endcan  focus:outline-none focus:shadow-outline-purple">
            {{ __('Create') }}
        </button>
        <form id="create-form" action="{{ route('project.create') }}" method="GET"></form>
        @foreach($projects as $project)
            <div class="flex items-center justify-between p-4 mb-2 text-sm font-semibold @if(auth()->user()->selected_project_id === $project->id) bg-purple-400  text-gray-700 @else  text-gray-700 bg-gray-100 @endif rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
                <div class="flex items-center">
                    <div>{{ $project->title }}
                        @if(! $project->active)
                            <p class="text-xs font-light">{{ __('Inactive') }}</p>
                        @endif
                    </div>
                </div>
                <span>
                    <div class="flex items-center text-sm">
                        <a href="{{ route('project.set', $project->id) }}" class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-500 focus:outline-none focus:shadow-outline-purple">
                            {{ __('Select') }}
                        </a>
                        <button form="edit-{{ $project->id }}" class="flex items-center justify-between px-2 text-sm font-medium leading-5 hover:text-purple-500 text-purple-600 rounded-lg dark:text-white focus:outline-none">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                           </svg>
                        </button>
                        <button form="delete-{{ $project->id }}" class="flex items-center justify-between px-2 text-sm font-medium leading-5 hover:text-purple-500 text-purple-600 rounded-lg dark:text-white focus:outline-none">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </span>
            </div>
            <form method="POST" id="delete-{{ $project->id }}" action="{{ route('project.destroy', $project->id) }}">
                @csrf
                @method('delete')
            </form>
            <form method="GET" id="edit-{{ $project->id }}" action="{{ route('project.edit', $project->id) }}"></form>
        @endforeach
    </div>
@endsection
