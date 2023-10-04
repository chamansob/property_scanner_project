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
                           <h4 class="mb-4 text-dark">Register</h4>
                           {{ Form::open(['route' => 'register', 'class' => 'default-for needs-validation', 'id' => 'registerform', 'method' => 'post', 'autocomplete' => 'off']) }}
                           <div class="row row-cols-1 g-3">
                               <!-- User Name -->
                               <div class="col">
                                   <x-input-label for="name" :value="__('User Name')" />
                                   <x-text-input id="name" class="form-control bg-light" type="text"
                                       name="name" :value="old('name')" required autofocus autocomplete="name" />
                                   <x-input-error :messages="$errors->get('name')" class="mt-2" />
                               </div>
                               <!-- Email -->
                               <div class="col">
                                   <x-input-label for="email" :value="__('Email')" />
                                   <x-text-input id="email" class="form-control bg-light" type="email"
                                       name="email" :value="old('email')" required autocomplete="email" />
                                   <x-input-error :messages="$errors->get('email')" class="mt-2" />
                               </div>
                               <!-- Phone -->
                               <div class="col">
                                   <x-input-label for="phone" :value="__('Phone')" />
                                   <x-text-input id="phone" class="form-control bg-light" type="text"
                                       name="phone" :value="old('phone')" required autocomplete="phone" />
                                   <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                               </div>
                               <!-- Password -->
                               <div class="col">
                                   <x-input-label for="password" :value="__('Password')" />

                                   <x-text-input id="rpassword" class="form-control bg-light" type="password"
                                       name="password" required autocomplete="new-password" />

                                   <x-input-error :messages="$errors->get('password')" class="mt-2" />
                               </div>
                               <!-- Confirm Password -->
                               <div class="col">
                                   <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                   <x-text-input id="password_confirmation" class="form-control bg-light"
                                       type="password" name="password_confirmation" required
                                       autocomplete="new-password" />

                                   <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                               </div>
                               {{-- <h2 class="py-2">What are you <span class="text-danger">Looking for? </span></h2> --}}
                               <div class="col">
                                   <x-input-label for="name" :value="__('What are you Looking for?')" />

                                   {!! Form::Select('property_status', ['' => 'Select Type', 'buy' => 'Buy', 'sale' => 'Sale'], null, [
                                       'class' => 'form-control basic-single bg-light',
                                       'id' => 'property_status',
                                   ]) !!}
                                   <x-input-error :messages="$errors->get('name')" class="mt-2" />
                               </div>
                               <div class="col">
                                
                               @php
                               $sign= MONEY ;
                              
                               
                                    $budgets=App\Models\BudgetRange::where('range_id',1)->pluck('start','end');
                                  
                                    foreach ($budgets as $key => $value) {
                                       
                                       $budget[]=  $sign.$value ." TO ".(is_numeric($key) ? $sign.$key : $key);
                                    }
                               @endphp
                                   <x-input-label for="name" :value="__('Property Budget')" />
                                   {!! Form::Select(
                                       'budget',
                                        $budget,
                                       null,
                                       [
                                           'class' => 'form-control basic-single bg-light',
                                           'id' => 'budget',
                                       ],
                                   ) !!}

                                   <x-input-error :messages="$errors->get('name')" class="mt-2" />
                               </div>
                              
                               <div class="col">
                                      <x-primary-button class="btn btn-primary mb-3">
                                           {{ __('Register') }}
                                       </x-primary-button>
                               </div>
                           </div>
                           {{ Form::close() }}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
