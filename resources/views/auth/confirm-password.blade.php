<x-guest-layout>
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 mx-auto">
                    <div class="bg-white xs-p-20 p-30 border rounded">
                        <div class="form-icon-left rounded form-boder">

                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>
                            {{ Form::open(['route' => 'password.confirm', 'class' => 'needs-validation', 'method' => 'post', 'autocomplete' => 'off']) }}

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Confirm') }}
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
