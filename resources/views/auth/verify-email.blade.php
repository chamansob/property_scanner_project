<x-guest-layout>
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 mx-auto">
                    <div class="bg-white xs-p-20 p-30 border rounded">
                        <div class="form-icon-left rounded form-boder">
                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <div class="mt-4 flex items-center justify-between">

                                {{ Form::open(['route' => 'verification.send', 'class' => 'needs-validation', 'method' => 'post', 'autocomplete' => 'off']) }}

                                <div>
                                    <x-primary-button class="btn btn-info mb-3">
                                        {{ __('Resend Verification Email') }}
                                    </x-primary-button>
                                </div>
                                {{ Form::close() }}
                                {{ Form::open(['route' => 'logout', 'class' => 'needs-validation', 'method' => 'post', 'autocomplete' => 'off']) }}


                                <button type="submit" class="btn btn-primary mb-3 mt-3">
                                    {{ __('Log Out') }}
                                </button>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
