<x-dashboard-layout>
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
                                <h4 class="mb-4 font-400">Profile Information</h4>
                            </div>
                            <div class="col-xl-10">
                                <form method="POST" class="form-boder" action="{{ route('user.profile.store') }}"
                                    autocomplete="off" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="wrap-custom-file">
                                                <x-text-input class="form-control" type="file" name="photo"
                                                    id="photo" />
                                                <label id="showImage" for="photo"
                                                    style="background-image: url({{ !empty($profileData->photo) ? asset($profileData->photo) : url('upload/no_image.jpg') }});">
                                                    <span><i class="flaticon-download"></i> Upload Photo </span>
                                                </label>
                                            </div>
                                            <p>*minimum 260px x 260px</p>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label class="mb-2 font-fifteen font-500">Username</label>
                                            <x-text-input id="username" class="form-control" type="text"
                                                name="username"
                                                value="{{ $profileData->username != '' ? $profileData->username : '--' }}"
                                                required autofocus autocomplete="off" />
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label class="mb-2 font-fifteen font-500">Email</label>
                                            <x-text-input id="email" class="form-control" type="email"
                                                name="email"
                                                value="{{ $profileData->email != '' ? $profileData->email : '--' }}"
                                                required autofocus autocomplete="off" />
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label class="mb-2 font-fifteen font-500">Full Name</label>
                                            <x-text-input id="name" class="form-control" type="text"
                                                name="name"
                                                value="{{ $profileData->name != '' ? $profileData->name : '--' }}"
                                                required autofocus autocomplete="off" />
                                        </div>

                                        <div class="col-lg-6 mb-20">
                                            <label class="mb-2 font-fifteen font-500">Position</label>
                                            <x-text-input id="phone" class="form-control" type="text"
                                                name="phone"
                                                value="{{ $profileData->phone != '' ? $profileData->phone : '' }}"
                                                autofocus autocomplete="off" />
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label class="mb-2 font-500 w-100">About Me</label>
                                            <x-textarea id="address" class="form-control bg-light" name="address"
                                                placeholder="Write Details..." rows="6"
                                                value="{{ $profileData->address != '' ? $profileData->address : '' }}"
                                                autofocus autocomplete="off" />
                                        </div>

                                        <div class="col-12 mb-20">
                                            <x-primary-button class="btn btn-primary">
                                                {{ __('Save Chnages') }}
                                            </x-primary-button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#photo').change(function(e) {

                var reader = new FileReader();
                console.log(e.target.result);
                reader.onload = function(e) {
                    $('#showImage').css('background-image', "url(" + e.target.result + ")");
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
</x-dashboard-layout>
