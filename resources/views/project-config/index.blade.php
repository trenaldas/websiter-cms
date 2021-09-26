@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Project Config') }}
        </h2>
        @if(session('message'))
            <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('project.config.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mt-2 mb-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        {{ __('Active') }}
                    </span>
                    <div class="mt-2">
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input @if($config->active) checked @endif
                                   type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="active"
                                   value="1"
                            />
                            <span class="ml-2">{{ __('Yes') }}</span>
                        </label>
                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                            <input @if(!$config->active) checked @endif
                                   type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="active"
                                   value="0"
                            />
                            <span class="ml-2">{{ __('No') }}</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Website Title') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="title" value="{{ old('title') ?? $config->title }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">{{ __('Currency') }}</span>
                    <div class="mt-2">
                        <select name="currency_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            @foreach($currencies as $currency)
                                    <option @if($config->currency->name === $currency->name) selected @endif value="{{ $currency->id }}">{{ $currency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">{{ __('Description') }}</span>
                    <textarea name="description"
                              class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                              rows="3"
                    >{{ old('title') ?? $config->description }}</textarea>
                </label>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Title when order is successful') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="cart_finish_success_title" value="{{ old('cart_finish_success_title') ?? $config->cart_finish_success_title }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Send email after order') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="send_email_on_order" value="{{ old('send_email_on_order') ?? $config->send_email_on_order }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Seller details in Order View') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="seller_details_for_order" value="{{ old('seller_details_for_order') ?? $config->seller_details_for_order }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Message when order is successful') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="cart_finish_success" value="{{ old('cart_finish_success') ?? $config->cart_finish_success }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Fast Query Title') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="query_title" value="{{ old('query_title') ?? $config->query_title }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Fast Query Message') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="query_message" value="{{ old('query_message') ?? $config->query_message }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Title After Query Sent') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="mail_query_success_title" value="{{ old('mail_query_success_title') ?? $config->mail_query_success_title }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Message After Query Sent') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="mail_query_success_message" value="{{ old('mail_query_success_message') ?? $config->mail_query_success_message }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Google Analytics "G-" ID') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="google_analytics" value="{{ old('google_analytics') ?? $config->google_analytics }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Footer Copyright') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="footer_copyright" value="{{ old('footer_copyright') ?? $config->footer_copyright }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Facebook') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="facebook" value="{{ old('facebook') ?? $config->facebook }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Instagram') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="instagram" value="{{ old('instagram') ?? $config->instagram }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('Twitter') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="twitter" value="{{ old('twitter') ?? $config->twitter }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      {{ __('LinkedIn') }}
                    </span>
                    <div class="mt-2">
                        <label class="block text-sm">
                            <input type="text" name="linkedin" value="{{ old('linkedin') ?? $config->linkedin }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                </div>
                <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    {{ __('Update') }}
                </button>
            </form>
        </div>
    </div>
@endsection
