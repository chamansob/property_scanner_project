<x-guest-layout>
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 mx-auto">
                    <div class="bg-white xs-p-20 p-30 border rounded">
                        <div class="form-icon-left rounded form-boder">

                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        {{ Form::open(['route' => 'password.email', 'class' => 'needs-validation', 'method' => 'post', 'autocomplete' => 'off']) }}
                            <!-- Email Address -->
                                <div class="col">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button>
                                        {{ __('Email Password Reset Link') }}
                                    </x-primary-button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
