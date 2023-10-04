<x-dashboard-layout>
      @php

            $id = Auth::user()->id;
            $userData = App\Models\User::find($id); 
        @endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="full-row px-40 py-30 xs-p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h3 class="my-3 text-dark">My Profile</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="border rounded bg-white p-30 mb-30">
                        <div class="row">
                            <div class="col-xl-2">
                                <h4 class="mb-4 font-400 text-dark">Change Password</h4>
                            </div>
                            <div class="col-xl-10">
                              
                                    {{ Form::open(['route' => 'user.password.update',  'class' => 'form-boder', 'method' => 'post', 'autocomplete' => 'off']) }}

                                    <div class="row">
                                        <div class="col-lg-6 mb-20">
                                            <x-input-label for="old_password" :value="__('Old Password')" />

                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid @enderror "
                                                id="old_password" autocomplete="off" />
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <x-input-label for="new_password" :value="__('New Password')" />
                                            <input id="new_password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                type="password" name="new_password" autocomplete="off" />
                                            @error('new_password')
                                                <span class="text-danger pt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <x-input-label for="new_password" :value="__('Confirm New Password')" />
                                            <input id="new_password_confirmation" class="form-control" type="password"
                                                name="new_password_confirmation" autocomplete="off" />

                                        </div>
                                        <div class="col-lg-12 mb-20">
                                            <x-primary-button class="btn btn-primary mb-3">
                                           {{ __('Save Changes') }}
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
    </div>

</x-dashboard-layout>
