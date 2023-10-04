<x-backend-login-layout>
<!-- Session Status -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  @if(Auth::check()) 
      <script>window.location = "/admin/dashboard";</script> 
    @endif

<div class="page-wrapper full-page">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper">

                            </div>
                        </div>
                        @php
                           $template = App\Models\SiteSetting::find(1);
                        @endphp
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#"
                                    class="noble-ui-logo logo-light d-block mb-2">{{ $template->app_name }}</a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                               <x-auth-session-status class="mb-4" :status="session('status')" />
                                    {{ Form::open(['route' => 'login', 'class' => 'forms-sample','id'=>'login', 'method' => 'post']) }}

                                    <div class="mb-3">
                                        <x-input-label for="login" :value="__('Email/Name/Phone')" />
                                        <x-text-input id="login" class="form-control {{ $errors->get('login')  ? 'is-invalid':'' }}" type="text" name="login"
                                            :value="old('login')"  autofocus />
                                              <x-input-error :messages="$errors->get('login')" class="mt-2" />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="form-control" type="password"
                                            name="password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                  <div class="form-check form-switch mb-2">
											<input type="checkbox" class="form-check-input" id="formSwitch1">
											<label class="form-check-label" for="formSwitch1">Show Password</label>
										</div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="authCheck">
                                        <input id="remember_me" type="checkbox" class="form-check-input"
                                            name="remember">
                                        <x-input-label class="form-check-label" for="authCheck" :value="__('Remember me')" />

                                    </div>
                                </div>
                                    
                                    <div>
                                        <x-primary-button class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="d-block mt-3 text-muted">Forgot
                                        your password?</a>
                               {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
 <script type="text/javascript">
        $(function() {
            'use strict';

          
            $(function() {
          
                $('#login').validate({
                    rules: {
                        login: {
                            required: true,
                        },
                        password: {
                            required: true,
                        }                 
                        

                    },
                    messages: {
                        login: {
                            required: 'Login Name is reuired',
                        },
                        password: {
                            required: 'Password is reuired',
                        }                        
                        
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        });
    </script>
</x-backend-login-layout>
