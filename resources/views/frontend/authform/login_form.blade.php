   @php
       $template = App\Models\SiteSetting::find(1);
   @endphp
   @if (Auth::check())
       <script>
           window.location = "/dashboard";
       </script>
       
   @endif
    <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 mx-auto">
                        <div class="bg-white xs-p-20 p-30 border rounded">
                            <div class="form-icon-left rounded form-boder">
                                <h4 class="mb-4 text-dark">User Login</h4>
                              {{ Form::open(['route' => 'login',  'id' => 'loginform', 'method' => 'post', 'autocomplete' => 'off']) }}

                                    <div class="row row-cols-1 g-3">
                                        <div class="col">                                          
                                            <x-input-label for="login" :value="__('Email/Name/Phone')" />                                           
                                            <x-text-input id="login"
                                           class="form-control bg-light {{ $errors->get('login') ? 'is-invalid' : '' }}"
                                           type="text" name="login" :value="old('login')" autofocus />
                                       <x-span-error :messages="$errors->get('login')" class="mt-2" />
                                        </div>
                                        <div class="col">
                                             <x-input-label for="password" :value="__('Password')" />
                                             <x-text-input id="password" class="form-control bg-light" type="password" name="password"
                                           autocomplete="current-password" />
                                       <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                        </div>
                                        <div class="d-sm-flex justify-content-between">
                                            <div class="form-check form-switch mb-2">
                                           <input type="checkbox" class="form-check-input mt-1" id="formSwitch1">
                                           <label class="form-check-label ml-0" for="formSwitch1">Show Password</label>
                                       </div>
                                       <div class="form-check mb-3">
                                            <input id="remember_me" type="checkbox" class="form-check-input mt-1"
                                               name="remember" id="authCheck">
                                           <x-input-label class="form-check-label ml-0" for="authCheck" :value="__('Remember me')" />

                                       </div>
                                        </div>
                                        <div class="col">
                                         <x-primary-button class="btn btn-primary mb-3">
                                           {{ __('Log in') }}
                                       </x-primary-button>
                                        </div>
                                        <div class="col">
                                            {{-- <a href="{{ route('forgot-password') }}" class="text-dark d-table py-1">Forgot Password or Username</a> --}}
                                            <a href="{{ route('register') }}" class="text-dark d-table py-1"><u>Don't have account? Click here.</u></a>
                                        </div>
                                    </div>
                                        {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
